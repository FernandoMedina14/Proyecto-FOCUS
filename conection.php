<?php

    $conection=pg_connect("host=localhost dbname=FOCUS user=postgres");

    if($conection == FALSE){
        echo 'Conexión fallida';
    }


?>
