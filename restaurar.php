<?php 

    require 'conection.php';
    require 'funcs.php';

    if(empty($_GET['user_id'])){
        header("Location: index.php");
    }

    $user_id = pg_escape_string($_GET['user_id']);
 
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>FOCUS - Restauración de contraseña</title>
        <link href="imagenes/Logo.png" rel="icon" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="" style="background-color: #003682;">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Restaurar Contraseña</h3></div>
                                    <div class="card-body">
                                        <form method="POST" action="guarda_cont.php" autocompete="off">
                                        <input type = "hidden" id="user_id" name = "user_id" value = "<?php echo $user_id; ?>" />
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputContrasena" name="contrasena" type="password" requeried/>
                                                <label for="inputContrasena">Nueva contraseña</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputContrasena_confirm" name="contrasena_confirm" type="password" requeried/>
                                                <label for="inputContrasena_confirm">Confrimar contraseña</label>
                                            </div>
                                            <div class="d-flex flex-column align-items-around justify-content-between mt-4 mb-0">
                                                <button type = "submit" class="btn btn-success" >Restaurar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-end justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a align="right"><img src=imagenes/Logo.png width="68px" height="63px"></a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>