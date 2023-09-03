<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promedios por hora</title>
 

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

    <h2>Filtro de búsqueda</h2>
    <form method="POST" action="" id="formulario">
        <label for="fecha">Selecciona una fecha:</label>
        <select id="fecha" name="fecha" required >
            <option value="1" selected disabled>Seleccione una fecha</option>
            <?php
            // Importar archivo de conexión
            require_once 'conexion.php';

            // Realizar conexión a la base de datos
            $conexion = conectar();

            // Obtener las fechas existentes en la base de datos
            $query = "SELECT DISTINCT DATE(fecha) AS fecha FROM datos ORDER BY fecha ASC";
            $result = mysqli_query($conexion, $query);

            // Recorrer los resultados y generar las opciones del select
            while ($row = mysqli_fetch_assoc($result)) {
                $fechaOption = $row['fecha'];
                $selected = ($fechaOption == $fecha) ? 'selected' : '';
                echo "<option value='$fechaOption' $selected>$fechaOption</option>";
            }
            ?>
        </select>
       
    </form>

    <?php
// Verificar si se ha enviado el formulario o es la primera carga de la página
if ($_SERVER['REQUEST_METHOD'] === 'POST' || !isset($_POST['fecha'])) {
    // Obtener el día seleccionado
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : date('Y-m-d');

    // Función para obtener los promedios por hora y día
    function obtenerPromedioPorHora($fecha)
    {
        // Importar archivo de conexión
        require_once 'conexion.php';

        // Realizar conexión a la base de datos
        $conexion = conectar();

        // Consulta SQL para obtener el promedio por hora y día
        $query = "SELECT DATE_FORMAT(fecha, '%h:00:00 %p') AS hora, AVG(temperatura) AS promedio_temperatura, AVG(humedad) AS promedio_humedad,
                                                                    AVG(velocidad) as promedio_velocidad, AVG(indiceUV) as promedio_indiceUV
        FROM datos
        WHERE DATE(fecha) = '$fecha'
        GROUP BY hora
        ORDER BY STR_TO_DATE(hora, '%h:%i:%s %p') ASC";

        // Ejecutar la consulta
        $result = mysqli_query($conexion, $query);

        // Verificar si se obtuvieron resultados
        if ($result) {
            // Crear arreglos para almacenar los resultados
            $horas = [];
            $promedios_temperatura = [];
            $promedios_humedad = [];
            $promedios_velocidad = [];
            $promedios_indiceUV = [];

            // Recorrer los resultados y almacenarlos en los arreglos
            while ($row = mysqli_fetch_assoc($result)) {
                $hora = $row['hora'];
                $promedio_temperatura = $row['promedio_temperatura'];
                $promedio_humedad = $row['promedio_humedad'];
                $promedio_velocidad = $row['promedio_velocidad'];
                $promedio_indiceUV = $row['promedio_indiceUV'];
                $horas[] = $hora;
                $promedios_temperatura[] = $promedio_temperatura;
                $promedios_humedad[] = $promedio_humedad;
                $promedios_velocidad[] = $promedio_velocidad;
                $promedios_indiceUV[] = $promedio_indiceUV;
            }

            // Devolver los arreglos de promedios
            return [
                'horas' => $horas,
                'promedios_temperatura' => $promedios_temperatura,
                'promedios_humedad' => $promedios_humedad,
                'promedios_velocidad' => $promedios_velocidad,
                'promedios_indiceUV' => $promedios_indiceUV,
            ];
        } else {
            // En caso de error, mostrar un mensaje o manejar el error según sea necesario
            return false;
        }
    }

    // Obtener los promedios por hora y día
    $promedios = obtenerPromedioPorHora($fecha);

    // Verificar si se obtuvieron resultados
    if ($promedios) {
        // Obtener los arreglos de promedios
        $horas = $promedios['horas'];
        $promedios_temperatura = $promedios['promedios_temperatura'];
        $promedios_humedad = $promedios['promedios_humedad'];
        $promedios_velocidad = $promedios['promedios_velocidad'];
        $promedios_indiceUV= $promedios['promedios_indiceUV'];
        // Convertir los arreglos en formato JSON
        $horas_json = json_encode($horas);
        $promedios_temperatura_json = json_encode($promedios_temperatura);
        $promedios_humedad_json = json_encode($promedios_humedad);
        $promedios_velocidad_json = json_encode($promedios_velocidad);
        $promedios_indiceUV_json = json_encode($promedios_indiceUV);
    } else {
        // Mostrar un mensaje si no se encontraron resultados para el día seleccionado
        echo "<p>No se encontraron promedios para el día seleccionado.</p>";
    }
}
?>
  <div style="margin-left: 30rem;">
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
        <button id="Btn1" class="btn btn-danger" onclick="changeData('Btn1')">Temperatura y humedad</button>
<button id="Btn2" class="btn btn-success" onclick="changeData('Btn2')">Velocidad e indice UV</button>

