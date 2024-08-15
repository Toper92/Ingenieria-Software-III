<?php 
session_start();
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/css/bootstrap-slider.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/bootstrap-slider.min.js"></script>
    
    
    <!-- Customized Bootstrap Stylesheet -->
    <script src="js/search.js"></script> 
    <link href="css/style.css" rel="stylesheet"> 
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
        <?php
        include 'class/Product.php';
        $product = new Product();	
        ?>	
        <div class="row">
        <div class="col-md-3">                    
            <div class="list-group">
                <h3>Precio</h3>	
                <div class="list-group-item">
                    <input id="priceSlider" data-slider-id='ex1Slider' type="text" data-slider-min="1000" data-slider-max="5000" data-slider-step="1" data-slider-value="14"/>
                    <div class="priceRange">1000 - 5000</div>
                    <input type="hidden" id="minPrice" value="0" />
                    <input type="hidden" id="maxPrice" value="5000" />                  
                </div>			
            </div>    
            <div class="list-group">
                <h3>Alimentos</h3>
                <div class="brandSection">
                    <?php
                    $brand = $product->getBrand();
                    foreach($brand as $brandDetails){	
                    ?>
                    <div class="list-group-item checkbox">
                    <label><input type="checkbox" class="productDetail brand" value="<?php echo $brandDetails["brand"]; ?>"  > <?php echo $brandDetails["brand"]; ?></label>
                    </div>
                    <?php }	?>
                </div>
            </div>
            <!-- <div class="list-group">
                <h3>Medicamentos</h3>
                <?php			
                $ram = $product->getRam();
                foreach($ram as $ramDetails){	
                ?>
                <div class="list-group-item checkbox">
                <label><input type="checkbox" class="productDetail ram" value="<?php echo $ramDetails['ram']; ?>" > <?php echo $ramDetails['ram']; ?></label>
                </div>
                <?php    
                }
                ?>
            </div>             -->
        </div>
        <div class="col-md-9">
        <br />
            <div class="row searchResult">
            </div>
        </div>
        </div>	
    </div>	  

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- Template Javascript -->
   
    <script src="js/main.js"></script>
</body>

</html>