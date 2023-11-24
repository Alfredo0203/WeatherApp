<?php

function conectar(){
    $MYSQLHOST = $_ENV["MYSQLHOST"];
    $MYSQLUSER =  $_ENV["MYSQLUSER"];
    $MYSQLPASSWORD =  $_ENV["MYSQLPASSWORD"];
    $MYSQL_DATABASE =  $_ENV["MYSQL_DATABASE"];
    $MYSQLPORT = $_ENV["MYSQLPORT"];
    
    // Crear una conexión con la base de datos
   $con = mysqli_connect("$MYSQLHOST", "$MYSQLUSER", "$MYSQLPASSWORD", "$MYSQL_DATABASE", "$MYSQLPORT");
        // Verificar si hubo errores en la conexión
    if (mysqli_connect_errno()) {
        echo "Error de conexión a la base de datos: " . mysqli_connect_error();
        exit();
    }
    
    // Devolver la conexión establecida
    return $con;
}

?>

  

