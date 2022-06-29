<?php

    //Se crea la sesion del usuario que entró con credenciales
    session_start();

    require 'conection.php';

    $id_contacto = $_GET['id'];

    $query = "DELETE FROM contacto WHERE id_contacto = '$id_contacto'";
    $consulta = pg_query($conection,$query);

    if ($consulta) 
    {
        header("Location: Contactos.php");
        
    }
    else
    {
        echo "<script>alert('Error al eliminar, inténtelo de nuevo'); window.location= 'Contactos.php'</script>";     
    }

?>