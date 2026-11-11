<?php
namespace App\Models;

// Database pertence ao mesmo namespace App\Models.

class User 
{
    public static function all(): array
    {
        return Database::connect()
            ->query('SELECT id, name, email FROM users ORDER BY name')
            ->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $stmt = Database::connect()->prepare(
            'SELECT id, name, email FROM users WHERE id = ?'
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

    public static function create(string $name, string $last_name, string $email, int $cpf): int
    {
        $stmt = Database::connect()->prepare(
            'INSERT INTO users (name, last_name, email, cpf) VALUES (?, ?, ?, ?)'
        );
        $stmt->execute([$name, $last_name, $email, $cpf]);
        return (int) Database::connect()->lastInsertId();
    }
}
