<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title ?? 'Projeto MVC') ?></title>

    <link rel="icon" href="<?= e(asset('img/logo.png')) ?>">
    <!-- Bootstrap primeiro; o estilo.css vem depois para poder ajustar. -->
    <link rel="stylesheet" href="<?= e(asset('css/bootstrap.min.css')) ?>">
    <link rel="stylesheet" href="<?= e(asset('css/estilo.css')) ?>">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-sm navbar-dark topo">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2"
               href="<?= e(url('user/index')) ?>">
                <img src="<?= e(asset('img/logo.png')) ?>" alt="Logo do projeto"
                     width="40" height="40">
                Projeto MVC
            </a>
            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#menu"
                    aria-controls="menu" aria-expanded="false"
                    aria-label="Alternar menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= e(url('user/index')) ?>">Usuários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= e(url('user/create')) ?>">Novo usuário</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-4">
        <?= $content ?>
    </main>

    <script src="<?= e(asset('js/bootstrap.bundle.min.js')) ?>"></script>
    <script src="<?= e(asset('js/app.js')) ?>" defer></script>
</body>
</html>
