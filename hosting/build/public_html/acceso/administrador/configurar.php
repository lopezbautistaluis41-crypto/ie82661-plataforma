<?php
declare(strict_types=1);
require __DIR__.'/bootstrap.php';
if (admin_account()) { header('Location: /acceso/administrador/'); exit; }
$path=reg_private().'/administrador_instalacion.php';
$installation=is_file($path) ? require $path : [];
$error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $username=strtolower(trim((string)($_POST['usuario']??'')));
    $password=(string)($_POST['clave']??'');
    $token=(string)($_POST['activacion']??'');
    if (!reg_valid_csrf($_POST['csrf']??null)) $error='La sesión cambió. Recarga la página e inténtalo de nuevo.';
    elseif (!admin_rate('setup')) { http_response_code(429); $error='Se alcanzó el límite de intentos. Espera 15 minutos.'; }
    elseif (empty($installation['token_hash']) || !hash_equals((string)$installation['token_hash'],hash('sha256',$token))) $error='El código de activación no es válido.';
    elseif (!preg_match('/^[a-z0-9._-]{3,40}$/D',$username)) $error='El usuario debe tener entre 3 y 40 letras minúsculas, números, puntos o guiones.';
    elseif (!admin_password_valid($password)) $error='Usa una contraseña de al menos 12 caracteres y como máximo 72 bytes.';
    elseif (!hash_equals($password,(string)($_POST['repetir']??''))) $error='Las contraseñas no coinciden.';
    else {
        reg_transaction(function(PDO $db) use($username,$password): void {
            if ($db->query('SELECT COUNT(*) FROM administrators')->fetchColumn()) throw new RuntimeException('La cuenta ya fue creada.');
            $db->prepare('INSERT INTO administrators(id,username,password_hash,created_at) VALUES(1,?,?,?)')->execute([$username,password_hash($password,PASSWORD_DEFAULT),reg_now()]);
        });
        @unlink($path);
        admin_signin(admin_account()); header('Location: /acceso/administrador/'); exit;
    }
}
admin_page('Crear mi acceso'); ?>
<section class="auth-card"><p class="eyebrow">Solo para el docente</p><h1>Crea tu acceso de administrador</h1><p>Elige una contraseña privada para consultar las respuestas de tus estudiantes.</p>
<?php if($error) admin_notice($error); ?>
<?php if(empty($installation['token_hash'])): admin_notice('Falta el archivo privado de activación. Completa la instalación siguiendo la guía del paquete.'); else: ?>
<form method="post"><?php admin_form_csrf(); ?><label for="activacion">Código de activación</label><input id="activacion" name="activacion" type="password" autocomplete="off" required><p class="help">Está en el archivo ACTIVAR_ADMINISTRADOR.txt de tu paquete.</p>
<label for="usuario">Usuario de administrador</label><input id="usuario" name="usuario" value="<?=reg_e($_POST['usuario']??'admin')?>" autocomplete="username" minlength="3" maxlength="40" pattern="[a-z0-9._-]{3,40}" required>
<label for="clave">Tu contraseña</label><input id="clave" name="clave" type="password" autocomplete="new-password" minlength="12" maxlength="72" required><p class="help">Al menos 12 caracteres. Puedes usar una frase fácil de recordar.</p>
<label for="repetir">Repite la contraseña</label><input id="repetir" name="repetir" type="password" autocomplete="new-password" minlength="12" maxlength="72" required><button class="button full" type="submit">Crear mi cuenta</button></form><?php endif; ?></section><?php admin_end(); ?>
