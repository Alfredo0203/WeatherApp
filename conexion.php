<?php

function conectar(){
    $MYSQLHOST = $_ENV["MYSQLHOST"];
    $MYSQLUSER =  $_ENV["MYSQLUSER"];
    $MYSQLPASSWORD =  $_ENV["MYSQLPASSWORD"];
    $MYSQLDATABASE =  $_ENV["MYSQLDATABASE"];
    
    // Crear una conexión con la base de datos
    $con = mysqli_connect("$MYSQLHOST'", "$MYSQLUSER", "$MYSQLPASSWORD", "$MYSQLDATABASE");
    
    // Verificar si hubo errores en la conexión
    if (mysqli_connect_errno()) {
        echo "Error de conexión a la base de datos: " . mysqli_connect_error();
        exit();
    }
    
    // Devolver la conexión establecida
    return $con;
}
?>

  

