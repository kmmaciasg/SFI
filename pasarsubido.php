<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "lachila");

// Verificar conexión
if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Recibir el dato del campo "numero_orden"
$numero_orden = $_POST["numero_orden"];

// Consulta SQL para insertar el dato en la tabla "o_subir"
$sql = "INSERT INTO `o_subido` (numero_orden) VALUES ('$numero_orden')";
$result = $conexion->query($sql);

  // Verificamos si hubo un error en la inserción
  if (!$result) {
    die("Error al insertar los datos en la base de datos: " . $conn->error);
  }

$sql2 = "DELETE FROM `o_subir` WHERE numero_orden = '$numero_orden'";

if (mysqli_query($conexion, $sql2)) {
    
    echo "El registro fue eliminado exitosamente de la tabla fase1";
} else {
    echo "Error al eliminar el registro: " . mysqli_error($conn);
}
  // Cerramos la conexión a la base de datos
  $conexion->close();

  // Mostramos un mensaje de éxito
  echo "Los datos han sido guardados correctamente.";

?>