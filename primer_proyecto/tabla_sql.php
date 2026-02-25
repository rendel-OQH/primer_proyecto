<html>

<head>
<title>MySQL 02 - Consulta BD con tabla (Agenda)</title>
</head>

<body>

<h1>MySQL 02 - Consulta BD con tabla (Agenda)</h1>

<?php

$dp = mysqli_connect("localhost", "root", "", "agenda");

if (!$dp) {
    die("Error de conexión: " . mysqli_connect_error());
}

$sql = "SELECT * FROM direcciones";

$resultado = mysqli_query($dp, $sql);

$campos = mysqli_num_fields($resultado);

$filas = mysqli_num_rows($resultado);

echo "<p>Cantidad de filas: $filas</p>\n";

echo "<table border='1' cellspacing='0'>\n"; // Empezar tabla

echo "<tr>"; // Crear fila

for ($i = 0; $i < $campos; $i++) {
    $nombrecampo = mysqli_fetch_field_direct($resultado, $i)->name; // Obtener nombre del campo
    echo "<th>$nombrecampo</th>"; // Mostrar nombre del campo
}

echo "</tr>\n"; // Cerrar fila

while ($row = mysqli_fetch_assoc($resultado)) {
    echo "<tr>"; // Crear fila
    foreach ($row as $value) {
        echo "<td>$value&nbsp;</td>";
    }
    echo "</tr>\n"; // Cerrar fila
}

echo "</table>\n"; // Cerrar tabla

mysqli_close($dp);

?>

</body>
</html>
