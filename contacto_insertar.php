<?php

    //Se crea la sesion del usuario que entró con credenciales
    session_start();

    require 'conection.php';
    require 'funcs.php';

    $nombre_contacto = pg_escape_string($_POST['nombre_contacto']);
    $etiqueta = pg_escape_string($_POST['etiqueta']);
    $telefono_contacto = pg_escape_string($_POST['telefono_contacto']);
    $email_contacto = pg_escape_string($_POST['email_contacto']);
    
    $id_user = $_SESSION['id'];
    $contador = 0;

    if (!isTelefono($telefono_contacto)) 
    {
        $contador+=1;
        echo "<script>alert('El número $telefono_contacto no se reconoce como número teléfonico válido'); window.location= 'Contactos.php'</script>";     
    }
    if (!isEmail($email_contacto)) 
    {
        $contador+=1;
        echo "<script>alert('Dirección de correo inválida'); window.location= 'Contactos.php'</script>";     
    }
    if (isNullContactos($nombre_contacto, $etiqueta, $telefono_contacto, $email_contacto)) 
    {
        $contador+=1;
        echo "<script>alert('Debe llenar todos los campos'); window.location= 'Contactos.php'</script>";     
    }
    if (!tamanoNombreContacto($nombre_contacto)) 
    {
        $contador+=1;
        echo "<script>alert('Sobrepaso el tamaño del nombre del contacto'); window.location= 'Contactos.php'</script>";     
    }
    if (!tamanoEmail($email_contacto)) 
    {
        $contador+=1;
        echo "<script>alert('Sobrepaso el tamaño del correo eléctronico'); window.location= 'Contactos.php'</script>";     
    }

    if($contador == 0)
    {
        $query = "INSERT INTO contacto (nombre_contacto, etiqueta, telefono_contacto, email_contacto, id_usuario) VALUES('{$nombre_contacto}', '{$etiqueta}', '{$telefono_contacto}', '{$email_contacto}','{$id_user}')";
        $consulta = pg_query($conection, $query);

        if ($consulta) 
        {
            header("Location: contactos.php");
        }
        else
        {
            echo "<script>alert('Error al insertar el contacto, inténtelo de nuevo'); window.location= 'Contactos.php'</script>";     
        }

    }


?>