<?php
// Conectamos con la base de datos
$conexion = mysqli_connect("localhost", "root", "", "lachila");

// Obtenemos los datos del lote a actualizar
$id_envasado = $_POST["id_envasado1"];
$id_lote = $_POST["id_lote1"];
$materia = $_POST["materia1"];
$stock = $_POST["stock1"];

// Actualizamos los datos en la base de datos
$query = "UPDATE bandas SET cant = '$materia', Descripcion = '$id_lote' , stock_limite = '$stock' WHERE id = '$id_envasado'";

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