<?php
namespace App\Validators;

class UserValidator
{
    /** @return array<string,string> campo => mensagem de erro */
    public function validate(array $input): array
    {
        $errors = [];

        $name = $input['name'] ?? '';
        if (!is_string($name) || trim($name) === '') {
            $errors['name'] = 'Informe o nome.';
        } elseif (mb_strlen($name) > 100) {
            $errors['name'] = 'O nome deve ter no máximo 100 caracteres.';
        }

        $email = $input['email'] ?? '';
        if (
            !is_string($email) || mb_strlen($email) > 150
            || !filter_var($email, FILTER_VALIDATE_EMAIL)
        ) {
            $errors['email'] = 'Informe um e-mail válido.';
        }

        $last = $input['last_name'] ?? '';
        if (!is_string($last) || trim($last) === '') {
            $errors['last_name'] = 'Informe o sobrenome.';
        } elseif (mb_strlen($last) > 100) {
            $errors['last_name'] = 'O sobrenome deve ter no máximo 100 caracteres.';
        }

        $cpf = $input['cpf'] ?? '';
        if (!is_string($cpf) || trim($cpf) === '') {
            $errors['cpf'] = 'Informe o CPF.';
        } elseif (!$this->cpfValido($cpf)) {
            $errors['cpf'] = 'Informe um CPF válido.';
        }

        return $errors;
    }

    /** Aceita com ou sem pontuação (000.000.000-00 ou 00000000000). */
    private function cpfValido(string $cpf): bool
    {
        $cpf = preg_replace('/\D/', '', $cpf);

        if (strlen($cpf) !== 11 || preg_match('/^(\d)\1{10}$/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            $soma = 0;
            for ($i = 0; $i < $t; $i++) {
                $soma += (int) $cpf[$i] * (($t + 1) - $i);
            }
            $digito = ((10 * $soma) % 11) % 10;
            if ((int) $cpf[$t] !== $digito) {
                return false;
            }
        }
        return true;
    }
}
