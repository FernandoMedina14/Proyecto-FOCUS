<?php

    //Se crea la sesion del usuario que entró con credenciales
    session_start();

    require 'conection.php';

    $id_materia = $_GET['id'];

    //Hacemos una consulta para saber si una materia a eliminar se encuentra relacionada 
    //con una alguna actividad
    $validar = "SELECT * FROM actividad WHERE id_materia = '$id_materia'";
    $consulta2 = pg_query($conection,$validar);
    $num = pg_num_rows($consulta2);

    //Si es mayor a cero significa que si existe una o más actividades relacionadas con esta materia 
    if ($num > 0) 
    {
        echo "Primero debes de eliminar las actividades que deriven de la materia con el siguiente ID: '$id_materia'";
    }
    else
    {
        $query = "DELETE FROM materia WHERE id_materia = '$id_materia'";
        $consulta = pg_query($conection,$query);

        if ($consulta) 
        {
            header("Location: Materias.php");
            
        }
        else
        {
            echo "Error al eliminar ";
        }

    }

?>