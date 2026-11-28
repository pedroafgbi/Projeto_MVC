<?php
namespace App\Controllers;

use App\Models\Database;
use App\Models\Quiz;

class QuizController
{
    private function verificarAdmin(): void
    {
        $id = filter_var(
            $_SESSION['user_id'] ?? null,
            FILTER_VALIDATE_INT
        );

        if (!$id) {
            header('Location: ' . url('auth/login'));
            exit;
        }

        $stmt = Database::connect()->prepare(
            "SELECT role FROM users WHERE id_user = ? AND active = 1"
        );

        $stmt->execute([$id]);

        if ($stmt->fetchColumn() !== 'admin') {
            http_response_code(403);
            exit('Acesso permitido somente ao administrador.');
        }
    }

    private function verificarCSRF(): void
    {
        if (
            !isset($_POST['csrf']) ||
            !hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'])
        ) {
            http_response_code(403);
            exit('Token de segurança inválido.');
        }
    }

    public function index(): void
    {
        $this->verificarAdmin();

        $this->render('quiz/index', [
            'title' => 'Gerenciar quizzes',
            'quizzes' => Quiz::all()
        ]);
    }

    public function create(): void
    {
        $this->verificarAdmin();

        $this->render('quiz/form', [
            'title' => 'Criar quiz',
            'quiz' => null
        ]);
    }

    public function edit(string $id): void
    {
        $this->verificarAdmin();

        $quiz = Quiz::find((int) $id);

        if (!$quiz) {
            http_response_code(404);
            exit('Quiz não encontrado.');
        }

        $this->render('quiz/form', [
            'title' => 'Editar quiz',
            'quiz' => $quiz
        ]);
    }

    public function store(): void
    {
        $this->verificarAdmin();
        $this->verificarCSRF();

        try {
            $titulo = trim($_POST['titulo'] ?? '');
            $descricao = trim($_POST['descricao'] ?? '');
            $perguntas = $_POST['perguntas'] ?? [];

            if ($titulo === '' || !is_array($perguntas) || count($perguntas) === 0) {
                throw new \InvalidArgumentException(
                    'Informe o título e pelo menos uma pergunta.'
                );
            }

            Quiz::save($titulo, $descricao, $perguntas);

            header('Location: ' . url('quiz/index'));
            exit;

        } catch (\Throwable $e) {
            http_response_code(400);
            exit('Não foi possível salvar: ' . htmlspecialchars(
                $e->getMessage(), ENT_QUOTES, 'UTF-8'
            ));
        }
    }

    public function update(string $id): void
    {
        $this->verificarAdmin();
        $this->verificarCSRF();

        try {
            $id = (int) $id;

            if (!Quiz::find($id)) {
                http_response_code(404);
                exit('Quiz não encontrado.');
            }

            $titulo = trim($_POST['titulo'] ?? '');
            $descricao = trim($_POST['descricao'] ?? '');
            $perguntas = $_POST['perguntas'] ?? [];

            if ($titulo === '' || !is_array($perguntas) || count($perguntas) === 0) {
                throw new \InvalidArgumentException(
                    'Informe o título e pelo menos uma pergunta.'
                );
            }

            Quiz::save($titulo, $descricao, $perguntas, $id);

            header('Location: ' . url('quiz/index'));
            exit;

        } catch (\Throwable $e) {
            http_response_code(400);
            exit('Não foi possível atualizar: ' . htmlspecialchars(
                $e->getMessage(), ENT_QUOTES, 'UTF-8'
            ));
        }
    }

    public function delete(): void
    {
        $this->verificarAdmin();
        $this->verificarCSRF();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Método não permitido.');
        }

        Quiz::delete((int) ($_POST['id_quiz'] ?? 0));

        header('Location: ' . url('quiz/index'));
        exit;
    }

    private function render(string $view, array $data = []): void
    {
        $base = __DIR__ . '/../Views/';

        $renderFile = static function (
            string $__file,
            array $__data
        ): string {
            extract($__data, EXTR_SKIP);
            ob_start();
            require $__file;
            return ob_get_clean();
        };

        $content = $renderFile($base . $view . '.php', $data);

        $vars = $data + ['content' => $content];

        echo $renderFile(
            $base . 'layouts/home.php',
            $vars
        );
    }
}
