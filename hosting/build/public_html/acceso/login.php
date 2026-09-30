<?php
declare(strict_types=1);
ini_set('session.use_strict_mode', '1');
require __DIR__ . '/auth_common.php';
[$config, $students] = auth_boot();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /1');
    exit;
}

$grado = (int)($_POST['grado'] ?? 0);
if ($grado < 1 || $grado > 6) {
    http_response_code(400);
    exit('Solicitud no válida.');
}

$csrf = (string)($_POST['csrf'] ?? '');
if ($csrf === '' || empty($_SESSION['csrf']) || !hash_equals((string)$_SESSION['csrf'], $csrf)) {
    http_response_code(403);
    exit('Sesión no válida. Vuelve a intentarlo.');
}

$now = time();
$fail = $_SESSION['login_fail'] ?? ['count'=>0,'until'=>0];
if (($fail['until'] ?? 0) > $now) {
    header("Location: /{$grado}?error=bloqueo");
    exit;
}

$user = normalize_student_name((string)($_POST['usuario'] ?? ''));
$pass = trim((string)($_POST['clave'] ?? ''));
$candidate = hash_hmac('sha256', $pass, $config['pepper']);

$found = null;
foreach ($students as $student) {
    if ((int)$student['g'] !== $grado) continue;
    if (!hash_equals((string)$student['u'], $user)) continue;
    if (hash_equals((string)$student['p'], $candidate)) {
        $found = $student;
        break;
    }
}

if ($found === null) {
    $count = (int)($fail['count'] ?? 0) + 1;
    $_SESSION['login_fail'] = [
        'count' => $count >= 5 ? 0 : $count,
        'until' => $count >= 5 ? $now + 60 : 0,
    ];
    header("Location: /{$grado}?error=datos");
    exit;
}

session_regenerate_id(true);
$_SESSION['registro_csrf'] = bin2hex(random_bytes(32));
$_SESSION['student'] = [
    'id' => hash_hmac('sha256', 'registro-v1|' . $found['u'] . '|' . $found['p'], (string)$config['pepper']),
    'first' => $found['n'],
    'grade' => (int)$found['g'],
    'section' => $found['s'],
];
$_SESSION['login_fail'] = ['count'=>0,'until'=>0];

header('Location: /acceso/panel.php');
exit;
