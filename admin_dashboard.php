<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] !== 'administrador') {
    header("Location: login.html");
    exit();
}
echo "Bienvenido, " . $_SESSION['nombre'] . ". Esta es tu página de administrador.";
?>
