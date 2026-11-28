<?php
namespace App\Validators;

class UserValidator
{
    /**
     * @param bool $requirePassword true no cadastro; false na edição
     *                              (senha em branco = manter a atual).
     * @return array<string,string> campo => mensagem de erro
     */
    public function validate(array $input, bool $requirePassword = true): array
    {
        $errors = [];

        $name = $input['name'] ?? '';
        if (!is_string($name) || trim($name) === '') {
            $errors['name'] = 'Informe o nome.';
        } elseif (mb_strlen($name) > 100) {
            $errors['name'] = 'O nome deve ter no máximo 100 caracteres.';
        }

        $last = $input['last_name'] ?? '';
        if (!is_string($last) || trim($last) === '') {
            $errors['last_name'] = 'Informe o sobrenome.';
        } elseif (mb_strlen($last) > 100) {
            $errors['last_name'] = 'O sobrenome deve ter no máximo 100 caracteres.';
        }

        $email = $input['email'] ?? '';
        if (
            !is_string($email) || mb_strlen($email) > 150
            || !filter_var($email, FILTER_VALIDATE_EMAIL)
        ) {
            $errors['email'] = 'Informe um e-mail válido.';
        }

        $cpf = $input['cpf'] ?? '';
        if (!is_string($cpf) || trim($cpf) === '') {
            $errors['cpf'] = 'Informe o CPF.';
        } elseif (!$this->cpfValido($cpf)) {
            $errors['cpf'] = 'Informe um CPF válido.';
        }

        $birth = $input['birth_date'] ?? '';
        if (!is_string($birth) || trim($birth) === '') {
            $errors['birth_date'] = 'Informe a data de nascimento.';
        } else {
            $data = \DateTime::createFromFormat('!Y-m-d', $birth);
            if (!$data || $data->format('Y-m-d') !== $birth) {
                $errors['birth_date'] = 'Informe uma data de nascimento válida.';
            } elseif ($data > new \DateTime('today')) {
                $errors['birth_date'] = 'A data de nascimento não pode ser no futuro.';
            } elseif ($data < new \DateTime('1900-01-01')) {
                $errors['birth_date'] = 'Informe uma data a partir de 1900.';
            }
        }

        // A senha não passa por trim(): espaços fazem parte dela.
        $password = $input['password'] ?? '';
        $confirm  = $input['password_confirm'] ?? '';
        if (!is_string($password) || !is_string($confirm)) {
            $errors['password'] = 'Senha inválida.';
        } elseif ($password === '' && !$requirePassword) {
            // Edição com senha em branco: mantém a senha atual.
        } elseif ($password === '') {
            $errors['password'] = 'Informe a senha.';
        } elseif (strlen($password) < 8) {
            $errors['password'] = 'A senha deve ter no mínimo 8 caracteres.';
        } elseif (strlen($password) > 72) {
            $errors['password'] = 'A senha deve ter no máximo 72 caracteres.';
        } elseif ($confirm !== $password) {
            $errors['password_confirm'] = 'As senhas não conferem.';
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
