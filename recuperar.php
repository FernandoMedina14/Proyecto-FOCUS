<?php

    require 'conection.php';
    require 'funcs.php';

    $errores = array();

    if(!empty($_POST)){
        $email = pg_escape_string($conection, $_POST['email']);

        if(!isEmail($email)){
            $errores[] = "Debe ingresar un correo electrónico válido";
        }
        else
        {
            if(emailExiste($email)){
                $user_id = getValor('id_usuario', 'email_usuario', $email);
                $user_nombre = getValor('nombre_usuario', 'email_usuario', $email);
                
                $url = 'http://'.$_SERVER["SERVER_NAME"].'/sistema/restaurar.php?user_id='.$user_id;
                
                $para = $email;
                $asunto = "Restablecer tu password - Sistema de Usuarios";
                $cuerpo = "Hola $user_nombre: <br /><br />Se ha solicitado un reinicio de contraseña. <br/><br/>Ingresa al siguiente link para restaurarla: 
                <a href= '$url'>Restaurala aquí!</a>";
                enviarEmail($email, $user_nombre, $asunto, $cuerpo);

                header("Location: index.php");
            }
            else{
                $errores[] = "El correo ingresado no esta registrado en la plataforma";
            }
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
        <title>FOCUS - Recuperar Contraseña</title>
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Recuperar Contraseña</h3></div>
                                    <div class="card-body">
                                        <div class="small mb-3 text-muted">Ingresa tu correo electrónico para recuperar tu contraseña.</div>
                                        <form method ="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"autocomplete="off">
                                            <div class="form-floating mb-3">
                                                <input name = "email" class="form-control" id="inputEmail" type="email" />
                                                <label for="inputEmail">Correo Electrónico</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="btn btn-secondary" href="index.php">Cancelar</a>
                                                <button class="btn btn-success" href="index.php">Enviar</button>
                                            </div>
                                        </form>
                                        <?php echo resultBlockRecupera($errores); ?>
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
