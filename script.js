// Arreglo para almacenar las rutas
var rutas = [];

// Función para agregar un lugar a la lista de lugares
function agregarLugar() {
    var lugar = prompt("Ingresa el nombre del lugar:");
    if (lugar != null && lugar != "") {
        $("#lugares").append("<li>" + lugar + "</li>");
    }
}

// Función para guardar la ruta en el almacenamiento local
function guardarRuta() {
    var numRuta = $("#numRuta").val();
    var lugares = [];
    $("#lugares li").each(function() {
        lugares.push($(this).text());
    });
    rutas.push({"numRuta": $("#numRuta").val(), "lugares": lugares});
    localStorage.setItem("rutas", JSON.stringify(rutas));
    alert("Ruta guardada exitosamente");
    $("#numRuta").val("");
    $("#lugares").empty();
}
// Función para mostrar las rutas en el select
function mostrarRutas() {
    var storedRutas = JSON.parse(localStorage.getItem("rutas"));
    if (storedRutas != null && storedRutas.length > 0) {
        rutas = storedRutas;
        for (var i = 0; i < rutas.length; i++) {
            $("#ruta").append("<option value='" + i + "'>" + rutas[i].numRuta + "</option>");
        }
        // Agregar evento change al select
        $("#ruta").change(function() {
            var index = $(this).val(); // Obtener el índice seleccionado
            var numRuta = rutas[index].numRuta; // Obtener el valor de numRuta correspondiente
            $("#numRutaSeleccionada").text(numRuta); // Mostrar el valor en un elemento de texto aparte
        });
    } else {
        alert("No hay rutas guardadas");
    }
}

// Función para mostrar los lugares de la ruta seleccionada
function mostrarLugares() {
    var index = $("#ruta").val();
    var lugares = rutas[index].lugares;
    $("#lugaresRuta").empty();
    for (var i = 0; i < lugares.length; i++) {
        $("#lugaresRuta").append("<li>"+ "<a>"+"<div class='navLateral-body-cl'>"+"<i class='zmdi zmdi-home'>"+"</i>"+"</div>"+"<div class='navLateral-body-cr'>"+ lugares[i]+ "</div>" +"</a>" + "</li>");

        
								
							
							
							
    }
}

// Función para marcar un lugar como visitado
function marcarLugar() {
    var lugar = $(this).text();
    $(this).addClass("visitado");
    $("#lugaresVisitados").append("<li>"+ "<a>"+"<div class='navLateral-body-cl'>"+"<i class='zmdi zmdi-home'>"+"</i>"+"</div>"+"<div class='navLateral-body-cr'>"+ lugar+ "</div>" +"</a>" + "</li>");
    notify("Nuevo lugar visitado: " + lugar);
}

function notify(message) {
    if (!("Notification" in window)){
      alert("Tu navegador no soporta notificaciones");
    } else if (Notification.permission === "granted"){
      var notification = new Notification(message);
    } else if (Notification.permission === "denied"){
      Notification.requestPermission(function(permission){
        if (Notification.permission === "granted"){
          var notification = new Notification(message);
        }
      });
    }
}


// Función para mostrar los lugares visitados de la ruta seleccionada
function mostrarLugaresVisitados() {
    var index = $("#ruta").val();
    var lugaresVisitados = rutas[index].lugares.filter(function(lugar) {
        return $(".visitado:contains('" + lugar + "')").length > 0;
    });
    $("#lugaresVisitados").empty();
    for (var i = 0; i < lugaresVisitados.length; i++) {
        $("#lugaresVisitados").append("<li>"+ "<a>"+"<div class='navLateral-body-cl'>"+"<i class='zmdi zmdi-home'>"+"</i>"+"</div>"+"<div class='navLateral-body-cr'>"+ lugaresVisitados[i]+ "</div>" +"</a>" + "</li>");

        
    }
}

// Función para inicializar la página
$(document).ready(function() {
    mostrarRutas();
    $("#ruta").change(mostrarLugares);
    $("#lugaresRuta").on("click", "li", marcarLugar);
    $("#ruta").change(mostrarLugaresVisitados);
});


function Pasardb() {
      // Obtenemos el número de ruta y los lugares visitados
      var numRutaSeleccionada = document.getElementById("numRutaSeleccionada");
      var numeroRuta = numRutaSeleccionada.textContent.trim();

    var lugaresVisitados = "";
    var elementosLugares = document.querySelectorAll("#lugaresVisitados li");
    
    for (var i = 0; i < elementosLugares.length; i++) {
      lugaresVisitados += elementosLugares[i].textContent.trim() + ",";
    }
    
    lugaresVisitados = lugaresVisitados.slice(0, -1); // Eliminar la última coma
    
    // Creamos un objeto FormData para enviar los datos
    var formData = new FormData();
    formData.append("numero_ruta", numeroRuta);
    formData.append("lugares_visitados", lugaresVisitados);
    
    // Creamos una petición AJAX para enviar los datos a la base de datos MySQL
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "guardar_ruta.php");
    xhr.onload = function() {
      if (xhr.status === 200) {
        // Si la petición es exitosa, mostramos un mensaje de éxito
        alert("La ruta se ha guardado exitosamente en la base de datos.");
      } else {
        // Si hay algún error, mostramos un mensaje de error
        alert("Ha ocurrido un error al guardar la ruta en la base de datos.");
      }
    };
    xhr.send(formData);
    eliminarRuta();
    location= "../sfi/home.php"; 
}    

function eliminarRuta() {
    var index = $("#ruta").val();
    var numRuta = rutas[index].numRuta;
   
        rutas.splice(index, 1);
        localStorage.setItem("rutas", JSON.stringify(rutas));
        $("#numRuta").val("");
        $("#lugares").empty();
        $("#ruta").empty();
        mostrarRutas();
}