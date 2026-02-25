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

// Supongamos que ya tienes el usuario almacenado en una sesión
session_start();
if (!isset($_SESSION['username'])) {
    die("Acceso denegado. Por favor, inicia sesión.");
}

$usuario = $_SESSION['username']; // Este será el identificador único del usuario

// Procesar el formulario si se envía
$successMessage = "";
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener valores del formulario
    $reply_1 = $_POST['reply_1'] ?? '';
    $reply_2 = $_POST['reply_2'] ?? '';
    $reply_3 = $_POST['reply_3'] ?? '';
    $reply_4 = $_POST['reply_4'] ?? '';

    // Validar que todas las respuestas están completas
    if (!empty($reply_1) && !empty($reply_2) && !empty($reply_3) && !empty($reply_4)) {
        // Verificar si el usuario ya participó en la encuesta
        $checkUserQuery = "SELECT * FROM encuesta WHERE email = '" . mysqli_real_escape_string($conexion, $usuario) . "'";
        $result = mysqli_query($conexion, $checkUserQuery);

        if (mysqli_num_rows($result) > 0) {
            $errorMessage = "Ya has participado en esta encuesta. Gracias.";
        } else {
            // Insertar las respuestas
            $query = "INSERT INTO encuesta (email, respuesta_1, respuesta_2, respuesta_3, respuesta_4) 
                      VALUES (
                        '" . mysqli_real_escape_string($conexion, $usuario) . "',
                        '" . mysqli_real_escape_string($conexion, $reply_1) . "',
                        '" . mysqli_real_escape_string($conexion, $reply_2) . "',
                        '" . mysqli_real_escape_string($conexion, $reply_3) . "',
                        '" . mysqli_real_escape_string($conexion, $reply_4) . "'
                      )";
            if (mysqli_query($conexion, $query)) {
                $successMessage = "Gracias por participar en nuestra encuesta.";
            } else {
                $errorMessage = "Error al guardar las respuestas: " . mysqli_error($conexion);
            }
        }
    } else {
        $errorMessage = "Por favor, responde todas las preguntas.";
    }
}

?>


<div class="eslogan">
            “𝒰𝓃 𝑅𝒾𝓃𝒸ó𝓃 𝒟𝑜𝓃𝒹𝑒 𝐸𝓁 𝒟í𝒶 𝒴 𝐿𝒶 𝒩𝒐𝒸𝒽𝑒 𝒮𝑒 𝐸𝓃𝒸𝓊𝑒𝓃𝓉𝓇𝒶𝓃 𝐸𝓃 𝒞𝒶𝒹𝒶 𝒮𝑜𝓇𝒷𝑜”
        </div>
    <div class="todo">
        
		<div class="derecha">
                <div class="mensaje_p">
                    <center class="mensaje">¡Descubre las delicias que tenemos para ti hoy!</center>
                    <br class="mensaje2"> En Luna y Sombra, cada taza cuenta una historia entre el brillo del día y la calma de la noche. 
                    Ven a disfrutar de un espacio acogedor en el corazón de la ciudad, donde los sabores y aromas se mezclan para crear momentos inolvidables. 
                    Nuestro equipo está aquí para ofrecerte una experiencia cálida y auténtica, desde una charla tranquila hasta ese impulso de energía para tu día. 
                    <br>Ya sea que busques inspiración o un momento de paz, en Luna y Sombra encontrarás el lugar perfecto para dejarte llevar. ¡Nos vemos pronto!</br>
                    </br>
                </div>
                <div class="menu" style="border-radius: 15px; height:480px; width:500px;">
                    <div class="titulo_menu">
                        <center>𝑀𝑒𝓃ú 𝒹𝑒𝓁 𝒹í𝒶</center>
                    </div>
                    <div class="imagen_menu" style="border-radius: 15px; padding: 15px; background-color: #6C451C;">
                        <img id="carrusel" src="con1.jpg" width="350px" height="350px" style="border-radius: 15px;">
                        <div class="buttons">
                            <button onclick="prevImage()">◀</button>
                            <button onclick="nextImage()">▶</button>
                        </div>
                        <center>
                        <div id="image-caption" style="color: white; font-weight: bold; margin-top: 10px;">
                            Enchiladas con aguja norteña <br>
                            3 Enchiladas con queso y crema<br>
                            1 pieza de aguaja norteña<br>
                            chile toreado con tocino y queso<br>
                            nopal asado y frijoles fritos
                        </div>
                        </center>
                    </div>
                </div>
        </div>

        <div class="menu_formu">
            <div class="formulario">
				<div class="e-card" style="width: 360px; height: auto;">
					<div class="wave"></div>
					<div class="wave"></div>
					<div class="wave"></div>
					<div class="infotop">
						<h1>Encuesta</h1>
						<form id="survey-form" action="" method="post">
							<!-- Pregunta 1 -->
							<h3>¿Qué es lo que más les gusta de nuestro menú?</h3>
							<input type="radio" name="reply_1" value="Desayunos" required> Desayunos<br>
							<input type="radio" name="reply_1" value="Postres" required> Postres<br>
							<input type="radio" name="reply_1" value="Bebidas" required> Bebidas<br><br>

							<!-- Pregunta 2 -->
							<h3>¿Qué prefieren en nuestras bebidas?</h3>
							<input type="radio" name="reply_2" value="Café" required> Café<br>
							<input type="radio" name="reply_2" value="Té" required> Té<br>
							<input type="radio" name="reply_2" value="Jugos Naturales" required> Jugos Naturales<br><br>

							<!-- Pregunta 3 -->
							<h3>¿Cómo califican nuestro servicio?</h3>
							<input type="radio" name="reply_3" value="Excelente" required> Excelente<br>
							<input type="radio" name="reply_3" value="Bueno" required> Bueno<br>
							<input type="radio" name="reply_3" value="Regular" required> Regular<br><br>

							<!-- Pregunta 4 -->
							<h3>¿Volverían a visitarnos?</h3>
							<input type="radio" name="reply_4" value="Sí" required> Sí<br>
							<input type="radio" name="reply_4" value="No" required> No<br><br>

							<!-- Mensajes -->
							<div id="message">
								<?php
								if ($successMessage) {
									echo "<p style='color:green;'>$successMessage</p>";
								} elseif ($errorMessage) {
									echo "<p style='color:red;'>$errorMessage</p>";
								}
								?>
							</div>

							<!-- Botón de envío -->
							<button id="vote-button" class="boton_encues" name="submit" type="submit">¡Vota!</button>
						</form>
					</div>
				</div>
			</div>
        </div>
    </div>
	<?php PiePagina(); ?>
</body>
</html>
