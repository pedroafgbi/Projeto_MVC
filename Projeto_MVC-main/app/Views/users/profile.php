<section class="py-5">
    <div class="container px-5">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
            <div>
                <h1 class="fw-bolder mb-1">Meu perfil</h1>
                <p class="lead fw-normal text-muted mb-0">Suas informações de cadastro</p>
            </div>
            <a href="<?= e(url('user/edit/' . (int) $user['id_user'])) ?>"
               class="btn btn-primary">Alterar dados</a>
        </div>

        <?php if (!empty($flash)): ?>
            <div class="alert alert-success" role="alert"><?= e($flash) ?></div>
        <?php endif; ?>

        <div class="card shadow border-0 rounded-3">
            <div class="card-body p-4 p-md-5">
                <dl class="row mb-0">
                    <dt class="col-sm-4">Nome</dt>
                    <dd class="col-sm-8"><?= e($user['name']) ?></dd>
                    <dt class="col-sm-4">Sobrenome</dt>
                    <dd class="col-sm-8"><?= e($user['last_name']) ?></dd>
                    <dt class="col-sm-4">E-mail</dt>
                    <dd class="col-sm-8"><?= e($user['email']) ?></dd>
                    <dt class="col-sm-4">CPF</dt>
                    <dd class="col-sm-8"><?= e(format_cpf($user['cpf'])) ?></dd>
                    <dt class="col-sm-4">Data de nascimento</dt>
                    <dd class="col-sm-8">
                        <?= !empty($user['birth_date']) && $user['birth_date'] !== '0000-00-00'
                            ? e(date('d/m/Y', strtotime($user['birth_date'])))
                            : '&mdash;' ?>
                    </dd>
                </dl>
                <hr class="my-4">
                <form method="post" action="<?= e(url('user/deleteAccount')) ?>"
                      onsubmit="return confirm('Excluir sua conta permanentemente? Esta ação não pode ser desfeita.');">
                    <input type="hidden" name="csrf" value="<?= e($csrf) ?>">
                    <button type="submit" class="btn btn-outline-danger">Excluir minha conta</button>
                </form>
            </div>
        </div>
    </div>
</section>
