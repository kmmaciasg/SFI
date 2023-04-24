<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "lachila");

// Verificar conexión
if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Recibir el dato del campo "numero_orden"
$numero_orden = $_POST["numero_orden"];
$fecha = $_POST["fecha"];

// Consulta SQL para insertar el dato en la tabla "o_subir"
$sql = "UPDATE `o_facturada` SET fecha = '$fecha' WHERE numero_orden = '$numero_orden'";
$result = $conexion->query($sql);

  // Verificamos si hubo un error en la inserción
  if (!$result) {
    die("Error al insertar los datos en la base de datos: " . $conn->error);
  }
  $conexion->close();

  // Mostramos un mensaje de éxito
  echo "Los datos han sido guardados correctamente.";

?>