<?php

declare(strict_types=1);

session_start();

const ADMIN_USERNAME = 'MochiMedan';
const ADMIN_PASSWORD = 'MochiMedan123#';

function is_logged_in(): bool
{
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function require_login(): void
{
    if (!is_logged_in()) {
        header('Location: login.php');
        exit;
    }
}

