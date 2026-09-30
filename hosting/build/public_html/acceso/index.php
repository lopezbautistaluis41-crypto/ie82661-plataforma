<?php
declare(strict_types=1);
require __DIR__ . '/auth_common.php';
[$config, $students] = auth_boot();

$grado = (int)($_GET['grado'] ?? 0);
$gradoValido = $grado >= 1 && $grado <= 6;

if (!isset($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(24));
}

$error = (string)($_GET['error'] ?? '');
$mensaje = '';
if ($error === 'datos') {
    $mensaje = 'Revisa tu primer nombre y tu número de documento.';
} elseif ($error === 'registro') {
    $mensaje = 'Ingresa nuevamente para registrar tus respuestas con tu cuenta.';
} elseif ($error === 'bloqueo') {
    $mensaje = 'Demasiados intentos. Espera un minuto y vuelve a intentar.';
}

$grados = [
    1 => ['titulo' => 'Primer grado',  'corto' => '1.º'],
    2 => ['titulo' => 'Segundo grado', 'corto' => '2.º'],
    3 => ['titulo' => 'Tercer grado',  'corto' => '3.º'],
    4 => ['titulo' => 'Cuarto grado',  'corto' => '4.º'],
    5 => ['titulo' => 'Quinto grado',  'corto' => '5.º'],
    6 => ['titulo' => 'Sexto grado',   'corto' => '6.º'],
];
?>
<!doctype html>
<html lang="es">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><meta name="theme-color" content="#252822"><title><?= $gradoValido ? 'Ingreso - ' . htmlspecialchars($grados[$grado]['titulo']) : 'Acceso de estudiantes' ?></title><link rel="icon" href="/acceso/insignia-lourdes.png" type="image/png"><link rel="stylesheet" href="/acceso/acceso.css"></head>
<body>
<div class="franja"><span>Familia dominica · Bambamarca</span><span>Fe · Verdad · Servicio</span></div>
<div class="wrap">
  <header class="school-header"><img class="logo" src="/acceso/insignia-lourdes.png" width="1600" height="1600" alt="Insignia de la I.E. N.° 82661 Nuestra Señora de Lourdes"><div><p class="eyebrow">Plataforma educativa</p><h1>I.E. N.° 82661<br>Nuestra Señora de Lourdes</h1></div></header>
  <main class="access-layout">
    <aside class="identity-panel" aria-labelledby="inspiracion"><p class="eyebrow">Nuestra inspiración</p><h2 id="inspiracion">Fe que ilumina.<br>Amor que educa.</h2><figure><img class="mother" src="/acceso/madre-eduviges-portalet.jpeg" width="720" height="960" alt="Pintura de la Madre Eduviges Portalet acompañando a los niños"><figcaption><strong>Madre Eduviges Portalet</strong><span>Fundadora de las Hermanas Dominicas<br>de la Inmaculada Concepción</span></figcaption></figure></aside>
    <section class="card" aria-labelledby="acceso-titulo"><?php if (!$gradoValido && $mensaje !== ''): ?><div class="aviso error"><?= htmlspecialchars($mensaje) ?></div><?php endif; ?><p class="eyebrow">Acceso de estudiantes · Primaria</p><h2 id="acceso-titulo">Aprendemos juntos</h2>
    <?php if (!$gradoValido): ?>
      <p class="sub">Selecciona tu grado para ingresar a la plataforma educativa.</p>

      <div class="grid">
        <?php foreach ($grados as $n => $info): ?>
          <a class="grade-btn" href="/<?= $n ?>">
            <span class="grade-num"><?= htmlspecialchars($info['corto']) ?></span>
            <span class="grade-name"><?= htmlspecialchars($info['titulo']) ?></span>
          </a>
        <?php endforeach; ?>
      </div>

      <p class="note">Luego escribe tu primer nombre y tu número de DNI/documento.</p>

    <?php else: ?>
      <a class="back" href="/acceso/">← Elegir otro grado</a>
      <div class="grado-titulo"><?= htmlspecialchars($grados[$grado]['titulo']) ?></div>

      <?php if ($mensaje): ?>
        <div class="aviso error"><?= htmlspecialchars($mensaje) ?></div>
      <?php endif; ?>

      <form action="/acceso/login.php" method="post" autocomplete="off">
        <input type="hidden" name="grado" value="<?= $grado ?>">
        <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">

        <label for="usuario">Primer nombre</label>
        <input id="usuario" name="usuario" type="text" required maxlength="40"
               autocomplete="username" placeholder="Ejemplo: CRISTOPHER">

        <label for="clave">Número de DNI / documento</label>
        <input id="clave" name="clave" type="password" required maxlength="12"
               inputmode="numeric" autocomplete="current-password"
               placeholder="Escribe tu número de documento">

        <button type="submit">Ingresar</button>
      </form>

      <p class="note">Escribe solo tu primer nombre. Tu contraseña inicial es tu número de documento.</p>
    <?php endif; ?>
    </section>
  </main>
  <section class="legacy" aria-label="Identidad dominica"><img src="/acceso/eduviges-retrato.jpg" width="473" height="473" alt="Retrato de la Madre Eduviges Portalet" loading="lazy"><div><p>«Predicar la Verdad y portar la Luz de Cristo»</p><span>Inspirados en el carisma de nuestra familia dominica.</span></div><a href="https://hermanasdicperu.org/820-2/" target="_blank" rel="noopener noreferrer">Conoce su legado ↗</a></section>
  <footer class="pie"><p><a href="/acceso/administrador/">Acceso de administrador</a></p><p>I.E. N.° 82661 “Nuestra Señora de Lourdes” · Bambamarca</p><p>Imágenes: <a href="https://hermanasdicperu.org/nuestra-congregacion/fundadores/" target="_blank" rel="noopener noreferrer">Hermanas Dominicas de la Inmaculada Concepción – Perú</a>.</p></footer>
</div>
</body></html>
