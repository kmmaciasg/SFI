<?php

// Obtén los datos enviados por la solicitud AJAX
$lote = $_POST['lote'];
$litrajeNuevo = $_POST['litraje'];

// Conecta con la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lachila";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// Actualiza el litraje del lote en la base de datos
$sql = "UPDATE fase2 SET cant='$litrajeNuevo' WHERE lote='$lote'";

if ($conn->query($sql) === TRUE) {
  echo "OK";
} else {
  echo "Error al actualizar la base de datos: " . $conn->error;
}

// Cierra la conexión
$conn->close();

?>
