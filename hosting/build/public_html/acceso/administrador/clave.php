<?php
declare(strict_types=1);
require __DIR__.'/bootstrap.php'; $account=admin_require(); $error=''; $success='';
if($_SERVER['REQUEST_METHOD']==='POST') {
    $old=(string)($_POST['actual']??''); $new=(string)($_POST['nueva']??'');
    if(!reg_valid_csrf($_POST['csrf']??null)) $error='La sesión cambió. Recarga la página.';
    elseif(!admin_rate('password',$account['username'])) { http_response_code(429); $error='Espera 15 minutos antes de volver a intentarlo.'; }
    elseif(strlen($old)>72 || !password_verify($old,$account['password_hash'])) $error='La contraseña actual no es correcta.';
    elseif(!admin_password_valid($new)) $error='La nueva contraseña debe tener al menos 12 caracteres y como máximo 72 bytes.';
    elseif(!hash_equals($new,(string)($_POST['repetir']??''))) $error='Las contraseñas nuevas no coinciden.';
    else {
        reg_db()->prepare('UPDATE administrators SET password_hash=?,version=version+1 WHERE id=1')->execute([password_hash($new,PASSWORD_DEFAULT)]);
        admin_signin(admin_account()); $success='Tu contraseña se actualizó. Las otras sesiones de administrador quedaron cerradas.';
    }
}
admin_page('Mi contraseña',true); ?><section class="auth-card"><p class="eyebrow">Mi cuenta</p><h1>Cambiar contraseña</h1><p>Usuario: <strong><?=reg_e($account['username'])?></strong></p><?php if($error)admin_notice($error); if($success)admin_notice($success,'success'); ?><form method="post"><?php admin_form_csrf(); ?><label for="actual">Contraseña actual</label><input type="password" id="actual" name="actual" autocomplete="current-password" maxlength="72" required><label for="nueva">Nueva contraseña</label><input type="password" id="nueva" name="nueva" autocomplete="new-password" minlength="12" maxlength="72" required><label for="repetir">Repite la nueva contraseña</label><input type="password" id="repetir" name="repetir" autocomplete="new-password" minlength="12" maxlength="72" required><button class="button full" type="submit">Guardar contraseña</button></form></section><?php admin_end(); ?>
