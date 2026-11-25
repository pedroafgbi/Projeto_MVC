<section class="py-5">
    <div class="container px-5">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
            <div>
                <h1 class="fw-bolder mb-1"><?= e($title) ?></h1>
                <p class="lead fw-normal text-muted mb-0">Pessoas cadastradas no sistema</p>
            </div>
            <div class="d-flex gap-2">
                <?php if ($single): ?>
                    <a href="<?= e(url('user/index')) ?>" class="btn btn-outline-secondary">Ver todos</a>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!empty($flash)): ?>
            <div class="alert alert-success" role="alert"><?= e($flash) ?></div>
        <?php endif; ?>

        <?php if (!$single): ?>
            <ul class="nav nav-pills mb-3">
                <li class="nav-item">
                    <a class="nav-link<?= $status === 'ativos' ? ' active' : '' ?>"
                       href="<?= e(url('user/index')) ?>">Ativos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?= $status === 'inativos' ? ' active' : '' ?>"
                       href="<?= e(url('user/index?status=inativos')) ?>">Inativos</a>
                </li>
            </ul>
        <?php endif; ?>

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
                        <?php $uid = (int) $u['id_user']; ?>
                        <tr>
                            <td class="ps-4">
                                <a class="fw-bold text-decoration-none"
                                   href="<?= e(url('user/show/' . $uid)) ?>">
                                    <?= e(trim($u['name'] . ' ' . ($u['last_name'] ?? ''))) ?>
                                </a>
                                <?php if ((int) $u['active'] !== 1): ?>
                                    <span class="badge bg-secondary ms-1">inativo</span>
                                <?php endif; ?>
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
                                Nenhum usuário <?= $status === 'inativos' ? 'inativo' : 'ativo' ?>.
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
