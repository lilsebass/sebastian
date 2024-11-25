<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}

// Cerrar sesión
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Colegio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            background-image: url('img/imagen-fondo.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            font-family: 'Arial', sans-serif;
            height: 100vh; /* Asegura que el fondo cubra toda la pantalla */
        }
        .dashboard-container {
            padding: 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%; /* Centra verticalmente el contenido */
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            margin-bottom: 20px;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }
        .card-header {
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            font-size: 18px;
            font-weight: bold;
        }
        .card-body {
            background-color: rgba(255, 255, 255, 0.9);
            text-align: center;
            padding: 30px;
            border-radius: 0 0 15px 15px;
        }
        .btn-custom, .btn-info, .btn-danger {
            font-size: 16px;
            padding: 12px 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
            width: 100%;
            border-radius: 5px;
        }
        .btn-custom {
            background-color: #28a745;
            color: white;
        }
        .btn-custom:hover {
            background-color: #218838;
        }
        .btn-info {
            background-color: #17a2b8;
            color: white;
        }
        .btn-info:hover {
            background-color: #138496;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .row {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 30px;
        }
        .text-center {
            margin-bottom: 30px;
        }
        h1 {
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
            font-size: 36px;
            font-weight: bold;
        }
        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            font-size: 14px;
            text-decoration: none;
            border-radius: 5px;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
        .card-body p {
            font-size: 16px;
        }
    </style>
</head>
<body>
    <!-- Botón de Cerrar sesión -->
    <a href="?logout=true" class="logout-btn">Cerrar sesión</a>

    <div class="dashboard-container">
        <!-- Bienvenida al usuario logueado -->
        <h1 class="text-center mb-5 titulo-bienvenida" style="margin-top: 45px;">Bienvenido, <?php echo $_SESSION['usuario']; ?>!</h1>

        <div class="row">
            <!-- Registrar Alumnos -->
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-person-plus-fill"></i> Registrar Alumnos
                    </div>
                    <div class="card-body">
                        <p>Registra nuevos alumnos de forma rápida y sencilla.</p>
                        <a href="alumnos/insertar.php" class="btn btn-custom">Registrar</a>
                    </div>
                </div>
            </div>
            <!-- Listar Alumnos -->
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-person-lines-fill"></i> Listar Alumnos
                    </div>
                    <div class="card-body">
                        <p>Consulta todos los alumnos registrados en el sistema.</p>
                        <a href="alumnos/listar.php" class="btn btn-info">Listar</a>
                    </div>
                </div>
            </div>
            <!-- Consultar Alumnos -->
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-search"></i> Consultar Alumnos
                    </div>
                    <div class="card-body">
                        <p>Busca a los alumnos registrados por diferentes criterios.</p>
                        <a href="consulta.php" class="btn btn-info">Consultar</a>
                    </div>
                </div>
            </div>
            <!-- Eliminar Alumnos -->
            <!-- <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-trash-fill"></i> Eliminar Alumnos
                    </div>
                    <div class="card-body">
                        <p>Elimina los alumnos que ya no pertenecen al sistema.</p>
                        <a href="alumnos/eliminar.php" class="btn btn-danger">Eliminar</a>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</body>
</html>
