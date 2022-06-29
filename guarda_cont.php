<?php

require 'conection.php';
require 'funcs.php';


$user_id = pg_escape_string($_POST['user_id']);
$contrasena = pg_escape_string($_POST['contrasena']);
$contrasena_confirm = pg_escape_string($_POST['contrasena_confirm']);
$errores = 0;

if(!tamanioContrasena($contrasena))
{
    $errores+=1;
    echo "<script>alert('La contraseña debe tener un mínimo de 8 caracteres'); window.location= 'usuario_configuracion.php'</script>";
}
if(!validaPassword($contrasena, $contrasena_confirm))
{
    $errores+=1;
    echo "<script>alert('Las contraseñas no coinciden'); window.location= 'usuario_configuracion.php'</script>";
}

if($errores == 0)
{
    $pass_hash = hashPassword($contrasena);

    if(cambiaPassword($pass_hash, $user_id)){
        //echo "Contraseña modificada con éxito";
        //echo "<br> <a href = 'index.php' > Iniciar Sesión <a/>";
        header ("Location: exitoContrasena.php");
    }
}
?>

