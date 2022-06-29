<?php

    require 'conection.php';

    session_start();

    if(!isset($_SESSION['id'])){
        header("Location: index.php");
    }

    $user_id = $_SESSION['id'];

    $nombre = $_SESSION['nombre'];

    $query = "SELECT A.id_actividad, A.titulo, A.fecha_entrega, A.descripcion, M.nombre_materia FROM actividad A 
    INNER JOIN materia M ON M.id_materia = A.id_materia WHERE A.id_usuario = '$user_id'";
    $consulta = pg_query($conection, $query);

?>
<!DOCTYPE html>
<html lang = "es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>FOCUS - Horario</title>
        <link href="imagenes/Logo.png" rel="icon" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        
        <script src="js/jquery.min.js"></script>
        <script src="js/moment.min.js"></script>
        <!--CSS y Funciones del fullCalendar-->
        <link href="css/fullcalendar.min.css" rel="stylesheet" />
        <script src="js/fullcalendar.min.js"></script>
        <!--Archivo para cambiar el idioma al fullCalendar-->
        <script src="js/es.js"></script>

        <!--Para usar las funciones de bootstrap, se necesita declarar primero el archivo jquery-->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
        
        
    </head>
    <body>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color: #003682;">
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
                            <div class="sb-sidenav-menu-heading" style="color: white">Menú de Horario</div>
                            <a class="nav-link" href="principal.php" style="color: white">
                                <div class="sb-nav-link-icon"><i class="fas fa-arrow-left" style="color: white"></i></div>
                                Regresar al Inicio
                            </a>
                    </nav>
            </div> 
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Horario</h1>
                        <hr/>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Aquí se muestra tu horario</li>
                        </ol>
        <div class="container">
            <div class="row">
                <div class="col"></div>
                <div class="col-7"><div id="AgendaHorario"></div></div>
                <div class="col"></div>
            </div>
        </div>
        <script>
            //Se prepara la funcion mediante un jquery, se indica mediante el signo $ el jquery
            $(document).ready(function(){
                //Se enlaza el fullcalendar con nuestro ID AgendaHorario en el HTML
                $('#AgendaHorario').fullCalendar({
                    //Este nos permite editar la parte superior de nuestro calendario, agregando botones, modificando el titulo, etc
                    header:{
                        left:'today,prev,next,Miboton', //Contenido a la izquierda
                        center:'title', //Contenido en el centro
                        right:'month,basicWeek,basicDay, agendaWeek,agendaDay' //Contenido a la izquierda
                    },
                    //Custom Buttons permite agregar botones personalizados, en este caso pues creo que no es necesario, entonces se puede quitar
                    /*customButtons:{
                        Miboton:{
                            text: "Boton 1",
                            click:function(){
                                alert("Accion del Boton");
                            }
                        }
                    },*/
                    //Esta funcion lo que hace es identificar cuando se da un click en algun dia del calendario
                    dayClick:function(date,jsEvent,view){
                        //"alert" invoca una pequeña pestaña la cual muestra la inforamcion indicada entre los parentesis
                        //alert("Valor seleccionado: "+date.format());
                        //alert("Vista Actual "+view.name);
                        //Tomando esta fecha seleccionada, lo que se hace es dar diseño, dandole un color rojo al recuadro
                        //$(this).css('background-color','red');
                        //Despues se invoca un modal, ventana emergente. Tomando como referencia el ID exampleModal del HTML
                        $("#infoModal").modal("show");
                    },
                    /*Los eventos se manejan como un array junto con la palabra reservada: events. Dentro de este array se recorre la
                    consulta que se obtuvo de la base de datos sobre la tabla actividades*/       
                    events:[
                        <?php
                            while($row=pg_fetch_array($consulta))
                            {
                        ?>
                        //Se indican los parametros que contendrán estos eventos y con ayuda de un echo se muestran los datos obtenidos de la base de datos
                            {
                                id:"<?php echo $row['id_actividad']?>",
                                title:"<?php echo $row['titulo']?>",
                                start:"<?php echo $row['fecha_entrega']?>",
                                descripcion: "<?php echo $row['descripcion']?>",
                                materia:"<?php echo $row['nombre_materia']?>"
                                
                            },
                        <?php
                            }
                        ?>
                    ],
                    //Esta funcion permite identificar cuando se da un click en algun evento del calendario
                    eventClick:function(calEvent,jsEvent,view){
                        //Se hace referencia a ID's dentro del HTML. Se muestra el titulo del evento y descripcion dentro del modal
                        //Si quieres agregar algun otro valor, solo ocupas agregar el div ahi abajo en la parte del modal y solo pones calEvent.atributo que este en la parte de events
                        $('#tituloEvento').html(calEvent.title);
                        $('#descripcionEvento').html(calEvent.descripcion);
                        $('#materiaEvento').html(calEvent.materia);
                        $("#infoModal").modal("show");
                    }
                });
            });
        </script>
  
    <!-- Modal -->
        <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="tituloEvento"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="descripcionEvento"></div>
                        <div id="materiaEvento"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
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