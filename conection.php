<?php

    $conection=pg_connect("host=localhost dbname=FOCUS user=postgres password=Mastergol10");

    if($conection == FALSE){
        echo 'Conexión fallida';
    }


?>