<?php
namespace App\Models;

// Database pertence ao mesmo namespace App\Models.

class User
{
    // Colunas devolvidas ao PHP. A senha (hash) NUNCA sai daqui.
    private const COLUMNS = 'id_user, name, last_name, email, cpf, birth_date, active';

    /** Lista os usuários ativos (padrão) ou os inativos. */
    public static function all(bool $active = true): array
    {
        $stmt = Database::connect()->prepare(
            'SELECT ' . self::COLUMNS . ' FROM users WHERE active = ? ORDER BY name'
        );
        $stmt->execute([$active ? 1 : 0]);
        return $stmt->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $stmt = Database::connect()->prepare(
            'SELECT ' . self::COLUMNS . ' FROM users WHERE id_user = ?'
        );
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public static function authenticate(string $email, string $password): ?array
    {
        $stmt = Database::connect()->prepare(
            'SELECT ' . self::COLUMNS . ', password FROM users WHERE email = ? AND active = 1'
        );
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if (!$user || !password_verify($password, $user['password'])) {
            return null;
        }

        unset($user['password']);
        return $user;
    }

    /** $ignoreId: na edição, ignora o próprio usuário. */
    public static function emailExists(string $email, int $ignoreId = 0): bool
    {
        $stmt = Database::connect()->prepare(
            'SELECT 1 FROM users WHERE email = ? AND id_user <> ?'
        );
        $stmt->execute([$email, $ignoreId]);
        return (bool) $stmt->fetchColumn();
    }

    /** $cpf deve vir somente com os 11 dígitos. */
    public static function cpfExists(string $cpf, int $ignoreId = 0): bool
    {
        $stmt = Database::connect()->prepare(
            'SELECT 1 FROM users WHERE cpf = ? AND id_user <> ?'
        );
        $stmt->execute([$cpf, $ignoreId]);
        return (bool) $stmt->fetchColumn();
    }

    /** $birthDate no formato AAAA-MM-DD; $passwordHash vem de password_hash(). */
    public static function create(
        string $name,
        string $lastName,
        string $email,
        string $cpf,
        string $birthDate,
        string $passwordHash
    ): int {
        $stmt = Database::connect()->prepare(
            'INSERT INTO users (name, last_name, email, cpf, birth_date, password)
             VALUES (?, ?, ?, ?, ?, ?)'
        );
        $stmt->execute([$name, $lastName, $email, $cpf, $birthDate, $passwordHash]);
        return (int) Database::connect()->lastInsertId();
    }

    public static function update(
        int $id,
        string $name,
        string $lastName,
        string $email,
        string $cpf,
        string $birthDate
    ): void {
        $stmt = Database::connect()->prepare(
            'UPDATE users
                SET name = ?, last_name = ?, email = ?, cpf = ?, birth_date = ?
              WHERE id_user = ?'
        );
        $stmt->execute([$name, $lastName, $email, $cpf, $birthDate, $id]);
    }

    public static function updatePassword(int $id, string $passwordHash): void
    {
        $stmt = Database::connect()->prepare(
            'UPDATE users SET password = ? WHERE id_user = ?'
        );
        $stmt->execute([$passwordHash, $id]);
    }

    public static function delete(int $id): void
    {
        $stmt = Database::connect()->prepare(
            'DELETE FROM users WHERE id_user = ?'
        );
        $stmt->execute([$id]);
    }

    /** Inativar (false) ou reativar (true). O cadastro não é apagado. */
    public static function setActive(int $id, bool $active): void
    {
        $stmt = Database::connect()->prepare(
            'UPDATE users SET active = ? WHERE id_user = ?'
        );
        $stmt->execute([$active ? 1 : 0, $id]);
    }

    public static function isAdmin(int $id): bool
{
    $stmt = Database::connect()->prepare(
        "SELECT role FROM users
         WHERE id_user = ? AND active = 1"
    );

    $stmt->execute([$id]);

    return $stmt->fetchColumn() === 'admin';
    }
}
