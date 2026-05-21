<?php

declare(strict_types=1);

namespace App\Utils;

final class Sanitizer
{
    public static function string(mixed $value, int $maxLength = 255): string
    {
        $text = trim((string) $value);
        $text = strip_tags($text);
        if (strlen($text) > $maxLength) {
            $text = substr($text, 0, $maxLength);
        }
        return $text;
    }

    public static function email(mixed $value): string
    {
        return filter_var(trim((string) $value), FILTER_SANITIZE_EMAIL) ?: '';
    }

    public static function int(mixed $value, int $min = 0, int $max = PHP_INT_MAX): int
    {
        $number = filter_var($value, FILTER_VALIDATE_INT);
        if ($number === false) {
            return $min;
        }
        return max($min, min($max, (int) $number));
    }

    public static function escape(mixed $value): string
    {
        return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
