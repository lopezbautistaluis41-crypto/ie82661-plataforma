<?php
declare(strict_types=1);
require __DIR__ . '/auth_common.php';
[$config, $students] = auth_boot();
$g = (int)($_SESSION['student']['grade'] ?? 1);
$_SESSION = [];
if (ini_get('session.use_cookies')) {
    $p = session_get_cookie_params();
    setcookie(session_name(), '', time()-42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
}
session_destroy();
header("Location: /{$g}");
exit;
