<?php
// Conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "cafeteria";

$conexion = mysqli_connect($servidor, $usuario, $password, $base_datos);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_pedido'])) {
        // Acción para pedidos individuales
        $id_pedido = intval($_POST['id_pedido']);
        $accion = $_POST['accion'];

        if ($id_pedido > 0) {
            if ($accion === 'confirmar') {
                $query = "UPDATE compras SET estado = 'confirmado' WHERE id = $id_pedido";
            } elseif ($accion === 'cancelar') {
                $query = "UPDATE compras SET estado = 'cancelado' WHERE id = $id_pedido";
            }

            if (mysqli_query($conexion, $query)) {
                header("Location: empleado.php");
            } else {
                echo "Error al actualizar el pedido: " . mysqli_error($conexion);
            }
        } else {
            echo "ID del pedido no válido.";
        }
    } elseif (isset($_POST['ids_pedidos'])) {
        // Acción para confirmar/cancelar todos los pedidos de un usuario
        $ids_pedidos = $_POST['ids_pedidos'];
        $accion = $_POST['accion'];

        if (!empty($ids_pedidos)) {
            $ids_pedidos_array = explode(',', $ids_pedidos);
            $ids_pedidos_sql = implode(',', array_map('intval', $ids_pedidos_array));

            if ($accion === 'confirmar_todos') {
                $query = "UPDATE compras SET estado = 'confirmado' WHERE id IN ($ids_pedidos_sql)";
            } elseif ($accion === 'cancelar_todos') {
                $query = "UPDATE compras SET estado = 'cancelado' WHERE id IN ($ids_pedidos_sql)";
            }

            if (mysqli_query($conexion, $query)) {
                header("Location: empleado.php");
            } else {
                echo "Error al actualizar los pedidos: " . mysqli_error($conexion);
            }
        } else {
            echo "No se recibieron IDs de pedidos.";
        }
    }
}
?>

