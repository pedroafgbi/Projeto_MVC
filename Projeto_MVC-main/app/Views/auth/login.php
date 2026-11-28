<section class="py-5">
    <div class="container px-5">
        <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
            <div class="text-center mb-5">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3">
                    <i class="bi bi-box-arrow-in-right"></i>
                </div>
                <h1 class="fw-bolder">Bem-vindo de volta</h1>
                <p class="lead fw-normal text-muted mb-0">Entre e continue aprendendo sobre um consumo mais consciente.</p>
            </div>
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <?php if (!empty($flash)): ?>
                        <div class="alert alert-success" role="alert"><?= e($flash) ?></div>
                    <?php endif; ?>
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger" role="alert"><?= e($error) ?></div>
                    <?php endif; ?>
                    <form method="post" action="<?= e(url('auth/authenticate')) ?>">
                        <input type="hidden" name="csrf" value="<?= e($csrf) ?>">
                        <div class="form-floating mb-3">
                            <input id="email" name="email" type="email" required maxlength="150"
                                   autocomplete="username" placeholder="nome@exemplo.com"
                                   class="form-control" value="<?= e($email ?? '') ?>">
                            <label for="email">E-mail</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input id="password" name="password" type="password" required
                                   autocomplete="current-password" placeholder="Senha"
                                   class="form-control">
                            <label for="password">Senha</label>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Entrar</button>
                            <a href="<?= e(url('user/create')) ?>" class="btn btn-outline-secondary">
                                Ainda não tem conta? Cadastre-se
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
