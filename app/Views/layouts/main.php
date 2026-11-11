<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= e($title ?? 'Projeto MVC') ?></title>

    <link rel="icon" href="<?= e(asset('img/logo.png')) ?>">
    <!-- Bootstrap Icons (CDN, como no template original) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Tema Modern Business (Start Bootstrap): já inclui o Bootstrap -->
    <link rel="stylesheet" href="<?= e(asset('css/styles.css')) ?>">
    <!-- Ajustes do projeto: sempre depois do tema -->
    <link rel="stylesheet" href="<?= e(asset('css/estilo.css')) ?>">
</head>
<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <!-- Navegação -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-5">
                <a class="navbar-brand d-flex align-items-center gap-2"
                   href="<?= e(url('user/index')) ?>">
                    <img src="<?= e(asset('img/logo.png')) ?>" alt="Logo do projeto"
                         width="32" height="32">
                    Projeto MVC
                </a>
                <button class="navbar-toggler" type="button"
                        data-bs-toggle="collapse" data-bs-target="#menu"
                        aria-controls="menu" aria-expanded="false"
                        aria-label="Alternar menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="menu">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
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

        <!-- Conteúdo da view (já escapado dentro dela) -->
        <?= $content ?>
    </main>

    <!-- Rodapé -->
    <footer class="bg-dark py-4 mt-auto">
        <div class="container px-5">
            <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                <div class="col-auto">
                    <div class="small m-0 text-white">Projeto MVC em PHP &copy; <?= date('Y') ?></div>
                </div>
                <div class="col-auto">
                    <span class="small text-white-50">Programação de Sistemas para Web I</span>
                </div>
            </div>
        </div>
    </footer>

    <script src="<?= e(asset('js/bootstrap.bundle.min.js')) ?>"></script>
    <script src="<?= e(asset('js/app.js')) ?>" defer></script>
</body>
</html>
