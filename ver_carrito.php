<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

$id_usuario = $_SESSION['usuario_id'];

$query = "
    SELECT productos.nombre, productos.precio, carrito.cantidad
    FROM carrito
    JOIN productos ON carrito.id_producto = productos.id
    WHERE carrito.id_usuario = ?
";

$conn = new mysqli("localhost", "root", "", "turing_shop");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id_usuario);

if (!$stmt->execute()) {
    die("Error al ejecutar la consulta: " . $stmt->error);
}

$result = $stmt->get_result();

$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - Turing Shop</title>
    <script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style_carrito.css">
    <script>
        function confirmarCompra() {
            return confirm("¿Estás seguro de que deseas realizar la compra?");
        }
    </script>
</head>
<body>
<div class="slogan">
        <p>¡La mejor tienda de productos basados en IA, calidad garantizada!</p>
    </div>
    <header class="main-header">
        <div class="logo">
            <h1>TURING SHOP</h1>
        </div>
    </header>
        <h1>Tu Carrito de Compras</h1>
    
    <table>
        <tr>
            <th scope="col">Producto</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Precio Unitario</th>
            <th scope="col">Total</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                    <td><?= htmlspecialchars($row['cantidad']) ?></td>
                    <td>$<?= number_format($row['precio'], 2) ?></td>
                    <td>$<?= number_format($row['cantidad'] * $row['precio'], 2) ?></td>
                </tr>
                <?php $total += $row['cantidad'] * $row['precio']; ?>
            <?php endwhile; ?>
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td><strong>$<?= number_format($total, 2) ?></strong></td>
            </tr>
        <?php else: ?>
            <tr>
                <td colspan="4">Tu carrito está vacío.</td>
            </tr>
        <?php endif; ?>
    </table>

    <?php if ($total > 0): ?>
        <form method="POST" action="confirmar_compra.php" onsubmit="return confirmarCompra()">
            <input type="hidden" name="total" value="<?= $total ?>">
            <button type="submit" class="btn-comprar">Confirmar compra</button>
        </form>
    <?php endif; ?>

    <div style="text-align: center;">
    <a href="index.php" class="btn-seguir-comprando">Seguir comprando</a>
</div>
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
