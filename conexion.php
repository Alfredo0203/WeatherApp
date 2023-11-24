<?php

function conectar(){
    $servidor = "viaduct.proxy.rlwy.net";
    $usuario = "root";
    $password = "dcHDd1c-f3546e-HC2AB3Abgf4A3fd-5";
    $base_datos = "railway";
    
    // Crear una conexión con la base de datos
    $con = mysqli_connect($servidor, $usuario, $password, $base_datos);
    
    // Verificar si hubo errores en la conexión
    if (mysqli_connect_errno()) {
        echo "Error de conexión a la base de datos: " . mysqli_connect_error();
        exit();
    }
    
    // Devolver la conexión establecida
    return $con;
}
?>

  

