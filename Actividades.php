<?php
    require 'actividad_conexion.php';
    

    //Se crea la sesion del usuario que entró con credenciales
    session_start();

    //Esta condición permite que una vez cerrada la sesion ya no te 
    //permita ingresar a la pagina principal en caso de regresar
    if(!isset($_SESSION['id']))
    {
        header("Location: index.php ");
    }

    //Recuperamos la sesion iniciada por un usuario para consultar unicamente su información
    $id_user = $_SESSION['id'];
    //echo "Usuario: $id_user";
    $nombre = $_SESSION['nombre'];

    $query = "SELECT A.id_actividad, A.titulo, A.fecha_entrega, A.descripcion, A.hora, M.nombre_materia FROM actividad A INNER JOIN materia M ON M.id_materia = A.id_materia WHERE A.id_usuario = '$id_user'"; 
    //$query = "SELECT * FROM actividad WHERE id_usuario = '$id_user'";
    $consulta = pg_query($conection, $query);

    $query2 = "SELECT * FROM materia WHERE id_usuario = '$id_user'";
    $consulta2 = pg_query($conection, $query2);

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>FOCUS - Actividades</title>
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
                            <div class="sb-sidenav-menu-heading" style="color: white">MENÚ DE ACTIVIDADES</div>
                            <a class="nav-link collapsed" href="principal.php" style="color: white">
                                <div class="sb-nav-link-icon"><i class="fas fa-arrow-left" style="color: white"></i></div>
                                Regresar al inicio
                            </a>
                </nav>
            </div> 
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">ACTIVIDADES</h1>
                        <hr/>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Aquí se muestran tus actividades</li>
                         </ol>
                         <div class="container mt-5">
                    <div class="row"> 
                        
                        <div class="col-md-3">
                            <h1>Ingrese datos</h1>
                                <form action="actividad_insertar.php" method="POST">

                                    <input type="text" class="form-control mb-3" name="titulo" placeholder="Titulo" autocomplete="off">
                                    <input type="date" class="form-control mb-3" name="fecha_entrega" placeholder="dd/mm/aaaa" autocomplete="off">
                                    <input type="text" class="form-control mb-3" name="descripcion" placeholder="Descripción" autocomplete="off">
                                    <input type="time" class="form-control mb-3" name="hora" placeholder="00:00" autocomplete="off">
                                    
                                    <p> Seleccione una Materia: </p>
                                    <select name = "id_materia" class= "form-control mb-3" autocomplete="off">
                                        <?php 
                                            while($row = pg_fetch_array($consulta2))
                                            {
                                        ?>
                                            <option value = "<?php echo $row['id_materia']?>"> <?php echo $row['nombre_materia']?>    
                                        <?php
                                            }
                                        ?>
                                    </select>
                                    <div class="d-flex flex-column align-items-center justify-content-between mt-4 mb-0">
                                    <button type="submit" class="btn btn-primary" style="background-color: #003682;">Agregar</button>
                                        </div>
                                </form>
                        </div>

                        <div class="col-md-8">
                            <table class="table" >
                                <thead class="table-striped" style="background-color: #2f92cc;">
                                    <tr>
                                        <th style="color: white">TíTULO</th>
                                        <th style="color: white">FECHA DE ENTREGA</th>
                                        <th style="color: white">DESCRIPCIÓN</th>
                                        <th style="color: white">HORA</th>
                                        <th style="color: white">MATERIA</th>
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
                                                <th><?php  echo $row['titulo']?></th>
                                                <th><?php  echo $row['fecha_entrega']?></th>
                                                <th><?php  echo $row['descripcion']?></th>
                                                <th><?php  echo $row['hora']?></th>
                                                <th><?php  echo $row['nombre_materia']?></th>    
                                                <th><a href="actividad_actualizar.php?id=<?php echo $row['id_actividad'] ?>" class="btn btn-primary" style="background-color: #003682;">Editar </a></th>
                                                <th><a href="actividad_eliminar.php?id=<?php echo $row['id_actividad'] ?>" class="btn btn-danger">Eliminar</a></th>                                       
                                            </tr>
                                            
                                        <?php 
                                            }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-end justify-content-between small">
                            <div class="text-muted">Copyright &copy; FOCUS</div>
                            <p align="right"><img src=imagenes/logo.png width="68px" height="63px"></p>
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