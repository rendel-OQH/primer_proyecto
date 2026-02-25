<html>
<head>
    <title>Gestión de Empleados</title>
    <link rel="stylesheet" href="pedido_complemento.css">
    <style>
        .contenido-empleados {
            width: 80%;
            margin: auto;
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
        .resultados-encuesta, .pedidos-pendientes {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .resultados-encuesta h2, .pedidos-pendientes h2 {
            text-align: center;
            color: #6B4423;
        }
        .pedido {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 10px;
            background-color: #f9f9f9;
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
        /* Estilo de la barra de carga */
        .barra-carga {
            width: 100%;
            height: 30px;
            background-color: #e0e0e0;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .barra-carga div {
            height: 100%;
            border-radius: 5px;
            text-align: center;
            line-height: 30px;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body style="background-color:#C2996B; margin:0px; padding:0px;">
    <?php include("plantilla_emple.phtml"); ?>
    <?php CabeceraPagina(); ?>
    <br><br><br>
    <hr style="margin-top:20px;" style="background-color:#C2996B">
    <div class="eslogan">
        “Bienvenidos empleados a la zona administrativa del café Luna y Sombra”
    </div>
    <div class="contenido-empleados">
        <!-- Mostrar resultados de la encuesta -->
        <div class="resultados-encuesta">
            <h2>Resultados de la Encuesta</h2>
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

            // Consultar resultados de la encuesta
            $query_encuesta = "SELECT
                COUNT(*) AS total_personas,
                SUM(CASE WHEN respuesta_1 = 'Desayunos' THEN 1 ELSE 0 END) AS votos_desayunos,
                SUM(CASE WHEN respuesta_1 = 'Postres' THEN 1 ELSE 0 END) AS votos_postres,
                SUM(CASE WHEN respuesta_1 = 'Bebidas' THEN 1 ELSE 0 END) AS votos_bebidas,
                SUM(CASE WHEN respuesta_2 = 'Cafe' THEN 1 ELSE 0 END) AS votos_cafe,
                SUM(CASE WHEN respuesta_2 = 'Te' THEN 1 ELSE 0 END) AS votos_te,
                SUM(CASE WHEN respuesta_2 = 'Jugos Naturales' THEN 1 ELSE 0 END) AS votos_jugos,
                SUM(CASE WHEN respuesta_3 = 'Excelente' THEN 1 ELSE 0 END) AS votos_excelente,
                SUM(CASE WHEN respuesta_3 = 'Bueno' THEN 1 ELSE 0 END) AS votos_bueno,
                SUM(CASE WHEN respuesta_3 = 'Regular' THEN 1 ELSE 0 END) AS votos_regular,
                SUM(CASE WHEN respuesta_4 = 'Si' THEN 1 ELSE 0 END) AS votos_si,
                SUM(CASE WHEN respuesta_4 = 'No' THEN 1 ELSE 0 END) AS votos_no
            FROM encuesta";

            $result_encuesta = mysqli_query($conexion, $query_encuesta);
            $votos = mysqli_fetch_assoc($result_encuesta);

            if ($votos) {
                $total_personas = $votos['total_personas']; // Total de personas que respondieron

                if ($total_personas > 0) {
                    // Función para calcular el porcentaje
                    function calcularPorcentaje($votos_opcion, $total_personas) {
                        return round(($votos_opcion / $total_personas) * 100, 2);
                    }

                    // Mostrar preguntas y sus respectivas opciones
                    $preguntas = [
                        '¿Qué es lo que más les gusta de nuestro menú?' => [
                            'Desayunos' => 'votos_desayunos',
                            'Postres' => 'votos_postres',
                            'Bebidas' => 'votos_bebidas'
                        ],
                        '¿Qué prefieren en nuestras bebidas?' => [
                            'Café' => 'votos_cafe',
                            'Té' => 'votos_te',
                            'Jugos Naturales' => 'votos_jugos'
                        ],
                        '¿Cómo califican nuestro servicio?' => [
                            'Excelente' => 'votos_excelente',
                            'Bueno' => 'votos_bueno',
                            'Regular' => 'votos_regular'
                        ],
                        '¿Volverían a visitarnos?' => [
                            'Sí' => 'votos_si',
                            'No' => 'votos_no'
                        ]
                    ];

                    foreach ($preguntas as $pregunta => $opciones) {
                        echo "<h3>$pregunta</h3>";
                        foreach ($opciones as $opcion => $clave) {
                            $votos_opcion = isset($votos[$clave]) ? $votos[$clave] : 0;
                            $porcentaje = calcularPorcentaje($votos_opcion, $total_personas);
                            echo "<p>$opcion: $votos_opcion votos</p>";
                            echo "<div class='barra-carga'><div style='width: $porcentaje%; background-color: #6B4423;'>$porcentaje%</div></div>";
                        }
                    }
                } else {
                    echo "<p>No hay respuestas registradas aún.</p>";
                }
            } else {
                echo "<p>No hay datos de encuesta disponibles.</p>";
            }
            ?>
        </div>
    </div>
    <?php PiePagina(); ?>
</body>
</html>

