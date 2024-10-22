<?php
session_start();

$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turing Shop</title>
    <link rel="stylesheet" href="style.css">
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
                <li><a href="#home">Inicio</a></li>
                <li><a href="#cards">Nuestros Productos</a></li>
                <li><a href="#ofertas">Ofertas</a></li>
                <li><a href="#nuevos-productos">Nuevos Productos</a></li>
            </ul>
        </nav>
        <div class="user-cart">
    <a href="ver_carrito.php"><img src="src/iconos/carrito_logo.png" alt="Carrito de Compras"></a>
    <?php if (!isset($_SESSION['usuario'])): ?>
        <a href="login.php"><img id="user-icon" src="src/iconos/usuario_logo.png" alt="Inicio de sesión"></a>
    <?php else: ?>
        <a href="logout.php"><img id="logout-icon" src="src/iconos/salir_logo.png" alt="Cerrar sesión"></a>
    <?php endif; ?>
</div>
    </header>
        <section id="carrusel" class="carousel-section">
        <div class="carousel">
            <div class="carousel-item active">
                <img src="src/carrusel/fondo_1.jpg" alt="Imagen 1">
                <div class="carousel-description">
                    <h2>Todo en un solo lugar</h2>
                </div>
            </div>
            <div class="carousel-item">
                <img src="src/carrusel/fondo_2.jpg" alt="Imagen 2">
                <div class="carousel-description">
                    <h2>Calidad garantizada</h2>
                </div>
            </div>
            <div class="carousel-item">
                <img src="src/carrusel/fondo_3.jpg" alt="Imagen 3">
                <div class="carousel-description">
                    <h2>Innovación a tu alcance</h2>
                </div>
            </div>
            <button class="carousel-control prev" onclick="prevSlide()">&#10094;</button>
            <button class="carousel-control next" onclick="nextSlide()">&#10095;</button>
        </div>
        <section id="cards" class="cards-section">
    <h2>Nuestros Productos</h2>
    <div class="card-container">
        <div class="card">
            <img src="src/productos/apple_1.jpg" alt="Producto 1">
            <h3>Producto 1</h3>
            <p>Descripción del producto 1.</p>
            <p>Precio: $100.00</p>
            <form action="agregar_al_carrito.php" method="post">
                <input type="hidden" name="id_producto" value="1">
                <input type="submit" value="Añadir al carrito" class="btn-comprar">
            </form>
        </div>
        <div class="card">
            <img src="src/productos/apple_2.jpg" alt="Producto 2">
            <h3>Producto 2</h3>
            <p>Descripción del producto 2.</p>
            <p>Precio: $150.00</p>
            <form action="agregar_al_carrito.php" method="post">
                <input type="hidden" name="id_producto" value="2">
                <input type="submit" value="Añadir al carrito" class="btn-comprar">
            </form>
        </div>
        <div class="card">
            <img src="src/productos/apple_3.jpg" alt="Producto 3">
            <h3>Producto 3</h3>
            <p>Descripción del producto 3.</p>
            <p>Precio: $200.00</p>
            <form action="agregar_al_carrito.php" method="post">
                <input type="hidden" name="id_producto" value="3">
                <input type="submit" value="Añadir al carrito" class="btn-comprar">
            </form>
        </div>
    </div>
    <div class="card-container">
        <div class="card">
            <img src="src/productos/celular_1.jpg" alt="Producto 4">
            <h3>Producto 4</h3>
            <p>Descripción del producto 4.</p>
            <p>Precio: $250.00</p>
            <form action="agregar_al_carrito.php" method="post">
                <input type="hidden" name="id_producto" value="4">
                <input type="submit" value="Añadir al carrito" class="btn-comprar">
            </form>
        </div>
        <div class="card">
            <img src="src/productos/celular_2.jpg" alt="Producto 5">
            <h3>Producto 5</h3>
            <p>Descripción del producto 5.</p>
            <p>Precio: $300.00</p>
            <form action="agregar_al_carrito.php" method="post">
                <input type="hidden" name="id_producto" value="5">
                <input type="submit" value="Añadir al carrito" class="btn-comprar">
            </form>
        </div>
        <div class="card">
            <img src="src/productos/celular_3.jpg" alt="Producto 6">
            <h3>Producto 6</h3>
            <p>Descripción del producto 6.</p>
            <p>Precio: $350.00</p>
            <form action="agregar_al_carrito.php" method="post">
                <input type="hidden" name="id_producto" value="6">
                <input type="submit" value="Añadir al carrito" class="btn-comprar">
            </form>
        </div>
    </div>
