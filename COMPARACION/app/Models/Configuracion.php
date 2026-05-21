<?php

declare(strict_types=1);

namespace App\Models;

use App\Config\Database;

final class Configuracion
{
    /** @return array<string, string> */
    public static function all(): array
    {
        $stmt = Database::connection()->query('SELECT clave, valor FROM configuracion');
        $rows = $stmt->fetchAll();
        $config = [];
        foreach ($rows as $row) {
            $config[$row['clave']] = $row['valor'];
        }
        return $config;
    }

    public static function get(string $clave, string $default = ''): string
    {
        $stmt = Database::connection()->prepare(
            'SELECT valor FROM configuracion WHERE clave = :clave LIMIT 1'
        );
        $stmt->execute(['clave' => $clave]);
        $value = $stmt->fetchColumn();
        return $value !== false ? (string) $value : $default;
    }

    public static function set(string $clave, string $valor): void
    {
        $stmt = Database::connection()->prepare(
            'INSERT INTO configuracion (clave, valor) VALUES (:clave, :valor)
             ON DUPLICATE KEY UPDATE valor = VALUES(valor)'
        );
        $stmt->execute(['clave' => $clave, 'valor' => $valor]);
    }
}
