<?php
session_start();
require 'bd/conexion.php';

$sqlCatalogo = "SELECT * FROM catalogo";
$items = $conn->query($sqlCatalogo);

$dir = "img/posters/";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PetLover - Pet Care Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Flaticon Font -->
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/css/bootstrap-slider.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/bootstrap-slider.min.js"></script>
    <script src="js/search.js"></script>
    <link rel="stylesheet" href="css/style.css"> 
</head>

<body>

    <!-- Navbar Start -->
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
                <a href="carrito.php" class="nav-item nav-link">
                    <i class="fas fa-shopping-cart"></i> Carrito
                </a>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <!-- About Start -->
    <div class="container">
        <br>

        <?php if (isset($_SESSION['msg']) && isset($_SESSION['color'])) { ?>
            <div class="alert alert-<?= $_SESSION['color']; ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['msg']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            unset($_SESSION['color']);
            unset($_SESSION['msg']);
        } ?>

        <div class="row justify-content-end">
            <div class="col-auto">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoModal"><i class="fa-solid fa-circle-plus"></i> Nuevo emprendimiento</a>
            </div>
        </div>

        <br>

        <section class="container contenedor">
            <div class="row contenedor-items">
                <?php while ($row = $items->fetch_assoc()) { ?>
                <div class="card col item" style="width: 20rem;">
                    <img src="<?= $dir . $row['id'] . '.jpg?n=' . time(); ?>" class="card-img-top" alt="img">
                    <div class="card-body">
                        <h5 class="titulo-item"><?= $row['nombre']; ?></h5>
                        <p>Descripcion</p>
                        <p class="descripcion-item"><?= $row['descripcion']; ?></p>
                    </div>                    
                    <div class="card-body">
                        <form action="carrito.php" method="post">
                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                            <button type="submit" name="action" value="add" class="btn btn-sm btn-warning">
                                <i class="fa-solid fa-cart-plus"></i> Agregar al carrito
                            </button>
                        </form>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>
    </div>    

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>
