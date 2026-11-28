
<div class="container px-5 py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold">Gerenciar quizzes</h1>
            <p class="text-muted">
                Crie, edite, visualize e exclua seus quizzes.
            </p>
        </div>

        <a href="<?= e(url('quiz/create')) ?>"
           class="btn btn-success">
            <i class="bi bi-plus-circle"></i>
            Novo quiz
        </a>
    </div>

    <?php if (empty($quizzes)): ?>

        <div class="alert alert-info">
            Nenhum quiz cadastrado.
        </div>

    <?php else: ?>

        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Perguntas</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php foreach ($quizzes as $item): ?>

                        <tr>
                            <td><?= e($item['id_quiz']) ?></td>

                            <td>
                                <strong>
                                    <?= e($item['titulo']) ?>
                                </strong>
                                <br>
                                <small class="text-muted">
                                    <?= e($item['descricao'] ?? '') ?>
                                </small>
                            </td>

                            <td>
                                <span class="badge bg-primary">
                                    <?= e($item['total_perguntas']) ?>
                                    questões
                                </span>
                            </td>

                            <td>
                                <div class="d-flex gap-2">

                                    <a href="<?= e(url(
                                        'quiz/edit/' . $item['id_quiz']
                                    )) ?>"
                                       class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil"></i>
                                        Editar
                                    </a>

                                    <form method="post"
                                          action="<?= e(url('quiz/delete')) ?>"
                                          onsubmit="return confirm('Deseja realmente excluir este quiz e todo seu conteúdo?')">

                                        <input type="hidden"
                                               name="csrf"
                                               value="<?= e($_SESSION['csrf']) ?>">

                                        <input type="hidden"
                                               name="id_quiz"
                                               value="<?= e($item['id_quiz']) ?>">

                                        <button type="submit"
                                                class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                            Excluir
                                        </button>

                                    </form>

                                </div>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>
            </div>
        </div>

    <?php endif; ?>

</div>
