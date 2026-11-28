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

<body class="d-flex flex-column h-100 eco-app">
    <main class="flex-shrink-0">
        <!-- Navegação -->
        <nav class="navbar navbar-expand-lg eco-navbar">
            <div class="container px-5">
                <a class="navbar-brand d-flex align-items-center gap-2" href="<?= e(url('home/index')) ?>">
                    <span class="brand-mark"><i class="bi bi-leaf-fill"></i></span>
                    <span>Eco<span>Mente</span></span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu"
                    aria-controls="menu" aria-expanded="false" aria-label="Alternar menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="menu">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <?php if (
                            !empty($_SESSION['user_id']) &&
                            \App\Models\User::isAdmin((int) $_SESSION['user_id'])
                        ): ?>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= e(url('quiz/index')) ?>">
                                    <i class="bi bi-gear"></i>
                                    Gerenciar quizzes
                                </a>
                            </li>

                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= e(url('home/index')) ?>"><i class="bi bi-house"></i> Início</a>
                        </li>
                        <?php if (!empty($_SESSION['user_id'])): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= e(url('user/index')) ?>"><i class="bi bi-people"></i> Usuários</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <?php if (!empty($_SESSION['user_id'])): ?>
                        <a class="nav-link eco-nav-action ms-lg-3" href="<?= e(url('user/profile')) ?>"><i class="bi bi-person-circle"></i> Perfil</a>
                        <form method="post" action="<?= e(url('auth/logout')) ?>" class="ms-lg-3">
                            <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf'] ?? '') ?>">
                            <button type="submit" class="btn eco-btn-outline btn-sm">Sair</button>
                        </form>
                    <?php else: ?>
                        <a class="nav-link eco-nav-action ms-lg-3" href="<?= e(url('auth/login')) ?>">Entrar</a>
                        <a class="btn eco-btn btn-sm ms-lg-3" href="<?= e(url('user/create')) ?>">Cadastre-se</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>

        <!-- Conteúdo da view (já escapado dentro dela) -->
        <?= $content ?>
    </main>

    <!-- Rodapé -->
    <footer class="eco-footer py-4 mt-auto">
        <div class="container px-5">
            <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                <div class="col-auto">
                    <div class="small m-0 text-white"><i class="bi bi-leaf me-1"></i> EcoMente &copy; <?= date('Y') ?></div>
                </div>
                <div class="col-auto">
                    <span class="small">Educação ambiental e consumo consciente</span>
                </div>
            </div>
        </div>
    </footer>

    <script src="<?= e(asset('js/bootstrap.bundle.min.js')) ?>"></script>
</body>

</html>