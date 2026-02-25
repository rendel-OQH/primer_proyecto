<html>
<head>
    <title>Introducir Altas</title>
</head>
<body>
    <h3>Introducir Altas</h3>
    <?php
    include("acceso.inc.php");

    // Inicializar variables para evitar errores
    $data = [
        'Tratamiento' => '',
        'Nombre' => '',
        'Apellido' => '',
        'Calle' => '',
        'CP' => '',
        'Localidad' => '',
        'Tel' => '',
        'Movil' => '',
        'Mail' => '',
        'Website' => '',
        'Categoria' => '',
        'Notas' => ''
    ];

    if (isset($_POST['submit'])) {
        if (empty($_POST['Nombre'])) {
            echo "<p>Introduzca el <b>nombre</b>.</p>";
        } elseif (strlen($_POST['Apellido']) < 3) {
            echo "<p>El apellido debe tener como mínimo <b>3</b> caracteres.</p>";
        } else {
            // Insertar datos en la tabla `altas`
            $sql = "INSERT INTO altas (Tratamiento, Nombre, Apellido, Calle, CP, Localidad, Tel, Movil, Mail, Website, Categoria, Notas)
                    VALUES (
                        '$_POST[Tratamiento]',
                        '$_POST[Nombre]',
                        '$_POST[Apellido]',
                        '$_POST[Calle]',
                        '$_POST[CP]',
                        '$_POST[Localidad]',
                        '$_POST[Tel]',
                        '$_POST[Movil]',
                        '$_POST[Mail]',
                        '$_POST[Website]',
                        '$_POST[Categoria]',
                        '$_POST[Notas]'
                    )";

            if ($conexion->query($sql)) {
                echo "<p>Datos agregados con éxito.</p>";
            } else {
                echo "<p>Error al agregar datos: " . mysqli_error($conexion) . "</p>";
            }
        }
    } elseif (isset($_GET['action']) && $_GET['action'] === 'editar' && isset($_GET['id'])) {
        // Verificar si se envió el ID
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id > 0) {
            $sql3 = "SELECT * FROM altas WHERE id = $id";
            $result = $conexion->query($sql3);
            if ($result->num_rows > 0) {
                $data = $result->fetch_assoc();
            } else {
                echo "<p>No se encontró el registro con ID: $id.</p>";
            }
        }
    } elseif (isset($_POST['update'])) {
        // Actualizar datos en la tabla
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if ($id > 0) {
            $sql = "UPDATE altas SET 
                        Tratamiento = '$_POST[Tratamiento]',
                        Nombre = '$_POST[Nombre]',
                        Apellido = '$_POST[Apellido]',
                        Calle = '$_POST[Calle]',
                        CP = '$_POST[CP]',
                        Localidad = '$_POST[Localidad]',
                        Tel = '$_POST[Tel]',
                        Movil = '$_POST[Movil]',
                        Mail = '$_POST[Mail]',
                        Website = '$_POST[Website]',
                        Categoria = '$_POST[Categoria]',
                        Notas = '$_POST[Notas]'
                    WHERE id = $id";

            if ($conexion->query($sql)) {
                echo "<p>Datos actualizados con éxito.</p>";
            } else {
                echo "<p>Error al actualizar datos: " . mysqli_error($conexion) . "</p>";
            }
        } else {
            echo "<p>Error: ID inválido.</p>";
        }
    }

    // Obtener las categorías desde la tabla `altas`
    $sql2 = "SELECT DISTINCT Categoria FROM altas";
    $resultado2 = $conexion->query($sql2);
    $campocat = "";
    while ($row = $resultado2->fetch_assoc()) {
        $campocat .= "<option value='{$row['Categoria']}'>{$row['Categoria']}</option>\n";
    }

    // Formulario
    echo "<form action='{$_SERVER['PHP_SELF']}' method='post'>
        <input type='hidden' name='id' value='" . (isset($data['id']) ? $data['id'] : '') . "'>
        <table>
            <tr><td>Tratamiento:</td>
                <td>
                    <select name='Tratamiento'>
                        <option " . ($data['Tratamiento'] == 'Sr.' ? "selected" : "") . ">Sr.</option>
                        <option " . ($data['Tratamiento'] == 'Sra.' ? "selected" : "") . ">Sra.</option>
                    </select>
                </td>
            </tr>
            <tr><td>Nombre:</td><td><input type='text' name='Nombre' value='{$data['Nombre']}'></td></tr>
            <tr><td>Apellido:</td><td><input type='text' name='Apellido' value='{$data['Apellido']}'></td></tr>
            <tr><td>Calle:</td><td><input type='text' name='Calle' value='{$data['Calle']}'></td></tr>
            <tr><td>CP:</td><td><input type='text' name='CP' value='{$data['CP']}'></td></tr>
            <tr><td>Localidad:</td><td><input type='text' name='Localidad' value='{$data['Localidad']}'></td></tr>
            <tr><td>Tel:</td><td><input type='text' name='Tel' value='{$data['Tel']}'></td></tr>
            <tr><td>Movil:</td><td><input type='text' name='Movil' value='{$data['Movil']}'></td></tr>
            <tr><td>E-mail:</td><td><input type='text' name='Mail' value='{$data['Mail']}'></td></tr>
            <tr><td>Website:</td><td><input type='text' name='Website' value='{$data['Website']}'></td></tr>
            <tr><td>Categoría:</td>
                <td>
                    <select name='Categoria'>
                        $campocat
                    </select>
                </td>
            </tr>
            <tr><td>Notas:</td>
                <td><textarea cols='60' rows='4' name='Notas'>{$data['Notas']}</textarea></td>
            </tr>
            <tr><td><input type='submit' value='Introducir datos' name='submit'></td></tr>
        </table>
    </form>";

    // Botón para imprimir todos los datos
    echo "<h3>Datos registrados</h3>";
    echo "<form action='{$_SERVER['PHP_SELF']}' method='get'>
            <input type='submit' name='view' value='Mostrar datos'>
          </form>";

    if (isset($_GET['view'])) {
        // Mostrar datos
        $sql = "SELECT * FROM altas";
        $result = $conexion->query($sql);
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Tratamiento</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Calle</th>
                    <th>CP</th>
                    <th>Localidad</th>
                    <th>Tel</th>
                    <th>Movil</th>
                    <th>Mail</th>
                    <th>Website</th>
                    <th>Categoría</th>
                    <th>Notas</th>
                    <th>Acciones</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['Tratamiento']}</td>
                    <td>{$row['Nombre']}</td>
                    <td>{$row['Apellido']}</td>
                    <td>{$row['Calle']}</td>
                    <td>{$row['CP']}</td>
                    <td>{$row['Localidad']}</td>
                    <td>{$row['Tel']}</td>
                    <td>{$row['Movil']}</td>
                    <td>{$row['Mail']}</td>
                    <td>{$row['Website']}</td>
                    <td>{$row['Categoria']}</td>
                    <td>{$row['Notas']}</td>
                    <td><a href='{$_SERVER['PHP_SELF']}?action=editar&id={$row['id']}'>Editar</a></td>
                </tr>";
        }
        echo "</table>";
    }

    $conexion->close();
    ?>
</body>
</html>
