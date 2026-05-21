<?php

declare(strict_types=1);

namespace App\Models;

use App\Config\Database;
use PDO;

final class Usuario
{
    public static function findByLogin(string $login): ?array
    {
        $stmt = Database::connection()->prepare(
            'SELECT id, login, nombre, password_hash, rol, videos_generados, activo, created_at
             FROM usuarios WHERE login = :login AND activo = 1 LIMIT 1'
        );
        $stmt->execute(['login' => $login]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function findById(int $id): ?array
    {
        $stmt = Database::connection()->prepare(
            'SELECT id, login, nombre, rol, videos_generados, created_at
             FROM usuarios WHERE id = :id AND activo = 1 LIMIT 1'
        );
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /** @return array<int, array<string, mixed>> */
    public static function listDocentes(int $page = 1, int $perPage = 20): array
    {
        $offset = ($page - 1) * $perPage;
        $stmt = Database::connection()->prepare(
            'SELECT id, login, nombre, videos_generados, created_at
             FROM usuarios WHERE rol = :rol AND activo = 1
             ORDER BY created_at DESC
             LIMIT :limit OFFSET :offset'
        );
        $stmt->bindValue(':rol', 'docente');
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function countDocentes(): int
    {
        $stmt = Database::connection()->query(
            "SELECT COUNT(*) FROM usuarios WHERE rol = 'docente' AND activo = 1"
        );
        return (int) $stmt->fetchColumn();
    }

    public static function createDocente(string $login, string $nombre, string $passwordHash): int
    {
        $stmt = Database::connection()->prepare(
            'INSERT INTO usuarios (login, nombre, password_hash, rol) VALUES (:login, :nombre, :hash, :rol)'
        );
        $stmt->execute([
            'login' => $login,
            'nombre' => $nombre,
            'hash' => $passwordHash,
            'rol' => 'docente',
        ]);
        return (int) Database::connection()->lastInsertId();
    }

    public static function softDelete(int $id): bool
    {
        $stmt = Database::connection()->prepare(
            'UPDATE usuarios SET activo = 0 WHERE id = :id AND rol = :rol'
        );
        return $stmt->execute(['id' => $id, 'rol' => 'docente']);
    }

    public static function loginExists(string $login, ?int $excludeId = null): bool
    {
        $sql = 'SELECT COUNT(*) FROM usuarios WHERE login = :login';
        $params = ['login' => $login];
        if ($excludeId !== null) {
            $sql .= ' AND id != :id';
            $params['id'] = $excludeId;
        }
        $stmt = Database::connection()->prepare($sql);
        $stmt->execute($params);
        return (int) $stmt->fetchColumn() > 0;
    }
}
