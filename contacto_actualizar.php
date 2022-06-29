<?php   
    //Se crea la sesion del usuario que entró con credenciales
    session_start();

    require 'conection.php';
    
    $nombre = $_SESSION['nombre'];

    $id_contacto = $_GET['id'];


    $query = "SELECT id_contacto, nombre_contacto, etiqueta, telefono_contacto, email_contacto FROM contacto WHERE id_contacto = '$id_contacto'";
    $consulta = pg_query($conection,$query);

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
        <title>FOCUS - Modifica tu Contacto</title>
        <link href="imagenes/logo.png" rel="icon"/>
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
                        <li><a class="dropdown-item" href="usuario_configuracion.php">Configuración de perfil</a></li>
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
                            <div class="sb-sidenav-menu-heading" style="color: white">MODIFICAR CONTACTO</div>
                            <a class="nav-link collapsed" style="color: white" href="Contactos.php" >
                                <div class="sb-nav-link-icon"><i class="fas fa-arrow-left" style="color: white"></i></div>
                                Regresar a Contactos
                            </a>
                </nav>
            </div> 
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">MODIFICA EL CONTACTO</h1>
                        <hr/>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Contacto a Modificar</li>
                         </ol>
                         <div class="container mt-5">
                    <form action="contacto_update.php" method="POST">

                                <input type="hidden" name="id_contacto" value="<?php echo $row['id_contacto']?>">

                                <input type="text" class="form-control mb-3" name="nombre_contacto" placeholder="Nombre del contacto" value="<?php echo $row['nombre_contacto']  ?>" autocomplete = "off">

                                <p>Seleccione una Etiqueta:</p>
                                    <select name= "etiqueta" class="form-control mb-3">
                                        <option value = "Estudiante" <?php echo $row['etiqueta']?>>Estudiante</option>
                                        <option value = "Docente" <?php echo $row['etiqueta']?>>Docente</option>
                                    </select>
                                <input type="text" class="form-control mb-3" name="telefono_contacto" placeholder="Teléfono del contacto" value="<?php echo $row['telefono_contacto']  ?>" autocomplete = "off">
                                <input type="text" class="form-control mb-3" name="email_contacto" placeholder="Email del contacto" value="<?php echo $row['email_contacto']  ?>" autocomplete = "off">
                                
                            <button type="submit" class="btn btn-primary" style="background-color: #003682">Actualizar</button>
                    </form>
                </div>
                <div>
                    </div>
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