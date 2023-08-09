<!DOCTYPE html>
<html>

<head>
    <title>Registro de Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"] {

            width: 93%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #ff5733;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #d1452e;
        }

        a {
            display: block;
            text-align: center;
            color: #333;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <form method="post">
        <h2>Registro de Usuario</h2>
        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" required>
        <br>
        <label for="username">Nombre de Usuario:</label>
        <input type="text" name="username" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" name="enviar" value="Registrarse"><br><br>
        <a href="login.php">Iniciar Sesión</a>
    </form>
</body>

</html>

<?php

session_start();

if (isset($_POST['enviar'])) {

    require_once 'conexion.php';

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Generar un token de recuperación (puedes personalizar este proceso)
    $tokenRecuperacion = "";
    $query = "INSERT INTO Usuarios (CorreoElectronico, NombreUsuario, Contrasena, TokenRecuperacion, FechaRegistro, rol) 
    VALUES (:email, :username, :password, :tokenRecuperacion, GETDATE(), 'user')";

    $stmt = $cnnPDO->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':tokenRecuperacion', $tokenRecuperacion);
    $stmt->execute();

    header('Location: login.php');
}
?>