</section>
<section id="ofertas" class="ofertas-section">
    <h2>Productos en Oferta</h2>
    <div class="ofertas-container">
        <div class="oferta">
            <img src="src/productos/laptop_4.jpg" alt="Producto en oferta 1">
            <h3>Oferta 1</h3>
            <p>Descripción de la oferta 1.</p>
            <p>Precio: $400.00</p>
            <form action="agregar_al_carrito.php" method="post">
                <input type="hidden" name="id_producto" value="7">
                <input type="submit" value="Añadir al carrito" class="btn-comprar">
            </form>
        </div>
        <div class="oferta">
            <img src="src/productos/laptop_2.jpg" alt="Producto en oferta 2">
            <h3>Oferta 2</h3>
            <p>Descripción de la oferta 2.</p>
            <p>Precio: $450.00</p>
            <form action="agregar_al_carrito.php" method="post">
                <input type="hidden" name="id_producto" value="8">
                <input type="submit" value="Añadir al carrito" class="btn-comprar">
            </form>
        </div>
        <div class="oferta">
            <img src="src/productos/laptop_3.jpg" alt="Producto en oferta 3">
            <h3>Oferta 3</h3>
            <p>Descripción de la oferta 3.</p>
            <p>Precio: $500.00</p>
            <form action="agregar_al_carrito.php" method="post">
                <input type="hidden" name="id_producto" value="9">
                <input type="submit" value="Añadir al carrito" class="btn-comprar">
            </form>
        </div>
    </div>
</section>
<section id="nuevos-productos" class="nuevos-section">
    <h2>Nuevos Productos</h2>
    <div class="nuevos-container">
        <div class="nuevo">
            <img src="src/productos/asistente_1.jpg" alt="Nuevo Producto 1" class="circular">
            <h3>Nuevo Producto 1</h3>
            <p>Descripción del nuevo producto 1.</p>
            <p>Precio: $550.00</p>
            <form action="agregar_al_carrito.php" method="post">
                <input type="hidden" name="id_producto" value="10">
                <input type="submit" value="Añadir al carrito" class="btn-comprar">
            </form>
        </div>
        <div class="nuevo">
            <img src="src/productos/asistente_2.jpg" alt="Nuevo Producto 2" class="circular">
            <h3>Nuevo Producto 2</h3>
            <p>Descripción del nuevo producto 2.</p>
            <p>Precio: $600.00</p>
            <form action="agregar_al_carrito.php" method="post">
                <input type="hidden" name="id_producto" value="11">
                <input type="submit" value="Añadir al carrito" class="btn-comprar">
            </form>
        </div>
        <div class="nuevo">
            <img src="src/productos/asistente_3.jpg" alt="Nuevo Producto 3" class="circular">
            <h3>Nuevo Producto 3</h3>
            <p>Descripción del nuevo producto 3.</p>
            <p>Precio: $700.00</p>
            <form action="agregar_al_carrito.php" method="post">
                <input type="hidden" name="id_producto" value="12">
                <input type="submit" value="Añadir al carrito" class="btn-comprar">
            </form>
        </div>
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
                    <br>Av. Direccion de la empresa 
                    <br>Ciudad de México, CDMX, 10000. <br>
                    <br>Correo-Electronico01@gmail.com
                </p>
            </div>
            <div class="box">
                <h2>Siguenos</h2>
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
    <script src="script.js"></script>
</body>
</html>