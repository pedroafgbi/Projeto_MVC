<?php
declare(strict_types=1);

// 0) Caminho base: '/projeto_mvc' em subpasta, '' em VirtualHost
$base = dirname(dirname($_SERVER['SCRIPT_NAME']));
define('BASE_URL', rtrim(str_replace('\\', '/', $base), '/'));

// Session cookie expires when the browser is closed.
ini_set('session.use_strict_mode', '1');
session_set_cookie_params([
    'lifetime' => 0,
    'path' => BASE_URL !== '' ? BASE_URL : '/',
    'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
    'httponly' => true,
    'samesite' => 'Lax',
]);
session_start();

if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

// 1) Autoload
spl_autoload_register(function (string $class) {
    $file = __DIR__ . '/../app/'
        . str_replace(['App\\', '\\'], ['', '/'], $class) . '.php';
    if (is_file($file))
        require $file;
});

require __DIR__ . '/../app/helpers.php';

// 2) Interpretação da URL
$url = explode('/', trim(($_GET['url'] ?? '') ?: 'home/index', '/'));
$controller = 'App\\Controllers\\' . ucfirst($url[0]) . 'Controller';
$method = $url[1] ?? 'index';
$params = array_slice($url, 2);

// Only login and registration are available without an authenticated account.
$route = strtolower($url[0] . '/' . $method);
$publicRoutes = ['auth/login', 'auth/authenticate', 'user/create', 'user/store'];
if (!in_array($route, $publicRoutes, true)) {
    $userId = filter_var($_SESSION['user_id'] ?? null, FILTER_VALIDATE_INT);
    $currentUser = $userId ? App\Models\User::find($userId) : null;
    if (!$currentUser || (int) $currentUser['active'] !== 1) {
        unset($_SESSION['user_id']);
        header('Location: ' . url('auth/login'));
        exit;
    }
}

// 3) Validação e despacho
if (!class_exists($controller) || !method_exists($controller, $method)) {
    http_response_code(404);
    exit("Página não encontrada");
}

(new $controller())->$method(...$params);