<?php
namespace App\Models;

use PDO;

class Quiz
{
    public static function all(): array
    {
        $sql = "SELECT q.*,
                COUNT(DISTINCT p.id_pergunta) AS total_perguntas
                FROM quiz q
                LEFT JOIN perguntas p ON p.id_quiz = q.id_quiz
                GROUP BY q.id_quiz
                ORDER BY q.id_quiz DESC";

        return Database::connect()->query($sql)->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $db = Database::connect();

        $stmt = $db->prepare(
            "SELECT * FROM quiz WHERE id_quiz = ?"
        );
        $stmt->execute([$id]);

        $quiz = $stmt->fetch();

        if (!$quiz) {
            return null;
        }

        $stmt = $db->prepare(
            "SELECT * FROM perguntas
             WHERE id_quiz = ?
             ORDER BY id_pergunta"
        );
        $stmt->execute([$id]);

        $quiz['perguntas'] = $stmt->fetchAll();

        foreach ($quiz['perguntas'] as &$pergunta) {
            $stmt = $db->prepare(
                "SELECT * FROM alternativas
                 WHERE id_pergunta = ?
                 ORDER BY id_alternativa"
            );

            $stmt->execute([$pergunta['id_pergunta']]);

            $pergunta['alternativas'] = $stmt->fetchAll();
        }

        unset($pergunta);

        return $quiz;
    }

    public static function save(
        string $titulo,
        string $descricao,
        array $perguntas,
        ?int $id = null
    ): int {
        $db = Database::connect();

        $db->beginTransaction();

        try {
            if ($id) {
                $stmt = $db->prepare(
                    "UPDATE quiz
                     SET titulo = ?, descricao = ?
                     WHERE id_quiz = ?"
                );

                $stmt->execute([$titulo, $descricao, $id]);

                $stmt = $db->prepare(
                    "DELETE FROM perguntas WHERE id_quiz = ?"
                );

                $stmt->execute([$id]);

            } else {
                $stmt = $db->prepare(
                    "INSERT INTO quiz (titulo, descricao)
                     VALUES (?, ?)"
                );

                $stmt->execute([$titulo, $descricao]);

                $id = (int) $db->lastInsertId();
            }

            foreach ($perguntas as $pergunta) {

                $enunciado = trim($pergunta['enunciado'] ?? '');

                if ($enunciado === '') {
                    throw new \InvalidArgumentException(
                        'Todas as perguntas precisam de um enunciado.'
                    );
                }

                $stmt = $db->prepare(
                    "INSERT INTO perguntas (id_quiz, enunciado)
                     VALUES (?, ?)"
                );

                $stmt->execute([$id, $enunciado]);

                $idPergunta = (int) $db->lastInsertId();

                $alternativas = $pergunta['alternativas'] ?? [];
                $correta = filter_var(
                    $pergunta['correta'] ?? null,
                    FILTER_VALIDATE_INT
                );

                if (
                    count($alternativas) < 2 ||
                    $correta === false ||
                    !array_key_exists($correta, $alternativas)
                ) {
                    throw new \InvalidArgumentException(
                        'Cada pergunta precisa de pelo menos duas alternativas e uma resposta correta.'
                    );
                }

                foreach ($alternativas as $indice => $texto) {

                    $texto = trim($texto);

                    if ($texto === '') {
                        throw new \InvalidArgumentException(
                            'Preencha todas as alternativas.'
                        );
                    }

                    $stmt = $db->prepare(
                        "INSERT INTO alternativas
                         (id_pergunta, texto, correta)
                         VALUES (?, ?, ?)"
                    );

                    $stmt->execute([
                        $idPergunta,
                        $texto,
                        $indice === $correta ? 1 : 0
                    ]);
                }
            }

            $db->commit();

            return $id;

        } catch (\Throwable $e) {
            $db->rollBack();
            throw $e;
        }
    }

    public static function delete(int $id): void
    {
        $stmt = Database::connect()->prepare(
            "DELETE FROM quiz WHERE id_quiz = ?"
        );

        $stmt->execute([$id]);
    }
}
