<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tabla de Datos con Filtro de Fechas</title>
    <style>
    .styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    width: 80rem;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    width: 90%; /* Cambiar el ancho a 100% */
}


.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}

.styled-table th,
.styled-table td {
    padding: 12px 15px;
}

.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}
.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3; /* Color para las filas pares */
}

.styled-table tbody tr:nth-of-type(odd) {
    background-color: #d3d3d3; /* Un tono de gris diferente */
}
.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}

.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}
  </style>
</head>
<body>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.3.2"></script>
    <link rel="stylesheet" href="mainCss.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    
<nav>
  <ul>
    <li><a href="index.php">Inicio</a></li>
    <li><h1>Estación Meteorológica 1</h1></li>
    <li><a href="graficos.php">Ver Graficos</a></li>
    <li><a href="listado_datos.php">Lista de datos</a></li>

  </ul>
  <div class="hide">
    <i class="fa fa-bars" aria-hidden="true"></i> Menu
  </div>
</nav>

    <center>
    <h2>Tabla de Datos con Filtro de Fechas</h2>
    <form method="post">
        <label for="fechaFiltro">Filtrar por fecha:</label>
        <select id="fechaFiltro" name="fechaFiltro">
            <option value="" selected>Ninguna selección</option>
            <?php
            // Importar archivo de conexión
            require_once 'conexion.php';

            // Realizar conexión a la base de datos
            $conexion = conectar();

            // Realizar consulta para obtener las fechas disponibles
            $queryFechas = "SELECT DISTINCT DATE(fecha) AS fecha FROM datos ORDER BY fecha DESC";
            $resultFechas = mysqli_query($conexion, $queryFechas);

            // Recorrer los resultados y crear las opciones del select
            while ($rowFecha = mysqli_fetch_assoc($resultFechas)) {
                $fecha = $rowFecha['fecha'];
                echo "<option value='$fecha'>$fecha</option>";
            }

            // Cerrar la conexión
            mysqli_close($conexion);
            ?>
        </select>
    </form>
    
   <div class="table-responsive">
   <table border="1" id="tablaDatos" class="styled-table">
        <thead>
        <tr>
        
            <th>Fecha</th>
            <th>Temperatura</th>
            <th>Humedad</th>
            <th>Velocidad del viento</th>
              <th>Angulo</th>
            <th>Direccion</th>
            <th>Índice UV</th>
            <th>Riesgo</th>
          
        </tr>
        </thead>
       <tbody>
       <?php
        // Importar archivo de conexión
        require_once 'conexion.php';

        // Realizar conexión a la base de datos
        $conexion = conectar();

        // Verificar si se ha seleccionado una fecha para filtrar
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fechaFiltro']) && !empty($_POST['fechaFiltro'])) {
            $fechaFiltro = $_POST['fechaFiltro'];
            $query = "SELECT * FROM datos WHERE DATE(fecha) = '$fechaFiltro' ORDER BY fecha DESC";
        } else {
            $query = "SELECT * FROM datos ORDER BY fecha DESC";
        }

        // Realizar consulta a la base de datos
        $result = mysqli_query($conexion, $query);

        // Recorrer los resultados y mostrarlos en la tabla
        while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['fecha']; ?></td>
                <td><?php echo $row['temperatura'] . "°C"; ?></td>
                <td><?php echo $row['humedad'] . "%"; ?></td>
                <td><?php echo $row['velocidad'] . " m/s"; ?></td>
                <td><?php echo $row['angulo']; ?></td>
                <td><?php echo $row['direc']; ?></td>
                <td><?php echo $row['indiceUV']; ?></td>
                <td><?php echo $row['riesgo']; ?></td>
          
            </tr>
        <?php endwhile;

        // Liberar el resultado
        mysqli_free_result($result);

        // Cerrar la conexión
        mysqli_close($conexion);
        ?>
       </tbody>
    </table>
   </div>
    </center>

    <script>
        // Obtener referencia al select de fecha
        const fechaFiltroSelect = document.getElementById('fechaFiltro');

        // Agregar un evento de cambio al select de fecha
        fechaFiltroSelect.addEventListener('change', function() {
            // Enviar el formulario al cambiar la opción del select
            this.form.submit();
        });

        // Mantener seleccionada la fecha previamente elegida
        const fechaSeleccionada = "<?php echo isset($_POST['fechaFiltro']) ? $_POST['fechaFiltro'] : ''; ?>";
        if (fechaSeleccionada) {
            fechaFiltroSelect.value = fechaSeleccionada;
        }
    </script>
</body>
</html>
