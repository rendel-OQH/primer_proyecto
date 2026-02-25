<?php
// Conexión a la base de datos
$servidor = "localhost";
$usuario = "root"; // Cambia si usas un usuario diferente
$password = ""; // Cambia si tienes una contraseña
$base_datos = "cafeteria"; // Reemplaza con el nombre de tu base

$conexion = mysqli_connect($servidor, $usuario, $password, $base_datos);
if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

if (isset($_POST['id_pedido'])) {
    $id_pedido = $_POST['id_pedido'];

    // Actualizar el estado a 'pendiente'
    $query = "UPDATE compras SET estado = 'pendiente' WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id_pedido);
    $stmt->execute();
    echo "Pedido actualizado a pendiente.";
}
?>
