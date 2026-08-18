<?php
/**
 * GBEST / GBTech - Admin Authentication & Session Guard
 * Author: Gbolahan Alade
 */

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!defined('GBEST_ROOT')) {
    define('GBEST_ROOT', dirname(__DIR__));
}

function get_admin_user(): array {
    $file = GBEST_ROOT . '/data/admin_user.json';
    if (file_exists($file)) {
        $content = file_get_contents($file);
        if ($content) {
            $data = json_decode($content, true);
            if (is_array($data)) {
                return $data;
            }
        }
    }
    // Default fallback
    return [
        'username' => 'admin',
        'password_hash' => '$2y$10$vJLmGq9kQx/DAc38FSOL/edq/hYgntp2dOZ7uIhQxCDvabTkFw2sC', // admin123
        'name' => 'Gbolahan Alade',
        'email' => 'alade.gbolahan@gbest.tech',
        'last_login' => date('Y-m-d H:i:s')
    ];
}

function save_admin_user(array $userData): bool {
    $file = GBEST_ROOT . '/data/admin_user.json';
    return (bool) file_put_contents(
        $file,
        json_encode($userData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
    );
}

function is_admin_logged_in(): bool {
    return isset($_SESSION['gbest_admin_auth']) && $_SESSION['gbest_admin_auth'] === true;
}

function require_admin_auth(): void {
    if (!is_admin_logged_in()) {
        header('Location: login.php');
        exit;
    }
}
