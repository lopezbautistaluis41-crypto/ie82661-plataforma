<?php
declare(strict_types=1);
require __DIR__.'/bootstrap.php';
$configured=admin_account(); $error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $username=strtolower(trim((string)($_POST['usuario']??''))); $password=(string)($_POST['clave']??'');
    if (!reg_valid_csrf($_POST['csrf']??null)) $error='La sesión cambió. Recarga e inténtalo de nuevo.';
    elseif (!admin_rate('login',$username)) { http_response_code(429); $error='Espera 15 minutos antes de volver a intentarlo.'; }
    elseif (!$configured || !hash_equals($configured['username'],$username) || strlen($password)>72 || !password_verify($password,$configured['password_hash'])) $error='El usuario o la contraseña no son correctos.';
    else {
        if(password_needs_rehash($configured['password_hash'],PASSWORD_DEFAULT)) reg_db()->prepare('UPDATE administrators SET password_hash=? WHERE id=1')->execute([password_hash($password,PASSWORD_DEFAULT)]);
        admin_signin($configured); header('Location: /acceso/administrador/'); exit;
    }
}
$account=admin_current();
if (!$account) {
    admin_page('Acceso de administrador'); ?>
    <section class="auth-card"><p class="eyebrow">Acompañamos cada aprendizaje</p><h1>Tu espacio de administrador</h1><p>Revisa el avance y las respuestas de tus estudiantes en un solo lugar.</p>
    <?php if($error) admin_notice($error); ?>
    <?php if(!$configured): ?><p class="notice">Este acceso aún no está activado.</p><a class="button full" href="configurar.php">Activar mi cuenta</a>
    <?php else: ?><form method="post"><?php admin_form_csrf(); ?><label for="usuario">Usuario</label><input id="usuario" name="usuario" autocomplete="username" maxlength="40" required><label for="clave">Contraseña</label><input id="clave" name="clave" type="password" autocomplete="current-password" maxlength="72" required><button class="button full" type="submit">Ingresar al panel</button></form><?php endif; ?>
    <p class="help">Acceso exclusivo para el docente. Los estudiantes ingresan desde su grado.</p><a class="text-link" href="/acceso/">Volver al ingreso de estudiantes</a></section>
    <?php admin_end(); exit;
}
[$where,$params,$values]=admin_filters(); $db=reg_db();
$q=$db->prepare('SELECT COUNT(*) AS attempts,COUNT(DISTINCT a.student_id) AS students,COALESCE(SUM(a.completed_at IS NOT NULL),0) AS completed,COALESCE(SUM((SELECT COUNT(*) FROM responses r WHERE r.attempt_id=a.id)),0) AS responses FROM attempts a'.$where); $q->execute($params); $stats=$q->fetch();
$pages=max(1,(int)ceil($stats['attempts']/25)); $page=min($pages,max(1,(int)($_GET['pagina']??1))); $offset=($page-1)*25;
$q=$db->prepare('SELECT a.*,(SELECT COUNT(*) FROM responses r WHERE r.attempt_id=a.id) AS response_count FROM attempts a'.$where.' ORDER BY a.started_at DESC,a.rowid DESC LIMIT 25 OFFSET '.$offset); $q->execute($params); $rows=$q->fetchAll();
admin_page('Respuestas de estudiantes',true); ?>
<div class="page-heading"><div><p class="eyebrow">Panel de administrador</p><h1>Cada respuesta cuenta.</h1><p>Observa el progreso, reconoce los logros y descubre dónde acompañar.</p></div><a class="button outline" href="exportar.php?<?=reg_e(http_build_query($values))?>">Descargar respuestas CSV</a></div>
<div class="metrics"><article><span>Estudiantes</span><strong><?=(int)$stats['students']?></strong></article><article><span>Respuestas guardadas</span><strong><?=(int)$stats['responses']?></strong></article><article><span>Actividades iniciadas</span><strong><?=(int)$stats['attempts']?></strong></article><article><span>Actividades completadas</span><strong><?=(int)$stats['completed']?></strong></article></div>
<section class="card"><h2>Registro de actividades</h2><form class="filters" method="get"><div><label for="buscar">Estudiante o código</label><input id="buscar" name="buscar" value="<?=reg_e($values['buscar'])?>" placeholder="Buscar estudiante" maxlength="100"></div><div><label for="grado">Grado</label><select id="grado" name="grado"><option value="">Todos los grados</option><?php for($g=1;$g<=6;$g++): ?><option value="<?=$g?>" <?=$values['grado']===(string)$g?'selected':''?>><?=$g?>.° grado</option><?php endfor; ?></select></div><div><label for="estado">Estado</label><select id="estado" name="estado"><option value="">Todos</option><option value="en-curso" <?=$values['estado']==='en-curso'?'selected':''?>>En curso</option><option value="completo" <?=$values['estado']==='completo'?'selected':''?>>Completadas</option></select></div><div><label for="desde">Inicio desde</label><input type="date" id="desde" name="desde" value="<?=reg_e($values['desde'])?>"></div><div><label for="hasta">Inicio hasta</label><input type="date" id="hasta" name="hasta" value="<?=reg_e($values['hasta'])?>"></div><button class="button" type="submit">Filtrar</button><a class="text-link" href="./">Limpiar</a></form>
<?php if(!$rows): ?><div class="empty"><span class="empty-icon" aria-hidden="true">✎</span><h3>Aquí aparecerán sus respuestas</h3><p>Se guardan cuando el estudiante ingresa a su cuenta y responde la ficha conectada. Si aplicaste filtros, prueba ampliarlos.</p></div><?php else: ?>
<div class="table-wrap" tabindex="0" role="region" aria-label="Actividades de estudiantes"><table><thead><tr><th>Estudiante</th><th>Grado</th><th>Actividad</th><th>Avance</th><th>Aciertos</th><th>Último registro</th><th>Detalle</th></tr></thead><tbody><?php foreach($rows as $row): ?><tr><td><strong><?=reg_e($row['student_name'])?></strong><small>Código <?=reg_e(substr($row['student_id'],0,10))?></small></td><td><?=(int)$row['grade']?>.° · <?=reg_e($row['section'])?></td><td><?=reg_e($row['activity_title'])?><small><?=(int)$row['response_count']?> respuestas</small></td><td><span class="badge <?=$row['completed_at']?'done':''?>"><?=$row['completed_at']?'Completada':'En curso'?></span><small><?=(int)$row['current_question']?> de <?=(int)$row['total']?> ejercicios</small></td><td><?=(int)$row['correct_count']?> / <?=(int)$row['total']?></td><td><?=reg_e(reg_date($row['updated_at']))?></td><td><a class="text-link" href="detalle.php?id=<?=reg_e($row['id'])?>">Ver respuestas</a></td></tr><?php endforeach; ?></tbody></table></div>
<nav class="pagination" aria-label="Páginas del registro"><?php if($page>1): ?><a href="?<?=reg_e(http_build_query($values+['pagina'=>$page-1]))?>">Anterior</a><?php endif; ?><span>Página <?=$page?> de <?=$pages?></span><?php if($page<$pages): ?><a href="?<?=reg_e(http_build_query($values+['pagina'=>$page+1]))?>">Siguiente</a><?php endif; ?></nav><?php endif; ?>
<p class="help">Horarios de Perú. Un acierto indica que el ejercicio se resolvió dentro de sus dos intentos. Cada intento queda en el detalle.</p></section>
<aside class="notice">Actividad conectada: <strong>Suma y resta de fracciones (50 ejercicios)</strong>. Las respuestas de otras plataformas y las realizadas antes de esta instalación no se importan automáticamente.</aside>
<?php admin_end(); ?>
