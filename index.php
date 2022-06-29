<?php

    require "conection.php";
    require 'funcs.php';

    session_start();

    $errores = array();

    if($_POST){

        $usuario = $_POST['nombre_usuario'];
        $password = $_POST['contrasena'];

        $consulta = "SELECT id_usuario, nombre_completo, nombre_usuario, email_usuario, telefono_usuario, contrasena FROM usuario WHERE nombre_usuario = '$usuario'";
        $resultado = pg_query($conection, $consulta);

        $num = pg_num_rows($resultado);

        if($num > 0){
            $row = pg_fetch_assoc($resultado);
            $password_bd = $row['contrasena'];
            $valid_pass = password_verify($password, $password_bd);

            if($valid_pass){
                $_SESSION['id'] = $row['id_usuario'];
                $_SESSION['nombre'] = $row['nombre_completo'];

                header ("Location: principal.php");
            }
            else{
                $errores[] = "La contraseña no coincide con el usuario";
            }
        }
        else{
            $errores[] = "El usuario ingresado no existe";
        }
    }

?> 

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>FOCUS - Inicio de Sesión</title>
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Iniciar Sesión</h3></div>
                                    <div class="card-body">
                                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputUsuario" name="nombre_usuario" type="text" requiered/>
                                                <label for="inputUsuario">Nombre de Usuario</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputContrasena" name="contrasena" type="password" requiered/>
                                                <label for="inputContrasena">Contraseña</label>
                                            </div>
                                            <div class="d-flex flex-column align-items-around justify-content-between mt-4 mb-0">
                                                <button type = "submit" class="btn btn-primary" style="background-color: #003682;">Entrar</button>
                                            </div>
                                            <div class="d-flex flex-column align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="recuperar.php">¿Olvidaste tu contraseña?</a>
                                            </div>
                                        </form>
                                        <?php echo resultBlockInicioSesion($errores);?>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <a class="btn btn-success" href="register.php">Crear cuenta nueva</a>
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
                            <div class="text-muted">Copyright &copy; FOCUS 2022</div>
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
