
<?php
$editando = !empty($quiz);

$perguntas = $quiz['perguntas'] ?? [
    [
        'enunciado' => '',
        'alternativas' => [
            ['texto' => '', 'correta' => 1],
            ['texto' => '', 'correta' => 0]
        ]
    ]
];
?>

<div class="container px-5 py-5">

    <h1 class="fw-bold mb-2">
        <?= $editando ? 'Editar quiz' : 'Criar quiz' ?>
    </h1>

    <p class="text-muted mb-4">
        Cadastre as perguntas e defina as respostas corretas.
    </p>

    <form method="post"
          action="<?= e(url(
              $editando
                  ? 'quiz/update/' . $quiz['id_quiz']
                  : 'quiz/store'
          )) ?>">

        <input type="hidden"
               name="csrf"
               value="<?= e($_SESSION['csrf']) ?>">

        <!-- Informações do quiz -->

        <div class="card shadow-sm mb-4">
            <div class="card-body p-4">

                <h4 class="fw-bold mb-3">Informações gerais</h4>

                <div class="mb-3">
                    <label class="form-label">Título do quiz</label>

                    <input type="text"
                           name="titulo"
                           class="form-control"
                           maxlength="150"
                           required
                           value="<?= e($quiz['titulo'] ?? '') ?>"
                           placeholder="Ex: Educação Ambiental">
                </div>

                <div class="mb-3">
                    <label class="form-label">Descrição</label>

                    <textarea name="descricao"
                              class="form-control"
                              rows="3"
                              placeholder="Descreva o objetivo do quiz..."><?= e($quiz['descricao'] ?? '') ?></textarea>
                </div>

            </div>
        </div>

        <!-- Perguntas -->

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h3 class="fw-bold">Perguntas</h3>

            <button type="button"
                    class="btn btn-success"
                    onclick="adicionarPergunta()">

                <i class="bi bi-plus-circle"></i>
                Adicionar pergunta

            </button>

        </div>

        <div id="listaPerguntas">

            <?php foreach ($perguntas as $i => $pergunta): ?>

                <div class="card shadow-sm mb-4 pergunta-card"
                     data-index="<?= $i ?>">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between mb-3">

                            <h5 class="fw-bold titulo-pergunta">
                                Pergunta <?= $i + 1 ?>
                            </h5>

                            <button type="button"
                                    class="btn btn-outline-danger btn-sm"
                                    onclick="this.closest('.pergunta-card').remove(); atualizarNumeracao()">

                                <i class="bi bi-trash"></i>
                                Remover

                            </button>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Enunciado da pergunta
                            </label>

                            <textarea class="form-control"
                                      name="perguntas[<?= $i ?>][enunciado]"
                                      required
                                      rows="2"><?= e($pergunta['enunciado']) ?></textarea>

                        </div>

                        <label class="form-label fw-bold">
                            Alternativas
                        </label>

                        <p class="small text-muted">
                            Marque a opção que representa a resposta correta.
                        </p>

                        <div class="lista-alternativas">

                            <?php foreach ($pergunta['alternativas'] as $j => $alternativa): ?>

                                <div class="input-group mb-2 alternativa-item">

                                    <div class="input-group-text">
                                        <input type="radio"
                                               class="form-check-input mt-0"
                                               name="perguntas[<?= $i ?>][correta]"
                                               value="<?= $j ?>"
                                               required
                                               <?= !empty($alternativa['correta']) ? 'checked' : '' ?>>
                                    </div>

                                    <input type="text"
                                           class="form-control"
                                           name="perguntas[<?= $i ?>][alternativas][<?= $j ?>]"
                                           value="<?= e($alternativa['texto']) ?>"
                                           placeholder="Digite a alternativa"
                                           required>

                                    <button type="button"
                                            class="btn btn-outline-danger"
                                            onclick="removerAlternativa(this)">
                                        <i class="bi bi-x-lg"></i>
                                    </button>

                                </div>

                            <?php endforeach; ?>

                        </div>

                        <button type="button"
                                class="btn btn-outline-primary btn-sm"
                                onclick="adicionarAlternativa(this)">

                            <i class="bi bi-plus"></i>
                            Adicionar alternativa

                        </button>

                    </div>
                </div>

            <?php endforeach; ?>

        </div>

        <div class="d-flex gap-2 justify-content-end">

            <a href="<?= e(url('quiz/index')) ?>"
               class="btn btn-outline-secondary">
                Cancelar
            </a>

            <button type="submit" class="btn btn-success btn-lg">
                <i class="bi bi-check-circle"></i>
                Salvar quiz
            </button>

        </div>

    </form>

</div>

<script src="<?= e(asset('js/quiz-admin.js')) ?>"></script>
