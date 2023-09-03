var speed = 0;
var number = document.getElementById("velocidad").value
var prevSpeed = 0;
var currentScale = 1;

function increaseSpeed() {
    if (speed < 180) {
        speed = speed + 10;
        addClass();
        currentScale = currentScale + 1;
        changeActive();
        changeText();
    }
}

// Espera un tiempo determinado (en milisegundos) antes de recargar la página
function reloadPageWithDelay(delay) {
    setTimeout(function() {
        location.reload();
    }, delay);
}

// Llama a la función para recargar la página después de un cierto tiempo (por ejemplo, 3000 ms = 3 segundos)
reloadPageWithDelay(30000);

while(speed < parseInt(number *4)) {
   
    increaseSpeed()
    console.log(speed)
}

function addClass() {
    let newClass = "speed-" + speed;
    let prevClass = "speed-" + prevSpeed;
    let el = document.getElementsByClassName("arrow-wrapper")[0];
    if (el.classList.contains(prevClass)) {
        el.classList.remove(prevClass);
        el.classList.add(newClass);
    }
    prevSpeed = speed;
}

function changeActive() {
    let tempClass = "speedometer-scale-" + currentScale;
    let el = document.getElementsByClassName(tempClass)[0];
    el.classList.toggle("active");
}

function changeText() {
    let el = document.getElementsByClassName("km")[0];
    el.innerText = number;
}



  $(".hide").on('click', function() {
    $("nav ul").toggle('slow');
  })
