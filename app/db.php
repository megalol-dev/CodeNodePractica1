<?php
declare(strict_types=1);

function getPDO(): PDO
{
    $dbPath = __DIR__ . '/../data/Usuarios.db';
    $dsn = 'sqlite:' . $dbPath;

    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $pdo;
}