<?php

    //Se crea la sesion del usuario que entró con credenciales
    session_start();

    require 'conection.php';
    require 'funcs.php';

    $id_materia = pg_escape_string($_POST['id_materia']);
    $clave_materia = pg_escape_string($_POST['clave_materia']);
    $nombre_materia = pg_escape_string($_POST['nombre_materia']);
    $nombre_profesor = pg_escape_string($_POST['nombre_profesor']);
    $aula = pg_escape_string($_POST['aula']);
    $seccion = pg_escape_string($_POST['seccion']);
    $detalles = pg_escape_string($_POST['detalles']);

    $cont = 0;

    if(isNullMateria($clave_materia, $nombre_materia, $nombre_profesor, $aula, $seccion, $detalles))
    {
        $cont+=1;
        echo "<script>alert('Debe llenar todos los campos'); window.location= 'materia_actualizar.php?id=$id_materia'</script>";
    }
    if(!validaClaveMateria($clave_materia))
    {
        $cont+=1;
        echo "<script>alert('La clave de materia debe tener una I seguido de 4 números'); window.location= 'materia_actualizar.php?id=$id_materia'</script>";
    }
    if(!validaNombreMateria($nombre_materia))
    {
        $cont+=1;
        echo "<script>alert('Sobrepasó el tamaño de caracteres (50) en Nombre de la Materia'); window.location= 'materia_actualizar.php?id=$id_materia'</script>";
    }
    if(!validaNombreProfesor($nombre_profesor))
    {
        $cont+=1;
        echo "<script>alert('Sobrepasó el tamaño de caracteres (60) en el Nombre del Profesor'); window.location= 'materia_actualizar.php?id=$id_materia'</script>";
    }
    if(!validaDetalles($detalles))
    {
        $cont+=1;
        echo "<script>alert('Sobrepasó el tamaño de caracteres (150)  en Detalles'); window.location= 'materia_actualizar.php?id=$id_materia'</script>";
    }
    if(!validaAula($aula))
    {
        $cont+=1;
        echo "<script>alert('El aula debe comenzar por una letra seguido de máximo 2 números'); window.location= 'materia_actualizar.php?id=$id_materia'</script>";
    }
    if(!validaSeccion($seccion))
    {
        $cont+=1;
        echo "<script>alert('La sección debe comenzar por una letra seguido de 2 números'); window.location= 'materia_actualizar.php?id=$id_materia'</script>";
    }

    if ($cont == 0)
    {
        $query = "UPDATE materia SET clave_materia = '{$clave_materia}', nombre_materia = '{$nombre_materia}', nombre_profesor = '{$nombre_profesor}', aula = '{$aula}', seccion = '{$seccion}', detalles = '{$detalles}' WHERE id_materia = '{$id_materia}'";
        $consulta = pg_query($conection, $query);
        
        if ($consulta) 
        {
            header("Location: Materias.php");
        }
        else
        {
            echo "<script>alert('Error al actualizar, inténtelo de nuevo'); window.location= 'materia_actualizar.php'</script>";
        }
    }

?>