<?php
// Conectamos con la base de datos
$conexion = mysqli_connect("localhost", "root", "", "lachila");

// Obtenemos los datos del lote a actualizar
$id_envasado = $_POST["id_envasado"];
$id_lote = $_POST["id_lote"];
$materia = $_POST["materia"];
$fecha_envasado = $_POST["fecha_inicio"];
$tipoenvase = $_POST["adicion"];
$cantidad = $_POST["cantidad"];
$usuario = $_POST["usuario"];
$loteagua = $_POST["loteagua"];

// Actualizamos los datos en la base de datos
$query = "UPDATE envasado SET materia = '$materia', fecha_envasado = '$fecha_envasado', Tipo_Envase = '$tipoenvase', cantidad = $cantidad, Usuario = '$usuario', loteagua = '$loteagua' WHERE id = '$id_envasado'";

if (mysqli_query($conexion, $query)) {
    // Si se han actualizado los datos correctamente, devolvemos una respuesta satisfactoria
    echo "Los cambios se han guardado correctamente";
} else {
    // Si ha habido algún error, devolvemos un mensaje de error
    echo "Error al guardar los cambios";
}

// Cerramos la conexión con la base de datos
mysqli_close($conexion);
?>
