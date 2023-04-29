<?php
// Conectamos con la base de datos
$conexion = mysqli_connect("localhost", "root", "", "lachila");

// Obtenemos los datos del lote a actualizar
$doc = $_POST["doc"];
$nombres = $_POST["nombres"];
$apellidos = $_POST["apellidos"];
$cel = $_POST["cel"];

$contraseña = $_POST["contraseña"];
// Actualizamos los datos en la base de datos
$query = "UPDATE usuarios SET nombres = '$nombres', apellidos = '$apellidos' , num_telefono = '$cel' , clave = '$contraseña' WHERE num_documento = '$doc'";

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