<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit;
}

include '../db/conexion.php';

// Obtener el ID del alumno a editar
$id = $_GET['id'] ?? null;
if ($id === null) {
    echo "ID no válido.";
    exit;
}

// Obtener los datos del alumno para editar
$query = "SELECT * FROM alumnos WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Alumno no encontrado.";
    exit;
}

$alumno = $result->fetch_assoc();

// Verificar si se envió el formulario para actualizar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'] ?? null;
    $direccion = $_POST['direccion'] ?? null;
    $curso = $_POST['curso'];

    // Actualizar los datos en la base de datos
    $update_query = "UPDATE alumnos SET nombre = ?, apellido = ?, fecha_nacimiento = ?, correo = ?, telefono = ?, direccion = ?, curso = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("sssssssi", $nombre, $apellido, $fecha_nacimiento, $correo, $telefono, $direccion, $curso, $id);

    if ($stmt->execute()) {
        $success = "Alumno actualizado exitosamente.";
    } else {
        $error = "Error al actualizar el alumno: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Alumno - Colegio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Fondo gris claro */
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #495057;
        }

        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        .btn-custom {
            background-color: #28a745;
            color: white;
            border: none;
        }

        .btn-custom:hover {
            background-color: #218838;
        }

        .btn-back {
            background-color: #6c757d;
            color: white;
        }

        .btn-back:hover {
            background-color: #5a6268;
        }

        .form-group label {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h1>Editar Alumno</h1>

    <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

    <!-- Formulario de edición -->
    <form method="POST" action="">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" id="nombre" value="<?php echo $alumno['nombre']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" name="apellido" class="form-control" id="apellido" value="<?php echo $alumno['apellido']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" class="form-control" id="fecha_nacimiento" value="<?php echo $alumno['fecha_nacimiento']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" name="correo" class="form-control" id="correo" value="<?php echo $alumno['correo']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" class="form-control" id="telefono" value="<?php echo $alumno['telefono']; ?>">
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <textarea name="direccion" class="form-control" id="direccion"><?php echo $alumno['direccion']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="curso" class="form-label">Curso</label>
            <input type="text" name="curso" class="form-control" id="curso" value="<?php echo $alumno['curso']; ?>" required>
        </div>

        <button type="submit" class="btn btn-custom w-100">Actualizar</button>
    </form>

    <!-- Botón para volver -->
    <a href="listar.php" class="btn btn-back w-100 mt-3">Volver a la lista</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
