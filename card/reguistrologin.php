<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <!--avajo enlace para framework boostrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<!--arriba enlace para framework boostrap-->
</head>
<body class="bg-light">
      
      
<?php
require_once "config/conexion.php"; // Asegúrate de proporcionar la ruta correcta al archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesar y validar los datos del formulario
    $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $clave = mysqli_real_escape_string($conexion, $_POST['clave']);

    $Apellido = mysqli_real_escape_string($conexion, $_POST['apellido']);
    $Email = mysqli_real_escape_string($conexion, $_POST['email']);

    // Encriptar la contraseña
    $hashedPassword = password_hash($clave, PASSWORD_DEFAULT);

    // Insertar el usuario en la base de datos
    $insertQuery = "INSERT INTO usuarios (usuario, nombre, clave, apellido, email) VALUES ('$usuario', '$nombre', '$hashedPassword','$Apellido', '$Email' )";
    $result = mysqli_query($conexion, $insertQuery);

    if ($result) {
        // Registro exitoso, redirigir a index.php
        header("Location: index.php");
        exit();
    } else {
        // Error al insertar en la base de datos, puedes manejar el error de la manera que prefieras
        echo "Error al registrar el usuario: " . mysqli_error($conexion);
    }
}
?>
    <section class="vh-100" style="background-color: #9A616D;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
              <div class="card" style="border-radius: 1rem;">
                <div class="row g-0">
                  <div class="col-md-6 col-lg-5 d-none d-md-block">
                    <img src="img\people-logo-design-template-account-user-vector-4543270.jpg"
                      alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                  </div>
                  <div class="col-md-6 col-lg-7 d-flex align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">
      
                    <form method="post" action="">
                    <div class="d-flex align-items-center mb-3 pb-1">
                          <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                          <span class="h1 fw-bold mb-0">Iniciar secion</span>
                        </div>
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Nombre de usuario:</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre completo:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="clave" class="form-label">Contraseña:</label>
                                <input type="password" class="form-control" id="clave" name="clave" required>
                            </div>

                            <div class="mb-3">
                                <label for="Apellido" class="form-label">Apellido:</label>
                                <input type="text" class="form-control" id="Apellido" name="Apellido" required>
                            </div>
                            <div class="mb-3">
                                <label for="Email" class="form-label">Email:</label>
                                <input type="text" class="form-control" id="Email" name="Email" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Registrarse</button> <br>
                            
                        <a href="#!" class="small text-muted">Terminos de uso.</a>
                        <a href="#!" class="small text-muted">politicas de privacidad/a>
                        </form>
      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>


