<?php   
     //Se crea la sesion del usuario que entró con credenciales
     session_start();

     require 'conection.php';
     
 
     $id_materia = $_GET['id'];

     $nombre = $_SESSION['nombre'];
 
     $query = "SELECT id_materia, clave_materia, nombre_materia, seccion, aula, detalles, nombre_profesor FROM materia WHERE id_materia = '$id_materia'";
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
        <title>FOCUS - Modifica tu Materia</title>
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
                            <div class="sb-sidenav-menu-heading" style="color: white">MODIFICAR MATERIA</div>
                            <a class="nav-link collapsed" style="color: white" href="Actividades.php" >
                                <div class="sb-nav-link-icon"><i class="fas fa-arrow-left" style="color: white"></i></div>
                                Regresar a Materias
                            </a>
                </nav>
            </div> 
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">MODIFICA TU MATERIA</h1>
                        <hr/>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Materia a modificar</li>
                         </ol>
                         <div class="container mt-5">
                    <form action="materia_update.php" method="POST">

                                <input type="hidden" name="id_materia" value="<?php echo $row['id_materia']?>">

                                <input type="text" class="form-control mb-3" name="clave_materia" placeholder="Clave de la materia" value="<?php echo $row['clave_materia']  ?>" autocomplete = "off">
                                <input type="text" class="form-control mb-3" name="nombre_materia" placeholder="Nombre de la materia" value="<?php echo $row['nombre_materia']  ?>" autocomplete = "off">
                                <input type="text" class="form-control mb-3" name="seccion" placeholder="Sección" value="<?php echo $row['seccion']  ?>" autocomplete = "off">
                                <input type="text" class="form-control mb-3" name="aula" placeholder="ID de la materia" value="<?php echo $row['aula']  ?>" autocomplete = "off">
                                <input type="text" class="form-control mb-3" name="detalles" placeholder="Detalles" value="<?php echo $row['detalles']  ?>" autocomplete = "off">
                                <input type="text" class="form-control mb-3" name="nombre_profesor" placeholder="Nombre del profesor" value="<?php echo $row['nombre_profesor']  ?>" autocomplete = "off">
                                
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