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

// Consulta para obtener los comentarios junto con el usuario y el platillo
$query_comentarios = "SELECT usuario, comida, comentario FROM comentarios";
$result_comentarios = mysqli_query($conexion, $query_comentarios);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentarios de Clientes</title>
	<link rel="stylesheet" href="plantilla_con.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #C2996B;
            margin: 0;
            padding: 0;
        }
        .contenedor-comentarios {
            width: 80%;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .comentarios-header {
            text-align: center;
            color: #6B4423;
            margin-bottom: 20px;
        }
        .comentario {
            margin-bottom: 15px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .comentario strong {
            color: #6B4423;
        }
        .comentario p {
            margin: 5px 0;
        }
    </style>
</head>
<body style="background-color:#C2996B; margin:0px; padding:0px;">
    <?php include("plantilla_emple.phtml"); ?>
    <?php CabeceraPagina(); ?>
	<br><br><br>
    <hr style="margin-top:20px;" style="background-color:#C2996B">
    <div class="contenedor-comentarios">
        <h2 class="comentarios-header">Comentarios de Clientes</h2>
        <?php
        if (mysqli_num_rows($result_comentarios) > 0) {
            while ($comentario = mysqli_fetch_assoc($result_comentarios)) {
                $usuario = $comentario['usuario'];
                $comida = $comentario['comida'];
                $comentario_texto = $comentario['comentario'];

                echo "<div class='comentario'>";
                echo "<p><strong>Usuario:</strong> $usuario</p>";
                echo "<p><strong>Platillo:</strong> $comida</p>";
                echo "<p><strong>Comentario:</strong> $comentario_texto</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No hay comentarios disponibles.</p>";
        }
        ?>
    </div>
	    <?php PiePagina(); ?>
</body>
</html>
