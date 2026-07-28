<?php
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf(): void
{
    $submitted = $_POST['csrf_token'] ?? '';
    if (!is_string($submitted) || !hash_equals($_SESSION['csrf_token'] ?? '', $submitted)) {
        http_response_code(419);
        exit('Your session token is invalid. Please go back and try again.');
    }
}

function redirect(string $path): never
{
    header("Location: {$path}");
    exit;
}

function require_login(): void
{
    if (empty($_SESSION['user_id'])) {
        $_SESSION['flash'] = ['type' => 'error', 'message' => 'Please log in to access the records dashboard.'];
        redirect('login.php');
    }
}

function flash_message(): ?array
{
    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return is_array($flash) ? $flash : null;
}
