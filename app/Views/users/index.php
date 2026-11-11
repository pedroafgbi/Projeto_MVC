<section class="py-5">
    <div class="container px-5">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
            <div>
                <h1 class="fw-bolder mb-1"><?= e($title) ?></h1>
                <p class="lead fw-normal text-muted mb-0">Pessoas cadastradas no sistema</p>
            </div>
            <div class="d-flex gap-2">
                <?php if (count($users) === 1): ?>
                    <a href="<?= e(url('user/index')) ?>" class="btn btn-outline-secondary">Ver todos</a>
                <?php endif; ?>
                <a href="<?= e(url('user/create')) ?>" class="btn btn-primary">
                    <i class="bi bi-person-plus"></i> Novo usuário
                </a>
            </div>
        </div>

        <div class="card shadow border-0 rounded-3">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 lista">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="ps-4">Nome</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">CPF</th>
                            <th scope="col">Nascimento</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $u): ?>
                        <tr>
                            <td class="ps-4">
                                <a class="fw-bold text-decoration-none"
                                   href="<?= e(url('user/show/' . (int) $u['id'])) ?>">
                                    <?= e(trim($u['name'] . ' ' . ($u['last_name'] ?? ''))) ?>
                                </a>
                            </td>
                            <td><?= e($u['email']) ?></td>
                            <td><?= e(format_cpf($u['cpf'] ?? '')) ?></td>
                            <td>
                                <?= !empty($u['birth_date'])
                                    ? e(date('d/m/Y', strtotime($u['birth_date'])))
                                    : '&mdash;' ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (!$users): ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                Nenhum usuário cadastrado.
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
