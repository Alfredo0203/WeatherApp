<?php
function conectar(){
    $MYSQLHOST = 'viaduct.proxy.rlwy.net';
    $MYSQLUSER =  'root';
    $MYSQLPASSWORD =  'dcHDd1c-f3546e-HC2AB3Abgf4A3fd-5';
    $MYSQL_DATABASE =  'railway';
    $MYSQLPORT = '25154';

    // Crear una conexión con la base de datos
   $con = mysqli_connect($MYSQLHOST,"$MYSQLUSER, $MYSQLPASSWORD, $MYSQL_DATABASE, $MYSQLPORT);

    // Verificar si hubo errores en la conexión
    if (mysqli_connect_errno()) {
        
        exit();
    }
    
    // Devolver la conexión establecida
    return $con;
}
?>

  

