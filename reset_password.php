<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
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

        h1 {
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
        input[type="text"],
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
    </style>

</head>

<body>
    <?php
    require_once 'conexion.php';

    if (isset($_GET['email']) && isset($_GET['token'])) {
        $correo = $_GET['email'];
        $token = $_GET['token'];

        // Verificar la validez del token en la base de datos
        $query = "SELECT * FROM Usuarios WHERE CorreoElectronico = :email AND TokenRecuperacion = :token";
        $stmt = $cnnPDO->prepare($query);
        $stmt->bindParam(':email', $correo);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        $valor = '-1';

        if ($stmt->rowCount() === intval($valor)) {
            // Token válido, mostrar formulario para establecer nueva contraseña
            echo "<form method='post' action='reset_password.php'>";
            echo "<input type='hidden' name='correo' value='$correo'>";
            echo '<label for="token">Token de Recuperación:</label>';
            echo "<input type='text' name='token' value='$token'>";
            echo "Nueva Contraseña: <input type='password' name='nueva_contrasena'><br>";
            echo "<input type='submit' name='guardar' value='Guardar'>";
            echo "</form>";
        } else {
            echo "<script>alert('Revisa bien la dirección de tu correo electrónico o el Token para asegurarte de que sean correctos.');</script>";
        }
    } elseif (isset($_POST['guardar'])) {
        $correo = $_POST['correo'];
        $token = $_POST['token'];
        $nuevaContrasena = $_POST['nueva_contrasena'];

        // Verificar nuevamente el token en la base de datos antes de actualizar la contraseña
        $query = "SELECT * FROM Usuarios WHERE CorreoElectronico = :correo AND TokenRecuperacion = :token";
        $stmt = $cnnPDO->prepare($query);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        $valor = '-1';

        if ($stmt->rowCount() === intval($valor)) {
            // Token válido, actualizar la contraseña y borrar el token en la base de datos
            $updateQuery = "UPDATE Usuarios SET Contrasena = :contrasena, TokenRecuperacion = NULL WHERE CorreoElectronico = :correo AND TokenRecuperacion = :token";
            $updateStmt = $cnnPDO->prepare($updateQuery);
            $updateStmt->bindParam(':contrasena', $nuevaContrasena);
            $updateStmt->bindParam(':correo', $correo);
            $updateStmt->bindParam(':token', $token);
            $updateStmt->execute();
            echo "Contraseña actualizada exitosamente.";
        } else {
            echo "No se pudo actualizar la contraseña. Por favor, verifica tu enlace de recuperación.";
        }
    }
    ?>
</body>

</html>