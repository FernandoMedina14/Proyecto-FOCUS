<?php

    require 'conection.php';
    require 'funcs.php';

    //Sirve para colocar todos los errores
    $errors = array();

    //Verifica si captura los datos del formulario
    if(!empty($_POST))
    {
        //LCrea una cadena que se puede usar en una sentencia SQL
        $nombre_c = pg_escape_string($conection, $_POST['nombre']);
        $nombre_u = pg_escape_string($conection, $_POST['usuario']);
        $correo = pg_escape_string($conection, $_POST['correo']);
        $tel = pg_escape_string($conection, $_POST['telefono']);
        $contrasena = pg_escape_string($conection, $_POST['contrasena']);
        $confirmacion = pg_escape_string($conection, $_POST['confirm']);
        

        //Validaciones
        if (isNull($nombre_c, $nombre_u, $correo, $tel, $contrasena, $confirmacion)) 
        {
            $errors[] = "Debe llenar todos los campos";
        }
        if (!isEmail($correo)) 
        {
            $errors[] = "Dirección de correo inválida";
        }
        if(!validaPassword($contrasena, $confirmacion))
        {
            $errors[] = "Las contraseñas no coinciden";
        }
        if (usuarioExiste($nombre_u)) 
        {
            $errors[] = "El nombre de usuario $nombre_u ya existe";
        }
        if (emailExiste($correo)) 
        {
            $errors[] = "El correo electronico $correo ya existe";
        }
        if(!isTelefono($tel)){
            $errors[] = "El telefono ingresado $tel no es válido";
        }
        if(!tamanioContrasena($contrasena)){
            $errors[] = "La contraseña debe de ser mayor a 8 caracteres por seguridad";
        }
        if (!tamanoNombreC($nombre_c)) 
        {
            $errors[] = "El nombre es demasiado largo";
        }
        //Si no hay ningún error, procede a registrar al usuario
        if(count($errors) == 0)
        {
            $pass_hash = hashPassword($contrasena);
            $registro = registraUsuario($nombre_c, $nombre_u, $correo, $tel, $pass_hash);

            if ($registro == 0) 
            {
                $errors[] = "Error al registrar";   
         
            }
            else
            {
                //Una vez registrado, te reedirecciona a index.php
                header("Location: index.php");
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
        <title>Registro FOCUS</title>
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
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Registrarse</h3></div>
                                    <div class="card-body">

                                        <!--Toda la información sera enviada a a si misma con el action-->
                                        <!--Autocomplete nos ayuda a que no se autocompleten los campos con información guardada-->
                                        <form method ="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"autocomplete="off">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <!--name nos permite identificar lo escrito por el usuario-->
                                                        <input name = "nombre" class="form-control" id="inputFirstName" type="text"  autocomplete="off" autocomplete="off" required />
                                                        <label for="inputFirstName">Nombre completo</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input name = "usuario" class="form-control" id="inputLastName" type="text"  autocomplete="off" autocomplete="off" required />
                                                        <label for="inputLastName">Nombre de usuario</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputEmail" name="correo" type="email"  autocomplete="off" autocomplete="off" required/>
                                                        <label for="inputEmail">Correo Electrónico</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputTelefono" name="telefono" type="integer"  autocomplete="off" required/>
                                                        <label for="inputTelefono">Teléfono</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input name = "contrasena" class="form-control" id="inputPassword" type="password"  autocomplete="off" requiered/>
                                                        <label for="inputPassword">Contraseña</label>
                                                    </div>
                                                </div>
                                            <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input name= "confirm" class="form-control" id="inputPasswordConfirm" type="password"  autocomplete="off" requiered/>
                                                        <label for="inputPasswordConfirm">Confirma la contraseña</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-success btn-block" >Crear cuenta</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- Verifica los campos y muestra los posibles errores -->
                                        <?php echo resultBlock($errors); ?>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="index.php">¿Ya tienes cuenta? Inicia sesión</a></div>
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