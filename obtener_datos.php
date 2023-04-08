<?php
$numeroOrden = $_POST['numeroOrden'];

// Realizamos la conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'lachila');

// Verificamos si hubo un error en la conexión
if ($conexion->connect_error) {
  die('Error en la conexión: ' . $conexion->connect_error);
}

// Realizamos la consulta a la base de datos para obtener los datos correspondientes a la orden
$sql = "SELECT cliente, fecha, cajas, pago, embalaje, creador, transportadora FROM o_despacho WHERE numero_orden = '$numeroOrden'";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
  // Si encontramos los datos correspondientes a la orden, los enviamos como respuesta en formato JSON
  $datosOrden = $resultado->fetch_assoc();

  // Hacemos una segunda consulta para obtener los datos del cliente
  $nombreCliente = $datosOrden['cliente'];
  $sql2 = "SELECT cedula, cel, email, ciudad, dir FROM clientes WHERE nombre = '$nombreCliente'";
  $resultado2 = $conexion->query($sql2);
  $datosCliente = $resultado2->fetch_assoc();

  // Combinamos los datos de la orden y del cliente en un solo objeto
  $datosCompletos = array_merge($datosOrden, $datosCliente);
  
  echo json_encode($datosCompletos);
} else {
  // Si no encontramos los datos correspondientes a la orden, enviamos un mensaje de error
  echo 'No se encontraron datos para el número de orden ingresado';
}


// Cerramos la conexión a la base de datos
$conexion->close();
?>



