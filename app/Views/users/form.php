<section class="py-5">
    <div class="container px-5">
        <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
            <div class="text-center mb-5">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3">
                    <i class="bi <?= $editing ? 'bi-pencil-square' : 'bi-person-plus' ?>"></i>
                </div>
                <h1 class="fw-bolder"><?= e($title) ?></h1>
                <p class="lead fw-normal text-muted mb-0"><?= e($subtitle) ?></p>
            </div>

            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <form method="post" action="<?= e(url($action)) ?>" data-validate>
                        <input type="hidden" name="csrf" value="<?= e($csrf) ?>">

                        <div class="form-floating mb-3">
                            <input id="name" name="name" type="text" required maxlength="100"
                                   placeholder="Seu nome"
                                   class="form-control<?= isset($errors['name']) ? ' is-invalid' : '' ?>"
                                   value="<?= e($old['name'] ?? '') ?>">
                            <label for="name">Nome</label>
                            <?php if (isset($errors['name'])): ?>
                                <p class="erro invalid-feedback d-block"><?= e($errors['name']) ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3">
                            <input id="last_name" name="last_name" type="text" required maxlength="100"
                                   placeholder="Seu sobrenome"
                                   class="form-control<?= isset($errors['last_name']) ? ' is-invalid' : '' ?>"
                                   value="<?= e($old['last_name'] ?? '') ?>">
                            <label for="last_name">Sobrenome</label>
                            <?php if (isset($errors['last_name'])): ?>
                                <p class="erro invalid-feedback d-block"><?= e($errors['last_name']) ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3">
                            <input id="email" name="email" type="email" required maxlength="150"
                                   placeholder="nome@exemplo.com"
                                   class="form-control<?= isset($errors['email']) ? ' is-invalid' : '' ?>"
                                   value="<?= e($old['email'] ?? '') ?>">
                            <label for="email">E-mail</label>
                            <?php if (isset($errors['email'])): ?>
                                <p class="erro invalid-feedback d-block"><?= e($errors['email']) ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3">
                            <input id="cpf" name="cpf" type="text" required inputmode="numeric" maxlength="14"
                                   placeholder="000.000.000-00" autocomplete="off"
                                   class="form-control<?= isset($errors['cpf']) ? ' is-invalid' : '' ?>"
                                   value="<?= e($old['cpf'] ?? '') ?>">
                            <label for="cpf">CPF</label>
                            <?php if (isset($errors['cpf'])): ?>
                                <p class="erro invalid-feedback d-block"><?= e($errors['cpf']) ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3">
                            <input id="birth_date" name="birth_date" type="date" required
                                   min="1900-01-01" max="<?= e(date('Y-m-d')) ?>"
                                   class="form-control<?= isset($errors['birth_date']) ? ' is-invalid' : '' ?>"
                                   value="<?= e($old['birth_date'] ?? '') ?>">
                            <label for="birth_date">Data de nascimento</label>
                            <?php if (isset($errors['birth_date'])): ?>
                                <p class="erro invalid-feedback d-block"><?= e($errors['birth_date']) ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3">
                            <input id="password" name="password" type="password"
                                   <?= $editing ? '' : 'required' ?> minlength="8" maxlength="72"
                                   placeholder="Senha" autocomplete="new-password"
                                   class="form-control<?= isset($errors['password']) ? ' is-invalid' : '' ?>">
                            <label for="password"><?= $editing ? 'Nova senha (opcional)' : 'Senha' ?></label>
                            <?php if (isset($errors['password'])): ?>
                                <p class="erro invalid-feedback d-block"><?= e($errors['password']) ?></p>
                            <?php endif; ?>
                            <div class="form-text">
                                <?= $editing
                                    ? 'Deixe em branco para manter a senha atual. Mínimo de 8 caracteres.'
                                    : 'Mínimo de 8 caracteres.' ?>
                            </div>
                        </div>

                        <div class="form-floating mb-3">
                            <input id="password_confirm" name="password_confirm" type="password"
                                   minlength="8" maxlength="72"
                                   placeholder="Confirmar senha" autocomplete="new-password"
                                   class="form-control<?= isset($errors['password_confirm']) ? ' is-invalid' : '' ?>">
                            <label for="password_confirm">Confirmar senha</label>
                            <?php if (isset($errors['password_confirm'])): ?>
                                <p class="erro invalid-feedback d-block"><?= e($errors['password_confirm']) ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <?= $editing ? 'Salvar alterações' : 'Salvar' ?>
                            </button>
                            <?php if ($editing): ?>
                                <a href="<?= e(url('user/index')) ?>" class="btn btn-outline-secondary">Cancelar</a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
