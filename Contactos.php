<?php
    require 'conection.php';

    session_start();

    if(!isset($_SESSION['id'])){
        header("Location: index.php");
    }

    $nombre = $_SESSION['nombre'];

    $id_user = $_SESSION['id'];

    $nombre = $_SESSION['nombre'];

    $query = "SELECT * FROM contacto WHERE id_usuario = '{$id_user}'";
    $consulta = pg_query($conection, $query);
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>FOCUS - Contactos</title>
        <link href="imagenes/Logo.png" rel="icon" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark " style="background-color: #003682;" >
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="principal.php">FOCUS</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars" style="color: white"></i></button>
            <!-- Navbar-->
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
                            <div class="sb-sidenav-menu-heading" style="color: white">Menú de Contactos</div>
                            <a class="nav-link" href="principal.php" style="color: white">
                                <div class="sb-nav-link-icon"><i class="fas fa-arrow-left" style="color: white"></i></div>
                                Regresar al Inicio
                            </a>
                    </nav>
            </div> 
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Contactos</h1>
                        <hr/>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Estos son tus contactos</li>
                        </ol> 
                        <div class="container mt-5">
                    <div class="row"> 
                    <!--Se agrego este-->
                    <form action = "contacto_buscar.php" method="GET" class="form_search" autocomplete="off">
                        <input type="text" name= "busqueda" id="busqueda" placeholder="Buscar">
                        <button type="submit" class="btn btn-primary" style="background-color: #003682">Buscar</button>                    
                    </form>
                        <div class="col-md-3">
                            <h1>Ingrese datos</h1>
                                <form action="contacto_insertar.php" method="POST">

                                    <input type="text" class="form-control mb-3" name="nombre_contacto" placeholder="Nombre del Contacto" autocomplete = "off">
                                    <p>Seleccione una Etiqueta:</p>
                                    <select name= "etiqueta" class="form-control mb-3">
                                        <option value = "Estudiante">Estudiante</option>
                                        <option value = "Docente">Docente</option>
                                    </select>
                                    <input type="text" class="form-control mb-3" name="telefono_contacto" placeholder="Teléfono" autocomplete = "off">
                                    <input type="email" class="form-control mb-3" name="email_contacto" placeholder="Correo" autocomplete = "off">
                                    
                                    <div class="d-flex flex-column align-items-center justify-content-between mt-4 mb-0">
                                    <button type="submit" class="btn btn-primary" style="background-color: #003682;">Agregar</button>
                                    </div>
                                </form>
                        </div>

                        <div class="col-md-8">
                            <table class="table">
                                <thead class="table-striped" style="background-color: #2f92cc;">
                                    <tr>
                                        <th style="color: white">NOMBRE DE CONTACTO</th>
                                        <th style="color: white">ETIQUETA</th>
                                        <th style="color: white">TELÉFONO</th>
                                        <th style="color: white">EMAIL</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php
                                            while($row=pg_fetch_array($consulta))
                                            {
                                        ?>
                                            <tr>
                                                <th><?php  echo $row['nombre_contacto']?></th>
                                                <th><?php  echo $row['etiqueta']?></th>
                                                <th><?php  echo $row['telefono_contacto']?></th>
                                                <th><?php  echo $row['email_contacto']?></th>   
                                                <th><a href="contacto_actualizar.php?id=<?php echo $row['id_contacto'] ?>" class="btn btn-primary" style="background-color: #003682;">Editar</a></th>
                                                <th><a href="contacto_eliminar.php?id=<?php echo $row['id_contacto'] ?>" class="btn btn-danger">Eliminar</a></th>  
                                                           
                                            </tr>
                                        <?php 
                                            }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>  
            </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-end justify-content-between small">
                            <div class="text-muted">Copyright &copy; FOCUS</div>
                            <p align="right"><img src=imagenes/Logo.png width="68px" height="63px"></p>
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
