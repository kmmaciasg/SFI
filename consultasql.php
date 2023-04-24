<?php
include 'conexion_db.php';

// Consulta SQL para obtener los datos
$query = "SELECT numero_orden FROM ordenes_despacho ORDER BY id DESC LIMIT 1";
$resultorden = mysqli_query($conexion, $query);

if (mysqli_num_rows($resultorden) > 0) {
	$row = mysqli_fetch_assoc($resultorden);
	$last_order_number = $row["numero_orden"];
    // Generar el siguiente número de orden
  	$new_order_number = $last_order_number + 1;
}

// Consulta para seleccionar los datos de la tabla "ordenes_despacho"
$sql2 = "SELECT producto FROM ordenes_despacho WHERE numero_orden = '$last_order_number'" ;
$result = $conexion->query($sql2);

if (mysqli_num_rows($result) > 0) {
  // Almacenar el resultado de la consulta en una variable
  $producto = array();
  while ($fila = mysqli_fetch_assoc($result)) {
    $producto[] = $fila;
  }

  echo json_encode($producto);
}


// Cerramos la conexión a la base de datos
$conexion->close();
?>

