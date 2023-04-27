<?php
// Conectamos con la base de datos
$conexion = mysqli_connect("localhost", "root", "", "lachila");

// Obtenemos los datos del lote a actualizar
$id_lote = $_POST["id_lote"];
$materia = $_POST["materia"];
$fecha_inicio = $_POST["fecha_inicio"];
$peso_inicial = $_POST["peso_inicial"];
$peso_neto = $_POST["peso_neto"];
$p_desperdicio = $_POST["p_desperdicio"];
$adicion = $_POST["adicion"];
$cantidad = $_POST["cantidad"];
$usuario = $_POST["usuario"];
$loteagua = $_POST["loteagua"];

// Actualizamos los datos en la tabla 'lotes'
$query_lotes = "UPDATE lotes SET Materia = '$materia', fecha_inicio = '$fecha_inicio', peso_inicial = $peso_inicial, peso_neto = $peso_neto, p_desperdicio = $p_desperdicio, adicion = '$adicion', Cantidad = $cantidad, Usuario = '$usuario', loteagua = '$loteagua' WHERE id = '$id_lote'";

// Actualizamos los datos en la tabla 'fase1'
$query_fase1 = "UPDATE fase1 SET materia = '$materia', fecha = '$fecha_inicio', peso_i = $peso_inicial, peso_n = $peso_neto, adicion = '$adicion', cant = $cantidad, usuario = '$usuario', loteagua = '$loteagua' WHERE lote = '$id_lote'";

// Ejecutamos las consultas de actualización
if (mysqli_query($conexion, $query_lotes) && mysqli_query($conexion, $query_fase1)) {
    // Si se han actualizado los datos correctamente, devolvemos una respuesta satisfactoria
    echo "Los cambios se han guardado correctamente";
} else {
    // Si ha habido algún error, devolvemos un mensaje de error
    echo "Error al guardar los cambios";
}

// Cerramos la conexión con la base de datos
mysqli_close($conexion);

?>
