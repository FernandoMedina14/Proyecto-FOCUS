<?php

    require 'conection.php';
    require 'funcs.php';

    $query = "SELECT * FROM actividad NATURAL JOIN usuario";
    $consulta = pg_query($conection, $query);

    $fecha = date("Y-m-d H:i:s");
    echo "$fecha";

    while ($row = pg_fetch_array($consulta)) 
    {
        $fecha_ent = $row['fecha_entrega'];
        $hora_ent = $row['hora'];
        $email = $row['email_usuario'];
        $titulo = $row['titulo'];

        $datos = calcularfecha($fecha, $fecha_ent.$hora_ent);

        if($datos[0] == 0 && $datos[1] == 0 && $datos[2]==0 && $datos[3] == 23 && $datos[4] == 59 && $datos[5] >= 0)
        {
            echo "Años:",$datos[0];
            echo "Meses:",$datos[1];
            echo "Dias:",$datos[2];
            echo "Horas:",$datos[3];
            echo "Minutos:",$datos[4];
            echo "Segundos:",$datos[5];

            $user_id = getValor('id_usuario', 'email_usuario', $email);
            $user_nombre = getValor('nombre_usuario', 'email_usuario', $email);
            
            $asunto = "Recordatorio de Actividad - FOCUS";
            $cuerpo = "Hola $user_nombre: <br /><br />Tienes la actividad -$titulo- que vencerá el $fecha_ent a la(s) $hora_ent <br/><br/>";
            enviarEmail($email, $user_nombre, $asunto, $cuerpo);
        }
    }
?>
