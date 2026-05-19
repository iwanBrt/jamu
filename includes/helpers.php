<?php

declare(strict_types=1);

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function rupiah(float|int|string $value): string
{
    return 'Rp' . number_format((float) $value, 0, ',', '.');
}

function compact_number(int|string $value): string
{
    $number = (int) $value;

    if ($number >= 1000000) {
        return rtrim(rtrim(number_format($number / 1000000, 1, ',', ''), '0'), ',') . 'jt';
    }

    if ($number >= 1000) {
        return rtrim(rtrim(number_format($number / 1000, 1, ',', ''), '0'), ',') . 'k';
    }

    return (string) $number;
}

function redirect(string $path): never
{
    header('Location: ' . $path);
    exit;
}

