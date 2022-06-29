<?php

    //Se crea la sesion del usuario que entró con credenciales
    session_start();

    require 'actividad_conexion.php';

    $id_actividad = $_GET['id'];

    $query = "DELETE FROM actividad WHERE id_actividad = '$id_actividad'";
    $consulta = pg_query($conection,$query);

    if ($consulta) 
    {
        header("Location: Actividades.php");
        
    }
    else
    {
        echo "Error al eliminar ";
    }

?>