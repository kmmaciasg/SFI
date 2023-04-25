<?php
// Conectamos con la base de datos
$conexion = mysqli_connect("localhost", "root", "", "lachila");

// Obtenemos los datos del lote a actualizar
$id_parametros = $_POST["id_envasado"];
$id_lote = $_POST["id_lote"];
$materia = $_POST["materia"];
$fecha_registro = $_POST["fecha_inicio"];
$brix = $_POST["adicion"];
$alcohol = $_POST["cantidad"];
$usuario = $_POST["usuario"];
$loteagua = $_POST["loteagua"];
$ph = $_POST["ph"];
$ac = $_POST["ac"];
$solidos = $_POST["solidos"];
$temperatura = $_POST["temperatura"];

// Actualizamos los datos en la base de datos
$query = "UPDATE `registro_variables` SET fecha_registro = '$fecha_registro', brix = '$brix',alcohol = '$alcohol',ph = '$ph',ac= '$ac',solidos = '$solidos',temperatura = '$temperatura' WHERE id = '$id_parametros'";

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
