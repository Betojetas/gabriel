<?php
session_start();

if (isset($_GET['mensaje'])) {
    $mensaje = urldecode($_GET['mensaje']);
    echo "<script>alert('$mensaje');</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Iniciar sesión</title>
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
        input[type="password"] {
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
        <h2>Iniciar sesión</h2>
        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" value="Iniciar sesión"><br><br>
        <a href="registro.php">Registarte gratis</a><br>
        <a href="index.php">Recuperar Contraseña</a>
    </form>
</body>

</html>


<?php

if (isset($_POST['email']) && isset($_POST['password'])) {
    try {
        require_once 'conexion.php';

        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM usuarios WHERE CorreoElectronico = :email AND Contrasena = :password";
        $stmt = $cnnPDO->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $_SESSION['tipo'] = $result['tipo'];
            if ($result['tipo'] == 'administrador') {
                header('Location: admin_dashboard.php');
            } else {
                header('Location: user_dashboard.php');
            }
        } else {
            echo "Credenciales inválidas. <a href='login.php'>Volver al inicio de sesión</a>";
        }
    } catch (PDOException $exp) {
        echo ("Error al conectar con la base de datos: " . $exp->getMessage());
    }
}
?>