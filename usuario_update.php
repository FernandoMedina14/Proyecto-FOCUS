<?php

    //Se crea la sesion del usuario que entró con credenciales
    session_start();

    require 'conection.php';
    require "funcs.php";

    $id_usuario = pg_escape_string($_POST['id_usuario']);
    $nombre_completo = pg_escape_string($_POST['nombre_completo']);
    $nombre_usuario = pg_escape_string($_POST['nombre_usuario']);
    $telefono_usuario = pg_escape_string($_POST['telefono_usuario']);
    $email_usuario = pg_escape_string($_POST['email_usuario']);

    $errores = 0;

    if(isNullPerfil($nombre_completo, $nombre_usuario, $email_usuario, $telefono_usuario)){
        $errores+=1; 
        echo "<script>alert('Debe llenar todos los campos'); window.location= 'usuario_configuracion.php'</script>";
    }
    if(!isEmail($email_usuario)){
        $errores+=1; 
        echo "<script>alert('Dirección de correo inválida'); window.location= 'usuario_configuracion.php'</script>";
    }

    if(!isTelefono($telefono_usuario)){
        $errores+=1; 
        echo "<script>alert('Número de telefono inválido'); window.location= 'usuario_configuracion.php'</script>";
    }

    if(usuarioExisteConf($nombre_usuario, $id_usuario)){
        $errores+=1; 
        echo "<script>alert('El nombre de usuario $nombre_usuario ya está en uso'); window.location= 'usuario_configuracion.php'</script>";
    }

    if(emailExisteConf($email_usuario, $id_usuario)){
        $errores+=1; 
        echo "<script>alert('El correo $email_usuario ya esta en uso'); window.location= 'usuario_configuracion.php'</script>";
    }
    if(!tamanoNombreC($nombre_completo)){
        $errores+=1;
        echo "<script>alert('Nombre Completo demasiado largo, límite 60 caracteres'); window.location= 'usuario_configuracion.php'</script>";
    }
    if(!tamanoNombreU($nombre_usuario)){
        $errores+=1;
        echo "<script>alert('Nombre de usuario demasiado largo, límite 25 caracteres'); window.location= 'usuario_configuracion.php'</script>";
    }
    if(!tamanoEmail($email_usuario)){
        $errores+=1;
        echo "<script>alert('Correo Eléctronico demasiado largo, límite 60 caracteres'); window.location= 'usuario_configuracion.php'</script>";
    }

    if($errores == 0)
    {
        $query = "UPDATE usuario SET nombre_completo = '{$nombre_completo}', nombre_usuario = '{$nombre_usuario}', telefono_usuario = '{$telefono_usuario}', email_usuario = '{$email_usuario}' WHERE id_usuario = '{$id_usuario}'";
        $consulta = pg_query($conection, $query);

        if ($consulta) 
        {
            header("Location: usuario_configuracion.php");
        }
        else
        {
            echo "<script>alert('Error al actualizar, inténtalo de nuevo'); window.location= 'usuario_configuracion.php'</script>";
        }
          
    }

?>