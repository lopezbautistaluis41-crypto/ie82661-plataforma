<?php
declare(strict_types=1);
require __DIR__.'/bootstrap.php';
if($_SERVER['REQUEST_METHOD']!=='POST' || !reg_valid_csrf($_POST['csrf']??null)) { http_response_code(403); exit('Solicitud no válida.'); }
$_SESSION=[];
setcookie(session_name(),'', ['expires'=>time()-42000,'path'=>'/acceso/administrador/','secure'=>true,'httponly'=>true,'samesite'=>'Strict']);
session_destroy(); header('Location: /acceso/administrador/'); exit;
