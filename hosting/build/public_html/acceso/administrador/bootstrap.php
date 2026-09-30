<?php
declare(strict_types=1);
require_once dirname(__DIR__).'/seguimiento/common.php';
reg_headers();
set_exception_handler(function(Throwable $e): void {
    error_log('IE82661 administrador: error de configuración o almacenamiento.');
    http_response_code(503);
    echo '<!doctype html><html lang="es"><meta charset="utf-8"><title>Administrador</title><h1>No se pudo abrir el panel</h1><p>Comprueba que el hosting tenga PHP 8.1 o posterior, pdo_sqlite y permiso para escribir en private_ie82661. Tus respuestas existentes se conservan.</p></html>';
});
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS']==='off') {
    http_response_code(403); exit('Abre este acceso mediante HTTPS.');
}
ini_set('session.use_strict_mode','1');
ini_set('session.use_only_cookies','1');
session_name('IE82661ADMIN');
session_set_cookie_params(['lifetime'=>0,'path'=>'/acceso/administrador/','secure'=>true,'httponly'=>true,'samesite'=>'Strict']);
session_start();

function admin_account(): ?array {
    $row=reg_db()->query('SELECT * FROM administrators WHERE id=1')->fetch(); return $row ?: null;
}
function admin_current(): ?array {
    $auth=$_SESSION['administrator']??null;
    if (!is_array($auth) || time()-($auth['last_seen']??0)>3600 || time()-($auth['signed_at']??0)>28800) { unset($_SESSION['administrator']); return null; }
    $account=admin_account();
    if (!$account || $auth['version']!==(int)$account['version']) { unset($_SESSION['administrator']); return null; }
    $_SESSION['administrator']['last_seen']=time(); return $account;
}
function admin_require(): array {
    $account=admin_current();
    if (!$account) { header('Location: /acceso/administrador/'); exit; }
    return $account;
}
function admin_signin(array $account): void {
    session_regenerate_id(true);
    $_SESSION=['administrator'=>['version'=>(int)$account['version'],'signed_at'=>time(),'last_seen'=>time()]];
    reg_csrf();
}
function admin_form_csrf(): void { echo '<input type="hidden" name="csrf" value="'.reg_e(reg_csrf()).'">'; }
function admin_password_valid(string $password): bool { return strlen($password)>=12 && strlen($password)<=72 && strpos($password,"\0")===false; }
function admin_rate(string $operation, string $username=''): bool {
    $ip=hash('sha256',$_SERVER['REMOTE_ADDR']??'unknown');
    $ipAllowed=reg_rate($operation.':ip:'.$ip,30,900);
    $accountAllowed=reg_rate($operation.':account:'.hash('sha256',$username),8,900);
    return $ipAllowed && $accountAllowed;
}
function admin_page(string $title, bool $authenticated=false): void {
    ?><!doctype html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title><?=reg_e($title)?> · I.E. 82661</title><link rel="stylesheet" href="/acceso/seguimiento/registro.css"></head><body>
    <a class="skip" href="#contenido">Saltar al contenido</a><header class="topbar"><a class="brand" href="/acceso/administrador/"><img src="/acceso/insignia-lourdes.png" alt="Insignia de la institución" width="46" height="46"><span><strong>Nuestra Señora de Lourdes</strong><small>I.E. N.° 82661 · Espacio docente</small></span></a>
    <?php if($authenticated): ?><nav class="nav" aria-label="Administración"><a href="/acceso/administrador/">Respuestas</a><a href="/acceso/administrador/clave.php">Mi contraseña</a><form method="post" action="/acceso/administrador/salir.php"><?php admin_form_csrf(); ?><button class="link-button" type="submit">Cerrar sesión</button></form></nav><?php endif; ?></header><main id="contenido" class="wrap">
    <?php
}
function admin_end(): void { echo '</main><footer class="footer">Educamos con fe, ternura y compromiso. · Nuestra Señora de Lourdes</footer></body></html>'; }
function admin_notice(string $text, string $kind='error'): void { echo '<p class="notice '.reg_e($kind).'" role="alert">'.reg_e($text).'</p>'; }
function admin_filters(): array {
    $where=[]; $params=[]; $values=['grado'=>'','buscar'=>'','desde'=>'','hasta'=>'','estado'=>''];
    $grade=filter_input(INPUT_GET,'grado',FILTER_VALIDATE_INT);
    if ($grade>=1 && $grade<=6) { $where[]='a.grade=?'; $params[]=$grade; $values['grado']=(string)$grade; }
    $search=trim(is_string($_GET['buscar']??null)?$_GET['buscar']:'');
    if (strlen($search)>100) $search=substr($search,0,100);
    if ($search!=='') {
        $where[]="(a.student_name LIKE ? ESCAPE '\' COLLATE NOCASE OR a.student_id LIKE ? ESCAPE '\')";
        $escaped=str_replace(['\\','%','_'],['\\\\','\\%','\\_'],$search); $params[]='%'.$escaped.'%'; $params[]=$escaped.'%'; $values['buscar']=$search;
    }
    foreach (['desde','hasta'] as $key) {
        $value=is_string($_GET[$key]??null)?$_GET[$key]:'';
        $date=DateTimeImmutable::createFromFormat('!Y-m-d',$value,new DateTimeZone('America/Lima'));
        if ($date && $date->format('Y-m-d')===$value) {
            $values[$key]=$value;
            if ($key==='hasta') $date=$date->modify('+1 day');
            $where[]='a.started_at '.($key==='desde'?'>=':'<').' ?';
            $params[]=$date->setTimezone(new DateTimeZone('UTC'))->format('Y-m-d\TH:i:s\Z');
        }
    }
    $state=$_GET['estado']??'';
    if (in_array($state,['completo','en-curso'],true)) { $values['estado']=$state; $where[]='a.completed_at IS '.($state==='completo'?'NOT ':'').'NULL'; }
    return [$where ? ' WHERE '.implode(' AND ',$where) : '',$params,$values];
}
