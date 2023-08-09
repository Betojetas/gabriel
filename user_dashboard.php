<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }



        .nav {
            background-color: orange;
            padding: 1em;
            text-align: center;
        }

        .nav a {
            color: white;
            text-decoration: none;
            margin: 0 1em;
        }

        .nav a:hover {
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

    <div class="nav">
        <a href="#">Crear Eventos</a>
        <a href="#">Eliminar Eventos</a>
        <a href="logout.php">Cerrar Sesión</a>
    </div>
    <div class="container">
        <div class="event">
            <h2>Evento 1</h2>
            <p><strong>Fecha:</strong> 10 de agosto de 2023</p>
            <p><strong>Lugar:</strong> Salón de conferencias A</p>
            <p><strong>Descripción:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vitae elit
                libero, a pharetra augue. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>
        </div>
        <div class="event">
            <h2>Evento 2</h2>
            <p><strong>Fecha:</strong> 15 de agosto de 2023</p>
            <p><strong>Lugar:</strong> Auditorio B</p>
            <p><strong>Descripción:</strong> Vestibulum id ligula porta felis euismod semper. Sed posuere consectetur
                est at lobortis. Aenean lacinia bibendum nulla sed consectetur.</p>
        </div>
        <!-- Agregar más eventos aquí -->
    </div>
</body>

</html>