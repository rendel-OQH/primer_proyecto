<?php
// Configuración de la conexión a la base de datos
$servidor = "localhost";
$usuario = "root"; // Cambia este valor si tienes otro usuario configurado
$contrasena = "";  // Cambia este valor si tienes contraseña configurada
$base_datos = "conexión_php";

// Crear la conexión con mysqli
$conexion = new mysqli($servidor, $usuario, $contrasena, $base_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("<p>Error de conexión: " . $conexion->connect_error . "</p>");
}
?>
