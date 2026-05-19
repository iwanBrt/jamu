<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

function active_products(): array
{
    $stmt = db()->query(
        "SELECT p.*, c.name AS category_name
         FROM products p
         LEFT JOIN categories c ON c.id = p.category_id
         WHERE p.is_active = 1
         ORDER BY p.is_best_seller DESC, p.sort_order ASC, p.id DESC"
    );

    return $stmt->fetchAll();
}

function active_feeds(): array
{
    $stmt = db()->query(
        "SELECT *
         FROM feeds
         WHERE is_active = 1
         ORDER BY is_popular DESC, sort_order ASC, id DESC
         LIMIT 4"
    );

    return $stmt->fetchAll();
}

function approved_reviews(): array
{
    $stmt = db()->query(
        "SELECT r.*, p.name AS product_name
         FROM reviews r
         LEFT JOIN products p ON p.id = r.product_id
         WHERE r.is_approved = 1
         ORDER BY r.id DESC
         LIMIT 3"
    );

    return $stmt->fetchAll();
}

function homepage_settings(): array
{
    $stmt = db()->query('SELECT setting_key, setting_value FROM settings');
    $settings = [];

    foreach ($stmt->fetchAll() as $row) {
        $settings[$row['setting_key']] = $row['setting_value'];
    }

    return $settings;
}

