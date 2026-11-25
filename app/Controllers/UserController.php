<?php
namespace App\Controllers;

use App\Models\User;
use App\Validators\UserValidator;

class UserController
{
    /** Lista de usuários. Use ?status=inativos para ver os inativos. */
    public function index(): void
    {
        $inactive = ($_GET['status'] ?? '') === 'inativos';

        $this->render('users/index', [
            'title'  => $inactive ? 'Usuários inativos' : 'Usuários',
            'users'  => User::all(!$inactive),
            'status' => $inactive ? 'inativos' : 'ativos',
            'single' => false,
            'flash'  => $this->takeFlash(),
            'csrf'   => $this->csrfToken(),
        ]);
    }

    public function show(string $id = ''): void
    {
        $user = $this->findOr404($id);

        $this->render('users/index', [
            'title'  => 'Usuário',
            'users'  => [$user],
            'status' => (int) $user['active'] === 1 ? 'ativos' : 'inativos',
            'single' => true,
            'flash'  => null,
            'csrf'   => $this->csrfToken(),
        ]);
    }

    public function profile(): void
    {
        $user = $this->currentUser();
        $this->render('users/profile', [
            'title' => 'Meu perfil',
            'user' => $user,
            'csrf' => $this->csrfToken(),
            'flash' => $this->takeFlash(),
        ]);
    }

    public function deleteAccount(): void
    {
        $this->requirePost();
        $this->checkCsrf();

        $user = $this->currentUser();
        User::delete((int) $user['id_user']);
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

    /* ---------- Cadastro ---------- */

    public function create(): void
    {
        $this->renderForm([], []);
    }

    public function store(): void
    {
        $this->requirePost();
        $this->checkCsrf();

        $input = $this->readInput();
        // No banco o CPF é guardado só com os dígitos.
        $cpf = preg_replace('/\D/', '', $input['cpf']);

        $errors = (new UserValidator())->validate($input);
        $errors = $this->checkDuplicates($errors, $input, $cpf);

        if ($errors) {
            http_response_code(422);
            $this->renderForm($this->withoutPasswords($input), $errors);
            return;
        }

        User::create(
            $input['name'],
            $input['last_name'],
            $input['email'],
            $cpf,
            $input['birth_date'],
            password_hash($input['password'], PASSWORD_DEFAULT)
        );
        $this->flash('Cadastro realizado. Entre com seu e-mail e senha.');
        $this->redirect('auth/login');
    }

    /* ---------- Edição ---------- */

    public function edit(string $id = ''): void
    {
        $user = $this->findOwnedOr404($id, true); 

        $old = [
            'name'       => $user['name'],
            'last_name'  => $user['last_name'],
            'email'      => $user['email'],
            'cpf'        => format_cpf($user['cpf']),
            'birth_date' => $user['birth_date'],
        ];
        $this->renderForm($old, [], $user);
    }

    public function update(string $id = ''): void
    {
        $this->requirePost();
        $this->checkCsrf();

        $user = $this->findOwnedOr404($id, true);
        $userId = (int) $user['id_user'];

        $input = $this->readInput();
        $cpf = preg_replace('/\D/', '', $input['cpf']);

        // Senha em branco = mantém a atual.
        $errors = (new UserValidator())->validate($input, false);
        $errors = $this->checkDuplicates($errors, $input, $cpf, $userId);

        if ($errors) {
            http_response_code(422);
            $this->renderForm($this->withoutPasswords($input), $errors, $user);
            return;
        }

        User::update(
            $userId,
            $input['name'],
            $input['last_name'],
            $input['email'],
            $cpf,
            $input['birth_date']
        );
        if ($input['password'] !== '') {
            User::updatePassword($userId, password_hash($input['password'], PASSWORD_DEFAULT));
        }

        $this->flash('Dados atualizados com sucesso.');
        $this->redirect('user/profile');
    }

    /* ---------- Inativar / reativar ---------- */

    public function inactivate(string $id = ''): void
    {
        $this->requirePost();
        $this->checkCsrf();

        $user = $this->findOwnedOr404($id);
        User::setActive((int) $user['id_user'], false);

        $this->flash('Usuário inativado.');
        $this->redirect('user/index');
    }

    public function activate(string $id = ''): void
    {
        $this->requirePost();
        $this->checkCsrf();

        $user = $this->findOwnedOr404($id);
        User::setActive((int) $user['id_user'], true);

        $this->flash('Usuário reativado.');
        $this->redirect('user/index');
    }

    /* ---------- Apoio (privados) ---------- */

    private function requirePost(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Método não permitido');
        }
    }

