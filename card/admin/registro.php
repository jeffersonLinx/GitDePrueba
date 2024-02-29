<?php
// Verificación y procesamiento del formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validación y procesamiento de los datos del formulario
    $usuario = $_POST["usuario"];
    $nombre = $_POST["nombre"];
    $clave = $_POST["clave"];

    // Encriptar la contraseña utilizando MD5
    $clave_encriptada = md5($clave);

    // Insertar datos en la base de datos
    $servername = "localhost"; // Cambia esto con tu nombre de servidor
    $username = "root"; // Cambia esto con tu nombre de usuario de la base de datos
    $password = ""; // Cambia esto con tu contraseña de la base de datos
    $dbname = "card";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta para insertar datos en la tabla "usuarios"
    $sql = "INSERT INTO adm (usuario, nombre, clave) VALUES ('$usuario', '$nombre', '$clave_encriptada')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso. El nuevo usuario ha sido agregado.";
        // Redirigir a productos.php después de un registro exitoso
        header('Location: productos.php');
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/sb-admin-2.min.css">
    <link rel="shortcut icon" href="../assets/img/favicon.ico">
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <img class="img-thumbnail" src="assets/img/logo.png" alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Registro de Usuario</h1>
                                    </div>
                                    <form class="user" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete="off">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="usuario" name="usuario" placeholder="Usuario..." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="nombre" name="nombre" placeholder="Nombre..." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="clave" name="clave" placeholder="Contraseña..." required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Registrar
                                        </button>
                                        <hr>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/js/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>
</body>

</html>
