<?php
        // Importar archivo de conexión
        require_once 'conexion.php';

        // Realizar conexión a la base de datos
        $conexion = conectar();

        // Realizar consulta a la base de datos
        $query = "SELECT * FROM datos ORDER BY fecha DESC LIMIT 1";
        $result = mysqli_query($conexion, $query);
        $row = mysqli_fetch_assoc($result);
      ?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="mainCss.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&display=swap" rel="stylesheet">
<link rel="icon" href="img/sun.png">
<style>
      /* Agrega un contenedor que envuelva ambas columnas */
.grid-container {
  display: flex;
  flex-wrap: wrap; /* Esto permite que las columnas se envuelvan en dispositivos pequeños */
}

/* Establece el ancho de las columnas */
.left-column {
  flex: 1; /* La columna izquierda ocupa 1 parte de espacio */
}

.right-column {
  flex: 1; /* La columna derecha ocupa 1 parte de espacio */
}

/* Utiliza una media query para cambiar el diseño en dispositivos pequeños */
@media (max-width: 768px) {
  .grid-container {
    flex-direction: column; /* Cambia a diseño de columna en dispositivos pequeños */
    .speedometer-bottom-hide {
    width: 320px;
    height: 160px;
    
    position: absolute;
    z-index: 11;
    top: 160px;
    left: -14px;
    border-top: 1px solid;
}
  }
  
  /* Restaura el ancho completo de las columnas en dispositivos pequeños */
  .left-column,
  .right-column {
    flex: 0 0 100%; /* Las columnas ocupan el 100% del ancho disponible */
  }

  
}</style>
  </head>
  <body >

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



  <div id="content">
    
    <input style="display: none;" id="velocidad" type="text" value="<?= $row['velocidad'] ?>">
    <div class="grid-container">
        <div class="left-column">
        
            
            <div class="speedometer-container">
                <div class="speedometer-text">
                    <div class="static"></div>
                    <div class="dynamic">
                        <span class="km"><?= $row['velocidad'] ?></span>
                        <span class="unit">m/s</span>
                    </div>
                </div>
                <div class="center-point"></div>
                <div class="speedometer-center-hide"></div>
                <div class="speedometer-bottom-hide"></div>
                <div class="arrow-container">
                    <div class="arrow-wrapper speed-0">
                        <div class="arrow"></div>
                    </div>
                </div>
                <div class="speedometer-scale speedometer-scale-1 active">0</div>
                <div class="speedometer-scale speedometer-scale-2"></div>
                <div class="speedometer-scale speedometer-scale-3">5</div>
                <div class="speedometer-scale speedometer-scale-4"></div>
                <div class="speedometer-scale speedometer-scale-5">10</div>
                <div class="speedometer-scale speedometer-scale-6"></div>
                <div class="speedometer-scale speedometer-scale-7">15</div>
                <div class="speedometer-scale speedometer-scale-8"></div>
                <div class="speedometer-scale speedometer-scale-9">20</div>
                <div class="speedometer-scale speedometer-scale-10"></div>
                <div class="speedometer-scale speedometer-scale-11">25</div>
                <div class="speedometer-scale speedometer-scale-12"></div>
                <div class="speedometer-scale speedometer-scale-13">30</div>
                <div class="speedometer-scale speedometer-scale-14"></div>
                <div class="speedometer-scale speedometer-scale-15">35</div>
                <div class="speedometer-scale speedometer-scale-16"></div>
                <div class="speedometer-scale speedometer-scale-17">40</div>
                <div class="speedometer-scale speedometer-scale-18"></div>
                <div class="speedometer-scale speedometer-scale-19">45</div>
            </div>
       <div class="accelerate-container">
       <div class="static">Velocidad del viento <br><br>
       Angulo: <?= $row['angulo'] ?>° respecto al norte <br><br>
       Direccion: <?= $row['direc'] ?> 
      </div>
       
            </div>


        </div>



        <div class="right-column">
      

      <div class="row1">
        <div class="col1">
          <img src="img/temperatura.png" alt="" style="width: 7rem; height: 7rem;">
        </div>
        <div class="col2">
          <h2>Temperatura</h2>
          <p id="temperatura"><?= $row['temperatura'] ?>°C</p>
          <p><?= round(($row['temperatura']*1.8)+32, 2) ?>°F</p>
        </div>
      </div>

      <div class="row2">
        <div class="col1">
          <img src="img/gota-de-agua.png" alt="" style="width: 7rem; height: 7rem;">
        </div>
        <div class="col2">
          <h2>Porcentaje de Humedad</h2>
          <p><?= $row['humedad'] ?>% en ambiente</p>
        </div>
      </div>

      <div class="row3">
        <div class="col1">
          <img src="img/sol-removebg-preview.png" alt="" style="width: 7rem; height: 7rem;">
        </div>
        <div class="col2">
          <h2>Radiacion UV</h2>
          <p>Indice UV: <?= $row['indiceUV'] ?></p>
          <P>Riesgo: <?= $row['riesgo'] ?></P>
        </div>
      </div>
    </div>
      </div>

   
    
</div>
      
      
      <script src="script.js"></script>
 
      <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  
  </body>
</html>




 


