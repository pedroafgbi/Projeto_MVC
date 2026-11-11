<?php
namespace App\Models;

// Database pertence ao mesmo namespace App\Models.

class User
{
    public static function all(): array
    {
        return Database::connect()
            ->query('SELECT id, name, last_name, email, cpf, birth_date FROM users ORDER BY name')
            ->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $stmt = Database::connect()->prepare(
            'SELECT id, name, last_name, email, cpf, birth_date FROM users WHERE id = ?'
        );
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public static function emailExists(string $email): bool
    {
        $stmt = Database::connect()->prepare('SELECT 1 FROM users WHERE email = ?');
        $stmt->execute([$email]);
        return (bool) $stmt->fetchColumn();
    }

    /** $cpf deve vir somente com os 11 dígitos. */
    public static function cpfExists(string $cpf): bool
    {
        $stmt = Database::connect()->prepare('SELECT 1 FROM users WHERE cpf = ?');
        $stmt->execute([$cpf]);
        return (bool) $stmt->fetchColumn();
    }

    /** $birthDate no formato AAAA-MM-DD. */
    public static function create(
        string $name,
        string $lastName,
        string $email,
        string $cpf,
        string $birthDate
    ): int {
        $stmt = Database::connect()->prepare(
            'INSERT INTO users (name, last_name, email, cpf, birth_date) VALUES (?, ?, ?, ?, ?)'
        );
        $stmt->execute([$name, $lastName, $email, $cpf, $birthDate]);
        return (int) Database::connect()->lastInsertId();
    }
}