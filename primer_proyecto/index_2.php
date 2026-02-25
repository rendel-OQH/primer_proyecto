<?php
// Conectar a la base de datos
$conn = new mysqli('localhost', 'root', '', 'cafeteria');

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Iniciar sesión
session_start();

// Manejo de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consultar a la base de datos
    $stmt = $conn->prepare("SELECT roles FROM contraseñas WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($role);
        $stmt->fetch();

        // Establecer las variables de sesión
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;

        if ($role === 'cliente') {
            header("Location: inicial.php");
        } elseif ($role === 'empleado') {
            header("Location: empleado.php");
        }
        exit;
    } else {
        $error = "¡Usuario o contraseña incorrectos!";
    }
    $stmt->close();
}

// Manejo de registro
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $role = 'cliente'; // Todos los registros nuevos son clientes por defecto

    // Validar si el usuario ya existe
    $check_stmt = $conn->prepare("SELECT * FROM contraseñas WHERE username = ?");
    $check_stmt->bind_param("s", $new_username);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $register_error = "El usuario ya existe.";
    } else {
        // Insertar nuevo usuario con dirección y correo electrónico
        $insert_stmt = $conn->prepare("INSERT INTO contraseñas (username, password, roles, direccion, email) VALUES (?, ?, ?, ?, ?)");
        $insert_stmt->bind_param("sssss", $new_username, $new_password, $role, $direccion, $email);
        if ($insert_stmt->execute()) {
            $register_success = "¡Registro exitoso! Ahora puedes iniciar sesión.";
        } else {
            $register_error = "Error al registrar el usuario.";
        }
        $insert_stmt->close();
    }
    $check_stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión / Registro</title>
    <style>
        body {
            background-image: url('fon1.gif');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            width: 300px;
        }
        .logo {
            margin-bottom: 20px;
        }
        .form input {
            display: block;
            width: 90%;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .form button {
            background-color: #6C451C;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }
        .form button:hover {
            background-color: #C2996B;
        }
        .error, .success {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
        .success {
            color: green;
        }
        .toggle-buttons {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .toggle-buttons button {
            flex: 1;
            margin: 0 5px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #6C451C;
            color: white;
        }
        .toggle-buttons button.active {
            background-color: #C2996B;
        }
    </style>
    <script>
        function toggleForm(formType) {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            const loginButton = document.getElementById('login-button');
            const registerButton = document.getElementById('register-button');

            if (formType === 'login') {
                loginForm.style.display = 'block';
                registerForm.style.display = 'none';
                loginButton.classList.add('active');
                registerButton.classList.remove('active');
            } else {
                loginForm.style.display = 'none';
                registerForm.style.display = 'block';
                loginButton.classList.remove('active');
                registerButton.classList.add('active');
            }
        }
    </script>
</head>
<body onload="toggleForm('login')">
    <div class="container">
        <div class="logo">
            <img src="logo2.png" alt="Logo de la Cafetería Luna y Sombra" width="150">
        </div>
        <div class="toggle-buttons">
            <button id="login-button" onclick="toggleForm('login')">Iniciar Sesión</button>
            <button id="register-button" onclick="toggleForm('register')">Registrarse</button>
        </div>
        <form method="POST" id="login-form" class="form">
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit" name="login">Iniciar Sesión</button>
            <?php if (isset($error)): ?>
                <p class="error"><?= $error ?></p>
            <?php endif; ?>
        </form>
        <form method="POST" id="register-form" class="form" style="display: none;">
            <input type="text" name="new_username" placeholder="Nuevo Usuario" required>
            <input type="password" name="new_password" placeholder="Nueva Contraseña" required>
            <input type="text" name="direccion" placeholder="Dirección" required>
            <input type="email" name="email" placeholder="Correo Electrónico" required>
            <button type="submit" name="register">Crear Cuenta</button>
            <?php if (isset($register_error)): ?>
                <p class="error"><?= $register_error ?></p>
            <?php elseif (isset($register_success)): ?>
                <p class="success"><?= $register_success ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
