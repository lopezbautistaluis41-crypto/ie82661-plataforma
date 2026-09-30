# Administrador y respuestas de estudiantes

Este módulo amplía el acceso PHP existente de `ie82661.com/acceso/`. Registra cada respuesta de la ficha de fracciones y permite al docente consultarla desde `/acceso/administrador/`.

**Estado: preparado y probado localmente; pendiente de instalar y activar en el hosting.** No combinar los cambios de navegación en `main` hasta comprobar la instalación. GitHub Pages solo publica la portada y los archivos estáticos; el PHP se ejecuta en el hosting de la institución.

## Instalación

1. Respaldar `public_html/acceso` y `private_ie82661`.
2. Comprobar PHP 8.1 o posterior, `pdo_sqlite`, `mbstring`, HTTPS y escritura del usuario PHP en `private_ie82661`.
3. Copiar el contenido de `build/public_html/acceso/` en `/home/iecom1/public_html/acceso/`. Conservar `auth_common.php`, `logout.php`, `config.php`, `students.php` y el `.htaccess` de la raíz del hosting.
4. Usar el paquete privado entregado al propietario para la activación, o generar un código exclusivo desde una terminal del hosting siguiendo el apartado siguiente.
5. Abrir `/acceso/administrador/configurar.php`, introducir el código y elegir usuario y contraseña. Se crea una sola cuenta; la activación no permite reemplazarla.
6. Volver a ingresar con una cuenta de estudiante, abrir la ficha desde su panel y verificar sus respuestas en el administrador.
7. Publicar los enlaces de la portada y el redireccionamiento de la ficha de GitHub solamente después de verificar el hosting.

## Crear el archivo de activación en el hosting

Ejecutar con PHP desde `/home/iecom1`. El resultado es un código privado: no guardarlo en GitHub ni en `public_html`.

```php
<?php
$token = bin2hex(random_bytes(32));
$file = __DIR__ . '/private_ie82661/administrador_instalacion.php';
if (is_file($file)) { throw new RuntimeException('Ya existe un archivo de activación.'); }
$body = '<?php return ' . var_export(['token_hash' => hash('sha256', $token)], true) . ';';
file_put_contents($file, $body, LOCK_EX);
chmod($file, 0600);
echo $token . PHP_EOL;
```

La cuenta existente queda protegida aunque se vuelva a crear este archivo. Al configurar la primera cuenta se elimina el archivo de activación. El ZIP privado contiene su propio código de un solo uso y nunca debe publicarse.

## Datos y autenticación

- El identificador del alumno se genera en el servidor durante el ingreso a partir de su cuenta existente y la clave privada de la institución. Se conservan sus credenciales actuales.
- Los nombres disponibles en la lista original son los del acceso; el panel añade grado, sección y un código para distinguir las cuentas.
- `private_ie82661/seguimiento/respuestas.sqlite` conserva administradores, actividades, respuestas e intentos de acceso. La carpeta debe permanecer fuera de la raíz pública y formar parte de las copias de seguridad del hosting.
- Sesión administrativa separada, cookies Secure/HttpOnly/SameSite, contraseña con `password_hash`, CSRF, caducidad de sesión y límite de intentos persistente. El cambio de contraseña invalida otras sesiones administrativas.
- La identidad, el resultado y el progreso se obtienen del servidor. El cliente no asigna el alumno, el grado ni la nota.
- Cada envío tiene un identificador único; las transacciones SQLite evitan duplicados. Se conservan respuestas correctas e incorrectas y ejercicios sin terminar.
- Las respuestas pendientes se mantienen en `sessionStorage` durante esa pestaña y solo se marcan guardadas al recibir confirmación. Sin conexión, la interfaz bloquea el avance y permite reintentar. No se promete guardado fuera de línea si el alumno cierra la pestaña o borra sus datos antes de confirmar.
- Las fechas se guardan en UTC y se muestran y filtran según America/Lima. Los filtros de fecha se refieren al inicio de la actividad.

## Alcance

Actividad conectada: suma y resta de fracciones, 50 ejercicios, hasta dos intentos por pregunta. Una nueva práctica conserva el historial anterior. Los apartados de otras áreas de esta plataforma todavía no incluyen actividades publicadas. ENLA y Lecturas son sistemas distintos: sus bases y archivos no se modifican ni se importan. No se pueden recuperar respuestas anteriores que la ficha estática no guardaba.

La portada pública y su acceso directo antiguo se enlazan a la ficha del hosting. La sesión del alumno permanece en `ie82661.com`; no se envían datos personales ni cookies hacia GitHub.

## Validación

Pruebas con PHP 8.3.6 y SQLite, sin información real de alumnos. `tests/results.json` registra 120 comprobaciones de sintaxis y HTTP. Se comprueban activación, contraseñas, CSRF, aislamiento de cuentas, evaluación en servidor, duplicados, historial, persistencia, filtros, CSV, escape HTML y cierre de sesiones. Las pruebas JavaScript verifican fallos de conexión y recuperación de envíos pendientes.

Con PHP, pdo_sqlite y mbstring instalados, indicar las rutas del entorno local:

```sh
PHP_BIN=/ruta/a/php PHP_INI=/ruta/a/php.ini python3 hosting/tests/integration.py
node hosting/tests/client.cjs
```

`tests/fixtures/` contiene únicamente el código común del ingreso para pruebas. Las cuentas usadas por las pruebas se crean temporalmente y son ficticias. No contiene listas de estudiantes, DNI, contraseñas reales, claves del hosting, archivos de activación ni bases de respuestas.

La apariencia usa los mismos colores y la insignia de la portada. No se ha verificado con el navegador del hosting porque mostró Site Unavailable desde la sesión de trabajo.
