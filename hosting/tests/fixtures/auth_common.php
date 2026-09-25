<?php
declare(strict_types=1);

function auth_boot(): array {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_set_cookie_params([
            'httponly' => true,
            'secure' => true,
            'samesite' => 'Lax',
        ]);
        session_start();
    }

    $private = dirname(__DIR__, 2) . '/private_ie82661';
    $config = require $private . '/config.php';
    $students = require $private . '/students.php';

    return [$config, $students];
}

function normalize_student_name(string $value): string {
    $value = trim(mb_strtoupper($value, 'UTF-8'));
    $map = [
        'Á'=>'A','É'=>'E','Í'=>'I','Ó'=>'O','Ú'=>'U','Ü'=>'U',
        'Ñ'=>'N','À'=>'A','È'=>'E','Ì'=>'I','Ò'=>'O','Ù'=>'U'
    ];
    $value = strtr($value, $map);
    $value = preg_replace('/\s+/u', ' ', $value) ?? $value;
    return $value;
}

function grade_name(int $g): string {
    return [
        1=>'Primer grado', 2=>'Segundo grado', 3=>'Tercer grado',
        4=>'Cuarto grado', 5=>'Quinto grado', 6=>'Sexto grado'
    ][$g] ?? 'Grado';
}
