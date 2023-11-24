<?php

function conectar(){
    $MYSQLHOST = "viaduct.proxy.rlwy.net";
    $MYSQLUSER = "root";
    $MYSQLPASSWORD = "dcHDd1c-f3546e-HC2AB3Abgf4A3fd-5";
    $MYSQLDATABASE = "railway";
    
    // Crear una conexión con la base de datos
    $con = mysqli_connect($MYSQLHOST, $MYSQLUSER, $MYSQLPASSWORD, $MYSQLDATABASE);
    
    // Verificar si hubo errores en la conexión
    if (mysqli_connect_errno()) {
        echo "Error de conexión a la base de datos: " . mysqli_connect_error();
        exit();
    }
    
    // Devolver la conexión establecida
    return $con;
}
?>

  

