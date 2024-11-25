<?php
$host = "sql200.infinityfree.com";
$user = "if0_37528150";
$password = "nyEIvRX914Ny1W8";
$db = "if0_37528150_colegio";

// Establecer la conexión
$conn = new mysqli($host, $user, $password, $db);

// Verificar si hay error de conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
} /* else {
    echo "Conexión exitosa";  // Esto te ayudará a verificar si la conexión es exitosa
} */
?>
