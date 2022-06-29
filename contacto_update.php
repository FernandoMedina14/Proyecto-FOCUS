<?php

    //Se crea la sesion del usuario que entró con credenciales
    session_start();

    require 'conection.php';
    require 'funcs.php';

    $id_contacto = pg_escape_string($_POST['id_contacto']);
    $nombre_contacto = pg_escape_string($_POST['nombre_contacto']);
    $etiqueta = pg_escape_string($_POST['etiqueta']);
    $telefono_contacto = pg_escape_string($_POST['telefono_contacto']);
    $email_contacto = pg_escape_string($_POST['email_contacto']);

    $contador = 0;

    if (!isTelefono($telefono_contacto)) 
    {
        $contador+=1;
        echo "<script>alert('El número $telefono_contacto no se reconoce como número teléfonico válido'); window.location= 'contacto_actualizar.php'</script>";     
    }
    if (!isEmail($email_contacto)) 
    {
        $contador+=1;
        echo "<script>alert('Dirección de correo inválida'); window.location= 'contacto_actualizar.php?id=$id_contacto'</script>";     
    }
    if (isNullContactos($nombre_contacto, $etiqueta, $telefono_contacto, $email_contacto)) 
    {
        $contador+=1;
        echo "<script>alert('Debe llenar todos los campos'); window.location= 'contacto_actualizar.php?id=$id_contacto'</script>";     
    }
    if (!tamanoNombreContacto($nombre_contacto)) 
    {
        $contador+=1;
        echo "<script>alert('Sobrepaso el tamaño del nombre del contacto'); window.location= 'contacto_actualizar.php?id=$id_contacto'</script>";     
    }
    if (!tamanoEmail($email_contacto)) 
    {
        $contador+=1;
        echo "<script>alert('Sobrepaso el tamaño del correo eléctronico'); window.location= 'contacto_actualizar.php?id=$id_contacto'</script>";     
    }

    if($contador == 0)
    {
        $query = "UPDATE contacto SET nombre_contacto = '{$nombre_contacto}', etiqueta = '{$etiqueta}', telefono_contacto = '{$telefono_contacto}', email_contacto = '{$email_contacto}' WHERE id_contacto = '{$id_contacto}'";
        $consulta = pg_query($conection, $query);

        if ($consulta) 
        {
            header("Location: contactos.php");
        }
        else
        {
            echo "<script>alert('Error al actualizar el contacto, inténtelo de nuevo'); window.location= 'contacto_actualizar.php'</script>";     
        }

    }

?>