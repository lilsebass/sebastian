<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit;
}

include '../db/conexion.php';

// Verificar si se ha recibido el ID del alumno a eliminar
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar el alumno de la base de datos
    $query = "DELETE FROM alumnos WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        // Redirigir a la lista después de la eliminación exitosa
        header("Location: listar.php?mensaje=Alumno eliminado con éxito.");
        exit;
    } else {
        // Redirigir a la lista con un mensaje de error
        header("Location: listar.php?mensaje=Hubo un error al eliminar al alumno.");
        exit;
    }
} else {
    // Si no se pasó un ID válido, redirigimos a la lista
    header("Location: listar.php?mensaje=No se proporcionó un ID válido.");
    exit;
}
?>