</div>
        </div>
    <div style="width: 60rem; height: 40rem; margin: 0 auto; padding-top: 20px; color: black;">

      
        <canvas id="grafica"></canvas>
    </div>

    <script>
        // Obtener los datos en formato JSON
        var horas = <?php echo $horas_json; ?>;
        var promedios_temperatura = <?php echo $promedios_temperatura_json; ?>;
        var promedios_humedad = <?php echo $promedios_humedad_json; ?>;
        var promedios_velocidad = <?php echo $promedios_velocidad_json; ?>;
        var promedios_indiceUV = <?php echo $promedios_indiceUV_json; ?>;
        // Crear los conjuntos de datos
        const temperatura2023 = {
            label: "Temperatura °C",
            data: promedios_temperatura,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: '#910066',
            borderWidth: 1,
        };
        const humedad2023 = {
            label: "Humedad %",
            data: promedios_humedad,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
        };

        

       function changeData(btn) {
        var ctx = document.getElementById('grafica').getContext('2d');  // Obtén el contexto del canvas
var existingChart = Chart.getChart(ctx);  // Obtén el gráfico existente asociado al canvas
localStorage.setItem('ultimoBotonPresionado', btn);
if(existingChart) {
    existingChart.destroy();
}
      // Configuración de la gráfica
      if(btn == 'Btn1') {
        document.getElementById('Btn1').style.backgroundColor = 'red';
        
        document.getElementById('Btn2').style.backgroundColor = 'gray';
        temperatura2023.data =  promedios_temperatura;
        temperatura2023.label = "Temperatura °C";
        humedad2023.data = promedios_humedad;
        humedad2023.label = "Humedad %";
    }
    else {
        temperatura2023.data =  promedios_velocidad;
        temperatura2023.label = "Velocidad: M/s";
        humedad2023.label = "Indice %";
        document.getElementById('Btn1').style.backgroundColor = 'gray';
        document.getElementById('Btn2').style.backgroundColor = 'red';
    }

    new Chart(document.getElementById("grafica"), {
        type: 'line',
        data: {
            labels: horas,
            datasets: [
                temperatura2023,
                humedad2023,
            ]
        },
        options: {
            scales: {
                x: {
                    ticks: {
                        color: 'black', // Cambiar el color de las etiquetas del eje X
                        font: {
                            weight: 'bold' // Leyendas en negritas
                        }
                    }
                },
                y: {
                    ticks: {
                        color: 'black', // Cambiar el color de las etiquetas del eje Y
                        font: {
                            weight: 'bold' // Leyendas en negritas
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: 'black', // Cambiar el color de las leyendas
                        font: {
                            weight: 'bold' // Leyendas en negritas
                        }
                    }
                }
            }
        }
    });
    }
      


          // Obtener el elemento del select
          var selectFecha = document.getElementById("fecha");

// Agregar un evento de cambio al select
selectFecha.addEventListener("change", function() {
    // Enviar el formulario al cambiar la opción del select
    document.getElementById("formulario").submit();
});

  // Obtener la referencia al elemento select
  var selectFecha = document.getElementById("fecha");

// Obtener el valor actualmente seleccionado
var fechaSeleccionada = "<?php echo $fecha; ?>";

// Establecer la fecha seleccionada en el select
for (var i = 0; i < selectFecha.options.length; i++) {
    if (selectFecha.options[i].value === fechaSeleccionada) {
        selectFecha.options[i].selected = true;
        break;
    }
}


// Al cargar la página
window.onload = function() {
  // Obtén el ID del último botón presionado desde el almacenamiento local
  var ultimoBotonPresionado = localStorage.getItem('ultimoBotonPresionado');
  
  if (ultimoBotonPresionado) {
    // Encuentra el botón por su ID y simula un clic en él
    document.getElementById(ultimoBotonPresionado).click();
    document.getElementById(ultimoBotonPresionado).style.backgroundColor = 'red';
  }
  else {
    document.getElementById('Btn1').click();
    document.getElementById('Btn1').style.backgroundColor = 'red';
  document.getElementById('Btn2').style.backgroundColor = 'gray';
   
}

  // Espera un tiempo determinado antes de recargar la página
  var tiempoEspera = 300000; // 5 segundos (ejemplo)
  setTimeout(function() {
    location.reload();
  }, tiempoEspera);
};


new Chart(document.getElementById("grafica"), {
        type: 'line',
        data: {
            labels: horas,
            datasets: [
                temperatura2023,
                humedad2023,
            ]
        },
        options: {
            scales: {
                x: {
                    ticks: {
                        color: 'black', // Cambiar el color de las etiquetas del eje X
                        font: {
                            weight: 'bold' // Leyendas en negritas
                        }
                    }
                },
                y: {
                    ticks: {
                        color: 'black', // Cambiar el color de las etiquetas del eje Y
                        font: {
                            weight: 'bold' // Leyendas en negritas
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: 'black', // Cambiar el color de las leyendas
                        font: {
                            weight: 'bold' // Leyendas en negritas
                        }
                    }
                }
            }
        }
    });

    </script>
   
      <script src="script.js"></script>
 
      <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
</body>
</html>
