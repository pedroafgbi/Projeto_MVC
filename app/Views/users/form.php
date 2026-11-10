<a href="<?= e(url('user')) ?>" class="btn btn-outline-secondary btn-sm mb-3">Voltar</a>

<h1 class="h2 mb-3"><?= e($title) ?></h1>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="post" action="<?= e(url('user/store')) ?>" data-validate>
            <input type="hidden" name="csrf" value="<?= e($csrf) ?>">

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input id="name" name="name" required maxlength="100"
                       class="form-control<?= isset($errors['name']) ? ' is-invalid' : '' ?>"
                       value="<?= e($old['name'] ?? '') ?>">
                <?php if (isset($errors['name'])): ?>
                    <p class="erro invalid-feedback d-block"><?= e($errors['name']) ?></p>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input id="email" type="email" name="email" required maxlength="150"
                       class="form-control<?= isset($errors['email']) ? ' is-invalid' : '' ?>"
                       value="<?= e($old['email'] ?? '') ?>">
                <?php if (isset($errors['email'])): ?>
                    <p class="erro invalid-feedback d-block"><?= e($errors['email']) ?></p>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</div>
