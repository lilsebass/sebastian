<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}

include 'db/conexion.php';

// Si se recibe un curso desde el formulario, se realiza la consulta
$curso = isset($_POST['curso']) ? $_POST['curso'] : '';

$query = "SELECT a.nombre, a.apellido, a.curso 
          FROM alumnos a 
          WHERE a.curso LIKE ?";
$stmt = $conn->prepare($query);
$curso_param = "%$curso%";
$stmt->bind_param("s", $curso_param);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta Alumnos - Colegio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            background-color: #f4f7fc;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .btn-custom {
            background-color: #28a745;
            color: white;
        }
        .btn-custom:hover {
            background-color: #218838;
        }
        .table-container {
            margin-top: 30px;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #28a745;
            color: white;
        }
        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <?php include 'includes/menu.php'; ?>
    
    <div class="container">
        <h1 class="text-center">Consulta de Alumnos por Curso</h1>

        <!-- Formulario para filtrar por curso -->
        <form method="POST" class="d-flex justify-content-center">
            <input type="text" name="curso" class="form-control w-50" placeholder="Buscar por curso" value="<?php echo htmlspecialchars($curso); ?>">
            <button type="submit" class="btn btn-custom ms-2">Buscar</button>
        </form>

        <div class="table-container">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Curso</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['nombre']; ?></td>
                                <td><?php echo $row['apellido']; ?></td>
                                <td><?php echo $row['curso']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center">No se encontraron resultados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
