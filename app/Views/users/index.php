<a href="<?= e(url('user')) ?>" class="btn btn-outline-secondary btn-sm mb-3">Voltar</a>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h2 mb-0"><?= e($title) ?></h1>
    <a href="<?= e(url('user/create')) ?>" class="btn btn-primary">Novo usuário</a>
</div>

<ul class="list-group lista">
<?php foreach ($users as $u): ?>
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <a href="<?= e(url('user/show/' . (int) $u['id'])) ?>">
            <?= e($u['name']) ?>
        </a>
        <span class="text-muted"><?= e($u['email']) ?></span>
    </li>
<?php endforeach; ?>
</ul>
