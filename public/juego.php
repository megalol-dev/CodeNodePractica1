<?php
declare(strict_types=1);

session_start();

// Si no hay sesión, fuera
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}

$nombre = $_SESSION['usuario'];
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monster Online - Juego</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<header>
    <h1>Monster Online</h1>
</header>

<main>
    <section class="panel">
        <h2>Zona de juego</h2>
        <p>Jugador: <strong><?= htmlspecialchars($nombre) ?></strong></p>

        <!-- De momento vacío / placeholder -->
        <p>(Aquí irá el juego...)</p>

        <form action="logout.php" method="POST">
            <button class="logout-btn" type="submit">Cerrar sesión</button>
        </form>
    </section>
</main>

<footer>
    © 2026 Monster Online - Proyecto Bootcamp
</footer>

</body>
</html>
