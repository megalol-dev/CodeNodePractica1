<?php
declare(strict_types=1);

session_start();
require_once __DIR__ . '/../app/db.php';

// Si ya está logueado, mándalo al "juego"
if (isset($_SESSION['usuario'])) {
    header('Location: juego.php');
    exit;
}

$mensaje = '';
$tipoMensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($nombre === '' || $password === '') {
        $mensaje = 'Por favor, rellena nombre y contraseña.';
        $tipoMensaje = 'error';
    } else {
        try {
            $pdo = getPDO();

            $stmt = $pdo->prepare("SELECT nombre, password FROM usuarios WHERE nombre = :nombre LIMIT 1");
            $stmt->execute([':nombre' => $nombre]);
            $usuario = $stmt->fetch();

            if (!$usuario) {
                $mensaje = '❌ Usuario no encontrado.';
                $tipoMensaje = 'error';
            } elseif (!password_verify($password, $usuario['password'])) {
                $mensaje = '❌ Contraseña incorrecta.';
                $tipoMensaje = 'error';
            } else {
                // Login OK → guardamos sesión y entramos al "juego"
                $_SESSION['usuario'] = $usuario['nombre'];
                header('Location: juego.php');
                exit;
            }
        } catch (PDOException $e) {
            $mensaje = '❌ Error al conectar con la base de datos.';
            $tipoMensaje = 'error';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monster Online - Inicio de sesión</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<header>
    <h1>Monster Online</h1>
</header>

<main>
    <section class="login-box">
        <h2>Bienvenido jugador</h2>

        <?php if ($mensaje !== ''): ?>
            <div class="msg <?= htmlspecialchars($tipoMensaje) ?>">
                <?= htmlspecialchars($mensaje) ?>
            </div>
        <?php endif; ?>

        <form action="index.php" method="POST" autocomplete="off">
            <input type="text" name="nombre" placeholder="Nombre de usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Iniciar sesión</button>
        </form>

        <div class="register-section">
            <p>¿No tienes cuenta?</p>
            <a href="registro.php"><button type="button">Regístrate aquí</button></a>
        </div>
    </section>
</main>

<footer>
    © 2026 Monster Online - Proyecto Bootcamp
</footer>

</body>
</html>

