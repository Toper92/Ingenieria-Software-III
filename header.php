<?php
session_start();

// Contar productos en el carrito
$numero_productos = isset($_SESSION['carrito']) ? array_sum($_SESSION['carrito']) : 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tu Tienda</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css">
    <style>
        /* Estilo para el ícono del carrito con número */
        .cart-icon {
            position: relative;
            display: inline-block;
        }

        .cart-icon .badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 8px;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-lg-5">
            <a href="" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 display-5 text-capitalize font-italic text-white"><span class="text-primary">Safety</span>First</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                    <a href="index.php" class="nav-item nav-link active">Inicio</a>
                    <a href="mascotas.php" class="nav-item nav-link">Mascotas</a>
                    <a href="productos.php" class="nav-item nav-link">Productos</a>
                    <a href="contactenos.php" class="nav-item nav-link">Contactenos</a>
                </div>
                <a href="carrito.php" class="nav-item nav-link cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                    <?php if ($numero_productos > 0): ?>
                        <span class="badge"><?php echo $numero_productos; ?></span>
                    <?php endif; ?>
                </a>
            </div>
        </nav>
    </div>
    <!-- Resto del contenido de tu página -->
</body>
</html>
