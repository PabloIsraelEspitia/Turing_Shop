<?php
session_start();

$conn = new mysqli("localhost", "root", "", "turing_shop");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

$id_usuario = $_SESSION['usuario_id'];
$id_producto = isset($_POST['id_producto']) ? $_POST['id_producto'] : null;

if ($id_producto === null) {
    header('Location: index.php');
    exit;
}

$query = "SELECT cantidad FROM carrito WHERE id_usuario = ? AND id_producto = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $id_usuario, $id_producto);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $query = "UPDATE carrito SET cantidad = cantidad + 1 WHERE id_usuario = ? AND id_producto = ?";
} else {
    $query = "INSERT INTO carrito (id_usuario, id_producto, cantidad) VALUES (?, ?, 1)";
}

$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $id_usuario, $id_producto);

if ($stmt->execute()) {
    echo "<script>alert('Producto añadido al carrito exitosamente.'); window.location.href='index.php';</script>";
} else {
    echo "Error al añadir el producto al carrito: " . $stmt->error;
}

$stmt->close();
$conn->close();
