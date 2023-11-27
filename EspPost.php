<?php

include'conexion.php'; //inclusion de archivo conxeion

/* Verificacion de recepcion de todos los datos */
$con = conectar();
echo "Solicitud recibida desde: " . $_SERVER['REMOTE_ADDR'] . "\n";
 $headers = getallheaders();
    echo "Encabezado de la solicitud POST:<br>";
    foreach ($headers as $key => $value) {
        echo "$key: $value<br>";
    }
if ($con) {
print_r($_SERVER);
    echo "Conexion con base de datos exitosa! ";
    var_dump($_POST);
    if(isset($_POST['velocidad'])) {
        $velocidad = $_POST['velocidad'];
        echo "Estación meteorológica";
        echo " Velocidad : ".$velocidad;
    }

    if(isset($_POST['angulo'])) {
        $angulo = $_POST['angulo'];
        echo " angulo : ".$angulo;
    }   

    if(isset($_POST['direc'])) {
        $direc = $_POST['direc'];
        echo " direc : ".$direc;
    }   

    if(isset($_POST['temperatura'])) {
        $temperatura = $_POST['temperatura'];
        echo " temperatura : ".$temperatura;
    }    
    
    if(isset($_POST['humedad'])) { 
        $humedad = $_POST['humedad'];
        echo " humedad : ".$humedad;
    }    
    
    if(isset($_POST['indiceUV'])) {
        $indiceUV = $_POST['indiceUV'];
        echo " indiceUV : ".$indiceUV;
    } 
    if(isset($_POST['riesgo'])) { 
        $riesgo = $_POST['riesgo'];
        echo " riesgo : ".$riesgo;

    /* Programa de envio de datos a bd */    
        $consulta = "INSERT INTO datos(id, fecha, velocidad, angulo, direc, temperatura, humedad, indiceUV, riesgo) VALUES (NULL, current_timestamp(), '$velocidad', '$angulo', '$direc','$temperatura','$humedad', '$indiceUV', '$riesgo')";
       // $consulta = "UPDATE DHT11 SET Temperatura='$temperatura',Humedad='$humedad' WHERE Id = 1";
        $resultado = mysqli_query($con, $consulta);
        if ($resultado){
            echo " Registo en base de datos OK! ";
        } else {
            echo " Falla! Registro BD";
        }
    }
    
    
} else {
    echo "Falla! conexion con Base de datos ";   
}


