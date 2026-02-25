<?php
// Conexión a la nueva base de datos para comentarios
$servidor = "localhost";
$usuario = "root"; // Cambia si usas un usuario diferente
$password = ""; // Cambia si tienes una contraseña
$base_datos = "comentarios"; // Nueva base de datos para comentarios

$conexion = mysqli_connect($servidor, $usuario, $password, $base_datos);
if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

if (isset($_POST['comentarios'], $_POST['id'])) {
    $comentarios = $_POST['comentarios'];
    $id_pedido = $_POST['id'];
    $usuario = $_SESSION['username']; // Obtener el nombre de usuario desde la sesión

    // Insertar el comentario en la nueva base de datos
    $query = "INSERT INTO comentario (ficha, comentario) VALUES (?, ?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("is", $id_pedido, $comentarios);
    if ($stmt->execute()) {
        echo "Comentario enviado correctamente.";
    } else {
        echo "Hubo un error al guardar el comentario.";
    }
}
?>
