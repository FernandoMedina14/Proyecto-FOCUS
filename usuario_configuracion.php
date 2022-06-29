<?php

    require 'conection.php';

    //Se crea la sesion del usuario que entró con credenciales
    session_start();

    //Esta condición permite que una vez cerrada la sesion ya no te 
    //permita ingresar a la pagina principal en caso de regresar
    if(!isset($_SESSION['id']))
    {
        // . -> localhost o dominio
        // .. -> carpeta anterior -> Proyecto IS
        // Esto hace referencia a que si el usuario quiere entrar directo a actividades
        //primero necesita iniciar sesión
        header("Location: index.php");
    }

     //Recuperamos la sesion iniciada por un usuario para consultar unicamente su información
     $id_user = $_SESSION['id'];

     $nombre = $_SESSION['nombre'];

     $query = "SELECT * FROM usuario WHERE id_usuario = '$id_user'";
     $consulta = pg_query($conection, $query);

    //Nos permite obtener la informacion de toda la fila que se consulta
     $row = pg_fetch_array($consulta);

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>FOCUS - Configuración de perfil</title>
        <link href="imagenes/Logo.png" rel="icon" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color: #003682;" >
            <a class="navbar-brand ps-3" href="principal.php">FOCUS</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars" style="color: white"></i></button>
            <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white"><?php echo $nombre; ?><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Configuración de perfil</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Cerrar sesión</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" style="background-color: #003682;" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading" style="color: white">COFIGURAR PERFIL</div>
                            <a class="nav-link collapsed" style="color: white" href="principal.php" >
                                <div class="sb-nav-link-icon"><i class="fas fa-arrow-left" style="color: white"></i></div>
                                Regresar a Inicio
                            </a>
                </nav>
            </div> 
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h2 class="mt-4">CONFIGURA TU PERFIL</h2>
                        <hr/>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Tu información es la siguiente:</li>
                        </ol>
                        <div class="container rounded bg-white">
                        <div class="row">
                        <div class="border-right">
                        <div class="d-flex flex-column align-items-center text-center"><img class="rounded-circle" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                        <span class="font-weight-bold">USUARIO: <?php echo $row['nombre_usuario']; ?></span>
                        <span></span>
                        </div>
                        </div>
                        </div>
                        <!-- Aqui recuperamos la informacion de la consulta y la modificamos en tiempo real con base a la variable $row -->
                        <form action="usuario_update.php" method="POST">
                        <input type="hidden" name="id_usuario" value="<?php echo $row['id_usuario']?>">
                        <div class="row mt-4"> 
                            <div class="col-md-6"><label class="labels">Nombre Completo</label><input name = "nombre_completo" type="text" class="form-control mb-3" placeholder="Nombre completo" value="<?php echo $row['nombre_completo']; ?>"></div>
                            <div class="col-md-6"><label class="labels">Nombre de Usuario</label><input name = "nombre_usuario" type="text" class="form-control mb-3" value="<?php  echo $row['nombre_usuario']; ?>" placeholder="Nombre de usuario"></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12"><label class="labels">Número de Teléfono</label><input name = "telefono_usuario" type="text" class="form-control mb-3" placeholder="Teléfono" value="<?php echo $row['telefono_usuario']; ?>"></div>
                            <div class="col-md-12"><label class="labels">Correo electrónico</label><input name = "email_usuario" type="email" class="form-control mb-3" placeholder="Ingresa tu correo electrónico" value="<?php echo $row['email_usuario']; ?>"></div>           
                        </div>
                        <div class="mt-5 text-justify">                                      <!--Aqui te debe redirigir al link que te manda en el corre para restaurar la contraseña-->         
                            <a class="btn btn-primary profile-button" style="background-color: #003682;" type="button" href="restaurar.php?user_id=<?php echo $id_user?>">Cambiar contraseña</a> 
                            <input type="submit" class="btn btn-success btn-block" value="Guardar información">
                        </div>
                        </form>
                    </main>
                    <footer class="py-4 bg-light mt-auto">
                        <div class="container-fluid px-4">
                            <div class="d-flex align-items-end justify-content-between small">
                                <div class="text-muted">Copyright &copy; FOCUS Website 2022</div>
                                <p align="right"><img src=imagenes/logo.png width="68px" height="63px"></p>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            <script src="js/scripts.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
            <script src="assets/demo/chart-area-demo.js"></script>
            <script src="assets/demo/chart-bar-demo.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
            <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>