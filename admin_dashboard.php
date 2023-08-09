<?php
session_start();

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'administrador') {
    header('Location: login.php');
    exit;
}

define('SESSION_EXPIRATION', 20);

// Verificar si existe una sesión y si ha expirado
if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > SESSION_EXPIRATION) {
    session_unset(); // Eliminar todas las variables de sesión
    session_destroy(); // Destruir la sesión
    header('Location: login.php?mensaje="sesion expirada"'); // Redirigir al inicio de sesión
    exit;
}

// Actualizar la hora de la última actividad de la sesión
$_SESSION['last_activity'] = time();
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1em;
        }

        .admin-nav {
            background-color: #007bff;
            padding: 1em;
            text-align: center;
        }

        .admin-nav a {
            color: white;
            text-decoration: none;
            margin: 0 1em;
        }

        .admin-nav a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2em;
        }

        .event {
            border: 1px solid #ccc;
            padding: 1em;
            margin-bottom: 1em;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
        }

        p {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <header>
        <h1>Panel de Administrador</h1>
    </header>
    <div class="admin-nav">
        <a href="#">Agregar lugares</a>
        <a href="#">Eliminar lugares</a>
        <a href="#">Actualizar lugares</a>
        <a href="logout.php">Cerrar Sesión</a>
    </div>
    <div class="container">
        <!-- Contenido de la página de administrador -->
    </div>
</body>

</html>