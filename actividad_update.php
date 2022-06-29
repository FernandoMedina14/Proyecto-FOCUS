<?php

    //Se crea la sesion del usuario que entró con credenciales
    session_start();

    require 'actividad_conexion.php';
    require 'funcs.php';

    $id_actividad = pg_escape_string($_POST['id_actividad']);
    $titulo = pg_escape_string($_POST['titulo']);
    $fecha_entrega =$_POST['fecha_entrega'];
    $descripcion = pg_escape_string($_POST['descripcion']);
    $id_materia = pg_escape_string($_POST['id_materia']);
    $hora =$_POST['hora'];

    $errores = 0;

    if(isNullAct($titulo, $fecha_entrega, $descripcion, $id_materia)){
        $errores+=1; 
        echo "<script>alert('Debe llenar todos los campos'); window.location= 'actividad_actualizar.php?id=$id_actividad'</script>";
    }

    if(!materiaExiste($id_materia)){
        $errores+=1;
        echo "<script>alert('Esta materia no existe, ¿Deseas agregarla?'); window.location= 'Materia.php'</script>";     
    }

    if(!tamanoTitulo($titulo)){
        $errores+=1;
        echo "<script>alert('El Título es demasiado largo, solo se permiten máximo 60 caracteres'); window.location= 'actividad_actualizar.php?id=$id_actividad'</script>";     
    }

    if(!tamanoDescripcion($descripcion)){
        $errores+=1;
        echo "<script>alert('La Descripción es demasiado larga, solo se permiten máximo 100 caracteres'); window.location= 'actividad_actualizar.php?id=$id_actividad'</script>";     
    }
    
    /*if(!validafecha($fecha_entrega)){
        $errores+=1;
        echo "<script>alert('La fecha no es válida'); window.location= 'actividad_actualizar.php?id=$id_actividad'</script>";     
    }*/

    if($errores == 0)
    {
        $query = "UPDATE actividad SET titulo = '{$titulo}', fecha_entrega = '{$fecha_entrega}', descripcion = '{$descripcion}', id_materia = '{$id_materia}', hora = '{$hora}' WHERE id_actividad = '{$id_actividad}'";
        $consulta = pg_query($conection, $query);

        if($consulta)
        {
            header("Location: Actividades.php");
        }else
        {
            echo "<script>alert('Error al actualizar, interta de nuevo'); window.location= 'Actividades.php'</script>";
        }
    }

?>