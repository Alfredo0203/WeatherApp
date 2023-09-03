<?php
include 'conexion.php'; // Inclusión de archivo conexión
$conexion = conectar();
/* Verificación de recepción de todos los datos */
if ($con) {
    echo "Conexión con base de datos exitosa!";
    
    if (isset($_POST['submit'])) {
        $velocidad = $_POST['velocidad'];
        $angulo = $_POST['angulo'];
        $direc = $_POST['direc'];
        $temperatura = $_POST['temperatura'];
        $humedad = $_POST['humedad'];
        $indiceUV = $_POST['indiceUV'];
        $riesgo = $_POST['riesgo'];

        /* Programa de envío de datos a la base de datos */    
        $consulta = "INSERT INTO datos(id, fecha, velocidad, angulo, direc, temperatura, humedad, indiceUV, riesgo) VALUES (NULL, current_timestamp(), '$velocidad', '$angulo', '$direc','$temperatura','$humedad', '$indiceUV', '$riesgo')";
        
        $resultado = mysqli_query($con, $consulta);
        if ($resultado) {
            echo "Registro en base de datos OK!";
        } else {
            echo "Falla! Registro BD";
        }
    }   
} else {
    echo "Falla! Conexión con Base de datos";   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Datos Meteorológicos</title>
    <!-- Agregado de CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
     <div class="container mt-5">
        <h2>Formulario de Datos Meteorológicos</h2>
        <form method="post">
            <div class="form-group">
                <label for="velocidad">Velocidad:</label>
                <input type="text" class="form-control" name="velocidad">
            </div>
            <div class="form-group">
                <label for="angulo">Ángulo:</label>
                <input type="text" class="form-control" name="angulo">
            </div>
            <div class="form-group">
                <label for="direc">Dirección:</label>
                <input type="text" class="form-control" name="direc">
            </div>
            <div class="form-group">
                <label for="temperatura">Temperatura:</label>
                <input type="text" class="form-control" name="temperatura">
            </div>
            <div class="form-group">
                <label for="humedad">Humedad:</label>
                <input type="text" class="form-control" name="humedad">
            </div>
            <div class="form-group">
                <label for="indiceUV">Índice UV:</label>
                <input type="text" class="form-control" name="indiceUV">
            </div>
            <div class="form-group">
                <label for="riesgo">Riesgo:</label>
                <input type="text" class="form-control" name="riesgo">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Enviar Datos</button>
        </form>
    </div>
    
    <!-- Agregado de scripts de Bootstrap y jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</body>
</html>