    /** Busca o usuário; 404 se não existir; 403 se inativo e $mustBeActive. */
    private function findOr404(string $id, bool $mustBeActive = false): array
    {
        $user = User::find((int) $id);
        if (!$user) {
            http_response_code(404);
            exit('Usuário não encontrado');
        }
        if ($mustBeActive && (int) $user['active'] !== 1) {
            http_response_code(403);
            exit('Usuário inativo. Reative-o para editar.');
        }
        return $user;
    }

    private function findOwnedOr404(string $id, bool $mustBeActive = false): array
    {
        $user = $this->findOr404($id, $mustBeActive);
        if ((int) $user['id_user'] !== (int) ($_SESSION['user_id'] ?? 0)) {
            http_response_code(403);
            exit('Você só pode alterar os dados da sua própria conta.');
        }
        return $user;
    }

    private function currentUser(): array
    {
        $user = User::find((int) ($_SESSION['user_id'] ?? 0));
        if (!$user || (int) $user['active'] !== 1) {
            http_response_code(401);
            exit('Sessão inválida. Entre novamente.');
        }
        return $user;
    }

    private function readInput(): array
    {
        return [
            'name'             => trim($_POST['name'] ?? ''),
            'last_name'        => trim($_POST['last_name'] ?? ''),
            'email'            => trim($_POST['email'] ?? ''),
            'cpf'              => trim($_POST['cpf'] ?? ''),
            'birth_date'       => trim($_POST['birth_date'] ?? ''),
            'password'         => $_POST['password'] ?? '',
            'password_confirm' => $_POST['password_confirm'] ?? '',
        ];
    }

    /** Nunca devolve a senha para o formulário. */
    private function withoutPasswords(array $input): array
    {
        unset($input['password'], $input['password_confirm']);
        return $input;
    }

    /** Confere e-mail e CPF repetidos (na edição, ignora o próprio usuário). */
    private function checkDuplicates(array $errors, array $input, string $cpf, int $ignoreId = 0): array
    {
        if (!isset($errors['email']) && User::emailExists($input['email'], $ignoreId)) {
            $errors['email'] = 'Este e-mail já está cadastrado.';
        }
        if (!isset($errors['cpf']) && User::cpfExists($cpf, $ignoreId)) {
            $errors['cpf'] = 'Este CPF já está cadastrado.';
        }
        return $errors;
    }

    private function renderForm(array $old, array $errors, ?array $editing = null): void
    {
        $this->render('users/form', [
            'title'    => $editing ? 'Editar usuário' : 'Novo usuário',
            'subtitle' => $editing ? 'Altere os dados e salve' : 'Preencha os dados para cadastrar',
            'action'   => $editing ? 'user/update/' . (int) $editing['id_user'] : 'user/store',
            'editing'  => $editing !== null,
            'errors'   => $errors,
            'old'      => $old,
            'csrf'     => $this->csrfToken(),
        ]);
    }

    private function redirect(string $path): void
    {
        header('Location: ' . url($path));
        exit;
    }

    private function startSession(): void
    {
        session_status() === PHP_SESSION_NONE && session_start();
    }

    /** Guarda uma mensagem para a próxima tela. */
    private function flash(string $message): void
    {
        $this->startSession();
        $_SESSION['flash'] = $message;
    }

    /** Lê e apaga a mensagem guardada. */
    private function takeFlash(): ?string
    {
        $this->startSession();
        $message = $_SESSION['flash'] ?? null;
        unset($_SESSION['flash']);
        return $message;
    }

    private function csrfToken(): string
    {
        $this->startSession();
        return $_SESSION['csrf'] ??= bin2hex(random_bytes(32));
    }

    private function checkCsrf(): void
    {
        $this->startSession();
        $token = $_POST['csrf'] ?? '';
        if (!is_string($token) || !hash_equals($_SESSION['csrf'] ?? '', $token)) {
            http_response_code(403);
            exit('Token inválido');
        }
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
        $vars = $data + ['content' => $content];
        echo $renderFile($base . 'layouts/main.php', $vars);
    }
}
