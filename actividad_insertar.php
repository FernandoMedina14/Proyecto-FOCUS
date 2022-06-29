<?php

    //Se crea la sesion del usuario que entró con credenciales
    session_start();

    require 'actividad_conexion.php';
    require 'funcs.php';

    $errors = array();

    $titulo = pg_escape_string($_POST['titulo']);
    $fecha_entrega =$_POST['fecha_entrega'];
    $descripcion = pg_escape_string($_POST['descripcion']);
    $id_materia = pg_escape_string($_POST['id_materia']);
    $hora =$_POST['hora'];

    //Obtenemos nuevamente la sesion con la que se esta trabajando
    $id_user = $_SESSION['id'];
    $errores = 0;
    
    if(isNullAct($titulo, $fecha_entrega, $descripcion, $id_materia)){
        $errores+=1;
        //header("Location: Actividades.php");
        echo "<script>alert('Debe llenar todos los campos'); window.location= 'Actividades.php'</script>";
    }

    if(!materiaExiste($id_materia)) 
    {
        $errores+=1;
        echo "<script>alert('Esta materia no existe, ¿Deseas agregarla?'); window.location= 'Materia.php'</script>";     
    }
    
    if(!tamanoTitulo($titulo)){
        $errores+=1;
        echo "<script>alert('El Título es demasiado largo, solo se permiten máximo 60 caracteres'); window.location= 'Actividades.php'</script>";     
    }
    
    if(!tamanoDescripcion($descripcion)){
        $errores+=1;
        echo "<script>alert('La Descripción es demasiado larga, solo se permiten máximo 100 caracteres'); window.location= 'Actividades.php'</script>";     
    }
    //if(!validafecha($fecha_entrega)){
        //$errores+=1;
        //echo "<script>alert('La fecha no es válida'); window.location= 'Actividades.php'</script>";     
    //}


    if($errores == 0)
    {
        $query = "INSERT INTO actividad (titulo, fecha_entrega, descripcion, id_usuario, id_materia, hora) VALUES ('{$titulo}','{$fecha_entrega}','{$descripcion}','{$id_user}','{$id_materia}', '{$hora}')";
        $consulta = pg_query($conection, $query);

        if($consulta)
        {
            header("Location: Actividades.php");
        }
        else
        {
            echo "<script>alert('Error al insertar, interta de nuevo'); window.location= 'Actividades.php'</script>";
        }
    }

?>