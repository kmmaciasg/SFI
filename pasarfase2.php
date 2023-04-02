<?php
// Verificamos que se haya enviado un valor para el número de lote
if (isset($_POST['num_lote'])) {
  // Obtenemos el valor del número de lote
  $lote = $_POST['num_lote'];

  // Conectamos a la base de datos
  $conn = new mysqli("localhost", "root", "", "lachila");

  // Verificamos si hubo un error en la conexión
  if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
  }

  // Consultamos los datos correspondientes al número de lote recibido
  $sql = "SELECT * FROM fase1 WHERE lote = '$lote'";
  $result = $conn->query($sql);

  // Verificamos si hubo un error en la consulta
  if (!$result) {
    die("Error al consultar los datos de la base de datos: " . $conn->error);
  }

  // Obtenemos los datos correspondientes al número de lote recibido
  $row = $result->fetch_assoc();
  $materia = $row['materia'];
  $fecha = $row['fecha'];
  $pesoinicial = $row['peso_i'];
  $pesodesperdicio = $row['peso_n'];
  $adicion = $row['adicion'];
  $cantidad = $row['cant'];
  $empleado = $row['usuario'];

  // Insertamos los datos en la tabla fase2
  $sql = "INSERT INTO fase2 (lote, materia, fecha, peso_i, peso_n, adicion, cant, usuario) VALUES ('$lote', '$materia', '$fecha', '$pesoinicial', '$pesodesperdicio', '$adicion', '$cantidad', '$empleado')";
  $result = $conn->query($sql);

  // Verificamos si hubo un error en la inserción
  if (!$result) {
    die("Error al insertar los datos en la base de datos: " . $conn->error);
  }

  $sql = "DELETE FROM fase1 WHERE lote = '$lote'";
if (mysqli_query($conn, $sql)) {
    echo "El registro fue eliminado exitosamente de la tabla fase1";
} else {
    echo "Error al eliminar el registro: " . mysqli_error($conn);
}
  // Cerramos la conexión a la base de datos
  $conn->close();

  // Mostramos un mensaje de éxito
  echo "Los datos han sido guardados correctamente.";
} else {
  // Si no se recibió un valor para el número de lote, mostramos un mensaje de error
  echo "Error: no se recibió el número de lote.";
}
?>
