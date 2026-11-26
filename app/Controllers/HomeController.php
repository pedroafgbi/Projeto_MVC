<?php
namespace App\Controllers;

use App\Models\Quiz;

class HomeController
{
    /** Página principal (rota padrão: abre ao entrar no localhost). */
    public function index(): void
    {
        $this->render('home/index', [
            'title' => 'Início',
            'quizzes' => Quiz::allWithContent(),
        ]);
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
        echo $renderFile($base . 'layouts/home.php', $vars);
    }
}
