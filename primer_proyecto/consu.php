<?php
// Conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "cafeteria";
$conexion = mysqli_connect($servidor, $usuario, $password, $base_datos);

if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

session_start();
if (!isset($_SESSION['username'])) {
    die("Acceso denegado. Por favor, inicia sesión.");
}

$nombre_usuario = $_SESSION['username'];

// Manejar la solicitud para cambiar el estado del pedido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'revertir_pedido') {
    $pedido_id = $_POST['pedido_id'];

    $query = "UPDATE compras SET estado = 'pendiente' WHERE id = ? AND usuario = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("is", $pedido_id, $nombre_usuario);

    if ($stmt->execute()) {
        echo "Estado actualizado correctamente";
    } else {
        echo "Error al actualizar el estado";
    }
    exit; // Salir para evitar cargar el resto del HTML
}

// Consulta SQL para obtener los pedidos del usuario
$query = "SELECT * FROM compras WHERE usuario = ? ORDER BY fecha DESC";
$stmt = $conexion->prepare($query);
$stmt->bind_param("s", $nombre_usuario);
$stmt->execute();
$resultado = $stmt->get_result();

$pedidos = $resultado->num_rows > 0 ? $resultado->fetch_all(MYSQLI_ASSOC) : [];

// Guardar comentario en la tabla `comentarios`
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comentario'], $_POST['producto'])) {
    $comentario = $_POST['comentario'];
    $producto = $_POST['producto'];

    $query = "INSERT INTO comentarios (comentario, usuario, comida) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("sss", $comentario, $nombre_usuario, $producto);

    if ($stmt->execute()) {
        echo "<script>alert('Comentario enviado exitosamente');</script>";
    } else {
        echo "<script>alert('Error al guardar el comentario');</script>";
    }
}
?>
<html>
<head>
    <title>Encuesta - Luna y Sombra</title>
    <link rel="stylesheet" href="comple-index.css">
    <script src="carrusel.js"></script>
</head>
<body style="background-color:#C2996B; margin:0px; padding:0px;">
    <?php include("plantilla.phtml"); ?>
    <?php CabeceraPagina(); ?>
    <br><br><br>
    <hr style="margin-top:20px;">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            color: #6B4423;
            text-align: center;
        }

        .pedido {
            background-color: #f9f9f9;
            margin: 20px 0;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .pedido p {
            margin: 5px 0;
        }

        .boton {
            background-color: #6C451C;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            display: inline-block;
            margin-top: 10px;
        }

        .boton:hover {
            background-color: #6B4423;
        }

        .formulario-comentario {
            display: none;
            margin-top: 10px;
        }

        textarea {
            width: 100%;
            height: 80px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            resize: none;
        }

        .formulario-comentario button {
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #6C451C;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>

    <div class="container">
        <h1>Historial de Pedidos</h1>
        <?php if (count($pedidos) > 0): ?>
            <?php foreach ($pedidos as $pedido): ?>
                <div class="pedido">
                    <p><strong>Fecha:</strong> <?php echo $pedido['fecha']; ?></p>
                    <p><strong>Productos:</strong> <?php echo $pedido['producto']; ?></p>
                    <p><strong>Total:</strong> $<?php echo $pedido['total']; ?></p>
                    <p><strong>Estado:</strong> <span id="estado-<?php echo $pedido['id']; ?>"><?php echo $pedido['estado']; ?></span></p>

                    <?php if ($pedido['estado'] == 'cancelado'): ?>
                        <button class="boton" onclick="volverPedido(<?php echo $pedido['id']; ?>)">Volver a realizar este pedido</button>
                    <?php endif; ?>

                    <button class="boton" onclick="mostrarFormulario(<?php echo $pedido['id']; ?>)">Dejar Comentario</button>

                    <!-- Formulario de retroalimentación -->
                    <div class="formulario-comentario" id="formulario-<?php echo $pedido['id']; ?>">
                        <form method="POST">
                            <textarea name="comentario" placeholder="Escribe tu comentario..."></textarea>
                            <input type="hidden" name="producto" value="<?php echo $pedido['producto']; ?>">
                            <button type="submit">Enviar comentario</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No tienes pedidos realizados.</p>
        <?php endif; ?>
    </div>

    <script>
        function volverPedido(id) {
            if (confirm("¿Estás seguro de volver a realizar este pedido?")) {
                const formData = new FormData();
                formData.append('accion', 'revertir_pedido');
                formData.append('pedido_id', id);

                fetch('', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    location.reload(); // Recargar la página
                })
                .catch(error => console.error('Error:', error));
            }
        }

        function mostrarFormulario(id) {
            const formulario = document.getElementById(`formulario-${id}`);
            formulario.style.display = formulario.style.display === "block" ? "none" : "block";
        }
    </script>
    <?php PiePagina(); ?>
</body>
</html>
