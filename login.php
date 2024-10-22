<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "turing_shop");

if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}

if (isset($_POST['register'])) {
    $nombre = $_POST['nombre'];
    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $tipo_usuario = $_POST['tipo_usuario'];

    $checkEmailQuery = $mysqli->prepare("SELECT COUNT(*) FROM usuarios WHERE correo = ?");
    $checkEmailQuery->bind_param("s", $correo);
    $checkEmailQuery->execute();
    $checkEmailQuery->bind_result($emailCount);
    $checkEmailQuery->fetch();
    $checkEmailQuery->close();

    if ($emailCount > 0) {
        echo "<script>alert('Este correo ya está registrado.');</script>";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $mysqli->prepare("INSERT INTO usuarios (nombre, correo, password, tipo_usuario) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $correo, $hashedPassword, $tipo_usuario);

        if ($stmt->execute()) {
            echo "<script>alert('Registro exitoso!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Error en el registro: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    }
}

if (isset($_POST['login'])) {
    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT id, password FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->bind_result($id, $hashedPassword);
    $stmt->fetch();

    if ($stmt->errno) {
        echo "<script>alert('Error en la consulta: " . $stmt->error . "');</script>";
    } else {
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['usuario'] = $correo;
            $_SESSION['usuario_id'] = $id;
            echo "<script>alert('Inicio de sesión exitoso!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Correo o contraseña incorrectos.');</script>";
        }
    }
    $stmt->close();
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Turing Shop</title>
    <link rel="stylesheet" href="style_login.css">
    <script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="slogan">
        <p>¡La mejor tienda de productos basados en IA, calidad garantizada!</p>
    </div>
    <header class="main-header">
        <div class="logo">
            <h1>TURING SHOP</h1>
        </div>
        <nav class="nav-bar">
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="#cards">Nuestros Productos</a></li>
                <li><a href="#ofertas">Ofertas</a></li>
                <li><a href="#nuevos-productos">Nuevos Productos</a></li>
            </ul>
        </nav>
        <div class="user-cart">
            <a href="ver_carrito.php"><img src="src/iconos/carrito_logo.png" alt="Carrito de Compras"></a>
        </div>
    </header>
    <section class="login-section">
        <h2>Iniciar Sesión o Registrarse</h2>
        <div class="login-container">
            <form action="login.php" method="POST">
                <h3>Inicio de sesión</h3>
                <input type="text" name="correo" placeholder="Correo electrónico" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit" name="login">Iniciar Sesión</button>
                <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
            </form>
            
            <form action="login.php" method="POST">
                <h3>Registrarse</h3>
                <input type="text" name="nombre" placeholder="Nombre completo" required>
                <input type="email" name="correo" placeholder="Correo electrónico" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <select name="tipo_usuario" required>
                    <option value="cliente">Cliente</option>
                    <option value="administrador">Administrador</option>
                </select>
                <button type="submit" name="register">Registrarse</button>
                <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
                <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
            </form>            
        </div>
    </section>
    <footer class="pie-pagina">
        <div class="grupo-1">
            <div class="box">
                <figure>
                    <a href="#">
                        <img src="src/iconos/logo_empresa.png" alt="Logo de la empresa">
                    </a>
                </figure>
            </div>
            <div class="box">
                <h2>TURING SHOP</h2>
                <p>Contáctanos:
                    <br>55 00 00 00 00<br>
                    <br>Av. Dirección de la empresa
                    <br>Ciudad de México, CDMX, 10000.<br>
                    <br>Correo-Electronico01@gmail.com
                </p>
            </div>
            <div class="box">
                <h2>Síguenos</h2>
                <div class="red-social">
                    <a href="https://www.facebook.com/turing.mx" class="fa fa-facebook" target="_blank"></a>
                    <a href="https://n9.cl/pwglu" class="fa fa-instagram" target="_blank"></a>
                    <a href="https://x.com/IaTuring" class="fa fa-twitter" target="_blank"></a>
                    <a href="https://www.youtube.com/@turing-ia6828" class="fa fa-youtube" target="_blank"></a>
                </div>
            </div>
        </div>
        <div class="grupo-2">
            <small>&copy; 2024 <b>TURING SHOP</b> - Todos los Derechos Reservados.</small>
        </div>
    </footer>
</body>
</html>
