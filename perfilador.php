<?php

// 1) captura opcional por GET (requisito #6)
$saludo = isset($_GET['saludo']) && $_GET['saludo'] !== ''
    ? htmlspecialchars($_GET['saludo'])
    : '¡Bienvenido/a! Puedes pasar ?saludo=Hola en la URL';

// 2) inicializacoin de variables para la tarjeta
$nombre = $hobby = '';
$edad = null;
$mensaje_perfil = '';
$hay_envio = ($_SERVER['REQUEST_METHOD'] === 'POST');

// (requisito #3) 
if ($hay_envio) {
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $edad   = isset($_POST['edad'])   ? (int)$_POST['edad']     : null;
    $hobby  = isset($_POST['hobby'])  ? trim($_POST['hobby'])   : '';

    // saneamos para evitar XSS 
    $nombre = htmlspecialchars($nombre);
    $hobby  = htmlspecialchars($hobby);

    // logica if/else según edad (requisito #5)
    if ($edad >= 60) {
        $mensaje_perfil = 'Perfil Senior';
    } else {
        $mensaje_perfil = 'Perfil en Desarrollo';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>El Perfilador PHP</title>
<style>
  :root {
    font-family: system-ui, Segoe UI, Roboto, Arial;
  }
  body {
    margin: 0;
    background: #0f172a;
    color: #e2e8f0;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }
  header {
    padding: 16px 20px;
    background: #111827;
    border-bottom: 1px solid #1f2937;
    text-align: center;
  }
  .wrap {
    max-width: 960px;
    width: 100%;
    margin: auto;
    padding: 40px 20px;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    width: 100%;
  }
  .card {
    background: #111827;
    border: 1px solid #1f2937;
    border-radius: 14px;
    padding: 24px;
    box-sizing: border-box;
  }
  form {
    display: flex;
    flex-direction: column;
    gap: 14px;
  }
  label {
    font-size: 14px;
    display: block;
    margin-bottom: 6px;
  }
  input, button {
    width: 100%;
    box-sizing: border-box; 
    padding: 10px 12px;
    border-radius: 10px;
    border: 1px solid #334155;
    background: #0b1220;
    color: #e2e8f0;
    font-size: 15px;
  }
  input:focus {
    outline: 2px solid #3b82f6;
    border-color: #3b82f6;
  }
  button {
    cursor: pointer;
    background: #2563eb;
    border-color: #2563eb;
    font-weight: 600;
    margin-top: 2px;
    transition: 0.2s ease;
  }
  button:hover {
    filter: brightness(1.1);
    transform: scale(1.02);
  }
  .tarjeta {
    margin-top: 12px;
    padding: 14px;
    border-radius: 12px;
    border: 1px solid #334155;
    background: #0b1220;
    transition: 0.3s ease;
  }
  .pill {
    display: inline-block;
    margin-top: 8px;
    padding: 4px 10px;
    border-radius: 999px;
    background: #1d4ed8;
  }
  .muted {
    color: #94a3b8;
    font-size: 14px;
  }
  @media (max-width: 800px) {
    .grid {
      grid-template-columns: 1fr;
    }
  }
</style>

</head>
<body>
<header>
  <div class="wrap" style="flex-direction: column;">
    <strong>Saludo:</strong> <?= $saludo ?>
    <div class="muted"></div>
  </div>
</header>

<main class="wrap">
  <div class="grid">
    <!-- formulario -->
    <section class="card">
      <h2 style="margin:0 0 10px">Generar Tarjeta de Perfil</h2>
      <form method="POST" action="">
        <div style="margin-bottom:12px">
          <label for="nombre">Nombre</label>
          <input id="nombre" name="nombre" type="text" required placeholder="Ej: Ana Pérez" value="<?= $nombre ?>"/>
        </div>
        <div style="margin-bottom:12px">
          <label for="edad">Edad</label>
          <input id="edad" name="edad" type="number" required min="0" max="120" placeholder="Ej: 27" value="<?= $edad !== null ? (int)$edad : '' ?>"/>
        </div>
        <div style="margin-bottom:12px">
          <label for="hobby">Hobby</label>
          <input id="hobby" name="hobby" type="text" required placeholder="Ej: Fotografía" value="<?= $hobby ?>"/>
        </div>
        <button type="submit">Crear Tarjeta</button>
        <p class="muted">
          Seguridad: los campos se imprimen con <code>htmlspecialchars()</code> para prevenir XSS.
        </p>
      </form>
    </section>

    <!-- tarjeta dinamica -->
    <section class="card">
      <h2 style="margin:0 0 10px">Vista previa</h2>
      <?php if ($hay_envio): ?>
        <div class="tarjeta">
          <div style="font-weight:700"><?= $nombre ?></div>
          <div class="muted">Edad: <strong><?= (int)$edad ?></strong></div>
          <div class="muted">Hobby: <strong><?= $hobby ?></strong></div>
          <span class="pill"><?= $mensaje_perfil ?></span>
        </div>
      <?php else: ?>
        <p class="muted">Completá el formulario y enviá para ver tu tarjeta aquí.</p>
      <?php endif; ?>
    </section>
  </div>
</main>
</body>
</html>
