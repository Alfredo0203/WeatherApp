<?php

function conectar(){
    $servidor = "sql113.infinityfree.com";
    $usuario = "if0_34787197";
    $password = "kAJaz7t0JkUAR3";
    $base_datos = "if0_34787197_estacion1";
    
    // Crear una conexión con la base de datos
    $conn = mysqli_connect($servidor, $usuario, $password, $base_datos);
    
    // Verificar si hubo errores en la conexión
    if (mysqli_connect_errno()) {
        echo "Error de conexión a la base de datos: " . mysqli_connect_error();
        exit();
    }
    
    // Devolver la conexión establecida
    return $conn;
}
?>

  

