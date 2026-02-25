<?php
// Iniciar sesión para acceder al usuario
session_start();

// Verificar que el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    die("Acceso denegado. Por favor, inicia sesión.");
}

$usuario = $_SESSION['username']; // Nombre o identificador del usuario

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "cafeteria");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener los datos enviados por el cliente
$data = json_decode(file_get_contents('php://input'), true);
$productos = $data['productos'];

// Insertar cada producto en la base de datos
foreach ($productos as $producto) {
    $nombre = $conexion->real_escape_string($producto['nombre']);
    $precio = $conexion->real_escape_string($producto['precio']);
    $cantidad = $conexion->real_escape_string($producto['cantidad']);
    $total = $precio * $cantidad;

    $sql = "INSERT INTO compras (usuario, producto, precio, cantidad, total) 
            VALUES ('$usuario', '$nombre', '$precio', '$cantidad', '$total')";

    if (!$conexion->query($sql)) {
        echo "Error: " . $conexion->error;
        exit;
    }
}

$conexion->close();
echo "Compra registrada correctamente.";
?>
