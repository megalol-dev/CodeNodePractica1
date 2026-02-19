<?php
declare(strict_types=1);

require_once __DIR__ . '/../app/db.php';

$mensaje = '';
$tipoMensaje = ''; // 'ok' o 'error'

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($nombre === '' || $password === '') {
        $mensaje = 'Por favor, rellena nombre y contraseña.';
        $tipoMensaje = 'error';
    } else {
        try {
            $pdo = getPDO();

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, password) VALUES (:nombre, :password)");
            $stmt->execute([
                ':nombre' => $nombre,
                ':password' => $hash
            ]);

            $mensaje = '✅ Usuario creado correctamente. Ya puedes iniciar sesión.';
            $tipoMensaje = 'ok';
        } catch (PDOException $e) {
            // SQLite lanza error por UNIQUE si el nombre ya existe
            if (str_contains($e->getMessage(), 'UNIQUE')) {
                $mensaje = '❌ Ese nombre de usuario ya existe. Prueba con otro.';
                $tipoMensaje = 'error';
            } else {
                $mensaje = '❌ Error al registrar el usuario.';
                $tipoMensaje = 'error';
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monster Online - Registro</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<header>
    <h1>Monster Online</h1>
</header>

<main>
    <section class="login-box">
        <h2>Crear cuenta</h2>

        <?php if ($mensaje !== ''): ?>
            <div class="msg <?= htmlspecialchars($tipoMensaje) ?>">
                <?= htmlspecialchars($mensaje) ?>
            </div>
        <?php endif; ?>

        <form action="registro.php" method="POST" autocomplete="off">
            <input type="text" name="nombre" placeholder="Nombre de usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Registrarse</button>
        </form>

        <div class="register-section">
            <a href="index.php"><button type="button">Volver al login</button></a>
        </div>
    </section>
</main>

<footer>
    © 2026 Monster Online - Proyecto Bootcamp
</footer>

</body>
</html>

