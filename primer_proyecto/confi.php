<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Empleados</title>
    <link rel="stylesheet" href="pedido_complemento.css">
    <style>
        .contenido-empleados {
            width: 80%;
            margin: 50px;
            padding: 20px;
        }
        .eslogan {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 25px;
            font-weight: bold;
            font-family: 'Dancing Script', cursive;
            margin: 40px;
        }
        .pedidos-pendientes {
            width: 90%;
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            margin: 20px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

            /* Flexbox para distribuir pedidos en filas */
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        
        .pedidos-pendientes h2 {
            text-align: center;
            color: #6B4423;
            width: 100%;
        }
        
        .pedido {
            flex: 1 1 calc(30% - 20px); /* Ancho ajustado al 30% con separación */
            max-width: 30%;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        
        .pedido h3 {
            margin: 0;
            color: #6B4423;
        }

        .pedido p {
            margin: 5px 0;
        }
        
        button {
            background-color: #6B4423;
            color: #fff;
            border: none;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        button:hover {
            background-color: #6C451C;
        }
    </style>
</head>
<body style="background-color:#C2996B; margin:0px; padding:0px;">
    <?php include("plantilla_emple.phtml"); ?>
    <?php CabeceraPagina(); ?>
    <br><br><br>
    <hr style="margin-top:20px;" style="background-color:#C2996B">
	<div class="eslogan">
        “pedidos que ha realizado la gente”
    </div>
    
    <!-- Mostrar pedidos pendientes -->
    <div class="pedidos-pendientes">
        <h2>Gestión de Pedidos</h2>
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

        // Consultar pedidos pendientes agrupados por usuario
        $query_pedidos_grupo = "SELECT usuario, GROUP_CONCAT(id) AS ids_pedidos, GROUP_CONCAT(producto SEPARATOR ', ') AS productos, SUM(total) AS total
                                FROM compras WHERE estado = 'pendiente' GROUP BY usuario";
        $result_pedidos_grupo = mysqli_query($conexion, $query_pedidos_grupo);

        if (mysqli_num_rows($result_pedidos_grupo) > 0) {
            while ($grupo = mysqli_fetch_assoc($result_pedidos_grupo)) {
                $usuario = $grupo['usuario'];
                $ids_pedidos = $grupo['ids_pedidos'];
                $productos = $grupo['productos'];
                $total = $grupo['total'];

                echo "<div class='pedido'>";
                echo "<h3>Pedidos de $usuario</h3>";
                echo "<p>Productos: $productos</p>";
                echo "<p>Total: $$total</p>";
                echo "<form method='post' action='gestionar_pedido.php'>";
                echo "<input type='hidden' name='ids_pedidos' value='$ids_pedidos'>";
                echo "<button type='submit' name='accion' value='confirmar_todos'>Confirmar Pedido</button>";
                echo "<button type='submit' name='accion' value='cancelar_todos'>Cancelar Todos</button>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "<p>No hay pedidos pendientes.</p>";
        }
        ?>
    </div>

    <?php PiePagina(); ?>
</body>
</html>
