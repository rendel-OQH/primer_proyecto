<html>
<head>
    <title>MySQL 01-consulta a BD(agenda)</title>
</head>
<body >
	<h1>mostrar nombres de la agenda.BD</h1>
	<?php
	$dp = mysqli_connect("localhost", "root", "","agenda");
	$sql = "SELECT * FROM direcciones";
	$resultados = mysqli_query($dp, $sql);
	while ($row = mysqli_fetch_assoc($resultados)) {
		echo "$row[Nombre] $row[Apellido]<br>\n";
	}
	mysqli_close($dp);
	?>
	
</body>
</html>


