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
    rutas.push({"numRuta": numRuta, "lugares": lugares});
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
        $("#lugaresRuta").append("<li>" + lugares[i] + "</li>");
    }
}

// Función para marcar un lugar como visitado
function marcarLugar() {
    var lugar = $(this).text();
    $(this).addClass("visitado");
    $("#lugaresVisitados").append("<li>" + lugar + "</li>");
}

// Función para mostrar los lugares visitados de la ruta seleccionada
function mostrarLugaresVisitados() {
    var index = $("#ruta").val();
    var lugaresVisitados = rutas[index].lugares.filter(function(lugar) {
        return $(".visitado:contains('" + lugar + "')").length > 0;
    });
    $("#lugaresVisitados").empty();
    for (var i = 0; i < lugaresVisitados.length; i++) {
        $("#lugaresVisitados").append("<li>" + lugaresVisitados[i] + "</li>");
    }
}

// Función para inicializar la página
$(document).ready(function() {
    mostrarRutas();
    $("#ruta").change(mostrarLugares);
    $("#lugaresRuta").on("click", "li", marcarLugar);
    $("#ruta").change(mostrarLugaresVisitados);
});

