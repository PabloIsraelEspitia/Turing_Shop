<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = $_SESSION['usuario_id'];
    $total = $_POST['total'];

    $conn = new mysqli("localhost", "root", "", "turing_shop");

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $query = "INSERT INTO ordenes (id_usuario, total, fecha) VALUES (?, ?, NOW())";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('id', $id_usuario, $total);

    if ($stmt->execute()) {
        echo "<script>alert('Compra realizada con éxito.'); window.location.href='index.php';</script>";
    } else {
        echo "Error al confirmar la compra: " . $stmt->error;
    }

    $query_vaciar_carrito = "DELETE FROM carrito WHERE id_usuario = ?";
    $stmt_vaciar = $conn->prepare($query_vaciar_carrito);
    $stmt_vaciar->bind_param('i', $id_usuario);
    $stmt_vaciar->execute();

    $stmt->close();
    $conn->close();

} else {
    echo "Acceso no permitido.";
}
