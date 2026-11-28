<?php
namespace App\Controllers;

use App\Models\User;

class AuthController
{
    public function login(): void
    {
        $userId = filter_var($_SESSION['user_id'] ?? null, FILTER_VALIDATE_INT);
        $user = $userId ? User::find($userId) : null;
        if ($user && (int) $user['active'] === 1) {
            $this->redirect('user/profile');
        }

        unset($_SESSION['user_id']);
        $this->render('auth/login', [
            'title' => 'Entrar',
            'error' => null,
            'csrf' => $this->csrfToken(),
            'flash' => $this->takeFlash(),
        ]);
    }

    public function authenticate(): void
    {
        $this->requirePost();
        $this->checkCsrf();

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $user = is_string($email) && is_string($password)
            ? User::authenticate(trim($email), $password)
            : null;

        if (!$user) {
            http_response_code(422);
            $this->render('auth/login', [
                'title' => 'Entrar',
                'error' => 'E-mail ou senha inválidos.',
                'csrf' => $this->csrfToken(),
                'email' => is_string($email) ? trim($email) : '',
                'flash' => null,
            ]);
            return;
        }

        session_regenerate_id(true);
        $_SESSION['user_id'] = (int) $user['id_user'];
        $this->redirect('home/index');
    }

    public function logout(): void
    {
        $this->requirePost();
        $this->checkCsrf();

        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', [
                'expires' => time() - 42000,
                'path' => $params['path'],
                'domain' => $params['domain'],
                'secure' => $params['secure'],
                'httponly' => $params['httponly'],
                'samesite' => $params['samesite'] ?? 'Lax',
            ]);
        }
        session_destroy();
        $this->redirect('auth/login');
    }

    private function requirePost(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Método não permitido');
        }
    }

    private function csrfToken(): string
    {
        return $_SESSION['csrf'] ??= bin2hex(random_bytes(32));
    }

    private function takeFlash(): ?string
    {
        $message = $_SESSION['flash'] ?? null;
        unset($_SESSION['flash']);
        return is_string($message) ? $message : null;
    }

    private function checkCsrf(): void
    {
        $token = $_POST['csrf'] ?? '';
        if (!is_string($token) || !hash_equals($_SESSION['csrf'] ?? '', $token)) {
            http_response_code(403);
            exit('Token inválido');
        }
    }

    private function redirect(string $path): void
    {
        header('Location: ' . url($path));
        exit;
    }

    private function render(string $view, array $data = []): void
    {
        $base = __DIR__ . '/../Views/';

        $renderFile = static function (string $__file, array $__data): string {
            extract($__data, EXTR_SKIP);
            ob_start();
            require $__file;
            return ob_get_clean();
        };

        $content = $renderFile($base . $view . '.php', $data);
        echo $renderFile($base . 'layouts/main.php', $data + ['content' => $content]);
    }
}
