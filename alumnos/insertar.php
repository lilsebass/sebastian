<?php
// Mostrar errores para depuración
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Iniciar sesión y verificar acceso
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit;
}

// Incluir conexión a la base de datos
include '../db/conexion.php';

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar los datos enviados por el formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'] ?? null;
    $direccion = $_POST['direccion'] ?? null;
    $curso = $_POST['curso'];

    // Preparar la consulta SQL para insertar los datos
    $query = "INSERT INTO alumnos (nombre, apellido, fecha_nacimiento, correo, telefono, direccion, curso) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Preparar la consulta para evitar inyección SQL
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssss", $nombre, $apellido, $fecha_nacimiento, $correo, $telefono, $direccion, $curso);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $success = "Alumno registrado exitosamente.";
    } else {
        $error = "Error al registrar el alumno: " . $conn->error;
    }

    // Cerrar la consulta
    $stmt->close();
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Alumno - Colegio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4; /* Fondo claro */
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #ffffff; /* Fondo blanco */
            padding: 30px;
            border-radius: 15px; /* Bordes redondeados */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Sombra */
            width: 100%;
            max-width: 500px; /* Ancho máximo */
            margin-top: 50px; /* Baja el formulario */
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .btn {
            margin-top: 15px;
        }
        .btn-back {
            margin-top: 10px;
            background-color: #6c757d; /* Color gris */
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Registrar Alumno</h1>

        <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
        <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

        <!-- Formulario -->
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" name="apellido" class="form-control" id="apellido" placeholder="Apellido" required>
            </div>
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" name="fecha_nacimiento" class="form-control" id="fecha_nacimiento" required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" name="correo" class="form-control" id="correo" placeholder="Correo" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control" id="telefono" placeholder="Teléfono">
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <textarea name="direccion" class="form-control" id="direccion" placeholder="Dirección"></textarea>
            </div>
            <div class="mb-3">
                <label for="curso" class="form-label">Curso</label>
                <input type="text" name="curso" class="form-control" id="curso" placeholder="Curso" required>
            </div>

            <button type="submit" class="btn btn-success w-100">Registrar</button>
        </form>

        <!-- Botón para volver al dashboard -->
        <a href="../dashboard.php" class="btn btn-back w-100 text-center">Volver</a>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
