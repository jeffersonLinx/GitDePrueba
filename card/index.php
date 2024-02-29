



<?php require_once "config/conexion.php"; ?>
 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Carrito de Compras</title>

    <link rel="apple-touch-icon" sizes="180x180" href="img/logotipo.jpg">
    <link rel="icon" type="image/png" sizes="32x32" href="img/logotipo.jpg">
    <link rel="icon" type="image/png" sizes="16x16" href="img/logotipo.jpg">
    <link rel="manifest" href="img/logotipo.jpg">
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" /> -->
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="assets/css/styles.css" rel="stylesheet" />
    <link href="assets/css/estilos.css" rel="stylesheet" />
</head>

<body>



    
<a href="#" class="btn-flotante" id="btnCarrito">Carrito <span class="badge bg-success" id="carrito">0</span></a>
    <!-- Navigation-->
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
            <img src="assets/img/logotipo.jpg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                <a class="navbar-brand" href="#">MUEBLES INTI</a>
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li><a href="home.html" class="nav-link px-2 text-secondary">Home</a></li>     
            </ul>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <a href="#" class="nav-link text-info" category="all">Todo</a>
                        <?php
                        $query = mysqli_query($conexion, "SELECT * FROM categorias");
                        while ($data = mysqli_fetch_assoc($query)) { ?>
                            <a href="#" class="nav-link" category="<?php echo $data['categoria']; ?>"><?php echo $data['categoria']; ?></a>
                        <?php } ?>
                    </ul>
                
                </div>
                <!-- Inicio del filtro-->
                <form id="formFiltrar" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                     <input id="inputFiltrar" type="search" class="form-control form-control-dark text-bg-dark" placeholder="Filtrar..." aria-label="Search">
                        </form>
                <!-- Fin del filtro-->
                <!-- Inicio para hacer login-->
            <div class="text-end">
                <a href="login.php" class="btn btn-info">Login</a>
                <a href="reguistrologin.php" class="btn btn-warning">Sign-up</a>
                </div>
                <!-- Fin para hacer login-->


            </div>
        </nav>
    </div>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">INTI</h1>
                <p class="lead fw-normal text-white-50 mb-0"> PRODUCTOS DE CALIDAD A TU CASA</p>
            </div>
        </div>
    </header>
    <section class=" py-5">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                $query = mysqli_query($conexion, "SELECT p.*, c.id AS id_cat, c.categoria FROM productos p INNER JOIN categorias c ON c.id = p.id_categoria");
                $result = mysqli_num_rows($query);
                if ($result > 0) {
                    while ($data = mysqli_fetch_assoc($query)) { ?>
                        <div class="col mb-5 productos" category="<?php echo $data['categoria']; ?>">
                            <div class="card h-100">
                                <!-- Sale badge-->
                                <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem"><?php echo ($data['precio_normal'] > $data['precio_rebajado']) ? 'Oferton' : ''; ?></div>
                                
                                <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem"><?php echo ($data['precio_normal'] < $data['precio_rebajado']) ? 'paga 3 lleva 2' : ''; ?></div>
                                <!-- Product image-->
                                <img class="card-img-top" src="assets/img/<?php echo $data['imagen']; ?>" alt="..." />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"><?php echo $data['nombre'] ?></h5>
                                        <p><?php echo $data['descripcion']; ?></p>
                                        <!-- Product reviews-->
                                        <div class="d-flex justify-content-center small text-warning mb-2">
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                        </div>
                                        <!-- Product price-->
                                        <span class="text-muted text-decoration-line-through"><?php echo $data['precio_normal'] ?></span>
                                        <?php echo $data['precio_rebajado'] ?>
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto agregar" data-id="<?php echo $data['id']; ?>" href="#">Agregar</a></div>
                                </div>
                            </div>
                        </div>
                <?php  }
                } ?>

            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">TODO LO MEJOR PARA NUESTRO CLIENTE</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/scripts.js"></script>



    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/scripts.js"></script>

<script>
    $(document).ready(function () {
        // Obtener todos los elementos de la tarjeta al cargar la página
        var productos = $(".productos");

        // Manejar el evento de cambio en el campo de búsqueda
        $("#inputFiltrar").on("input", function () {
            var filtro = $(this).val().toLowerCase(); // Obtener el valor del campo de búsqueda en minúsculas

            // Filtrar los elementos de la tarjeta según el nombre ingresado
            productos.each(function () {
                var nombreProducto = $(this).find(".fw-bolder").text().toLowerCase();
                if (nombreProducto.includes(filtro)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>

</body>

</html>