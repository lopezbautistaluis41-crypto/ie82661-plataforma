<?php
declare(strict_types=1);
require __DIR__.'/seguimiento/common.php';
reg_headers();
try { $st=reg_student(); }
catch(DomainException $e) { header('Location: /acceso/?error=registro'); exit; }
[$config]=auth_boot();
?>
<!doctype html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Mis actividades · Nuestra Señora de Lourdes</title><link rel="stylesheet" href="/acceso/seguimiento/registro.css"></head><body><header class="topbar"><a class="brand" href="/acceso/panel.php"><img src="/acceso/insignia-lourdes.png" alt="Insignia de la institución" width="46" height="46"><span><strong>Nuestra Señora de Lourdes</strong><small>Mi espacio de aprendizaje</small></span></a><a class="text-link" href="/acceso/logout.php">Cerrar sesión</a></header><main class="student-wrap"><p class="eyebrow">Aprendemos juntos</p><h1>¡Hola, <?=reg_e($st['first'])?>!</h1><p><?=(int)$st['grade']?>.° grado · Sección <?=reg_e($st['section'])?></p><div class="student-catalog"><article class="card"><p class="eyebrow">Matemática · 4.° grado</p><h2>Practicamos con fracciones</h2><p>Suma y resta de fracciones. Tus respuestas se guardan para tu docente y puedes continuar donde te quedaste.</p><a class="button" href="/acceso/seguimiento/ficha.php">Abrir mi ficha</a></article><article class="card"><p class="eyebrow">Nuestra plataforma</p><h2>Más recursos para aprender</h2><p>Conoce nuestra identidad y explora los materiales de la institución.</p><a class="button outline" href="<?=reg_e($config['platform_url'])?>">Ir a la plataforma</a></article></div></main><footer class="footer">I.E. N.° 82661 “Nuestra Señora de Lourdes” · Bambamarca</footer></body></html>
