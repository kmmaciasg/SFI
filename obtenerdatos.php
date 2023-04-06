<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lachila";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobación de la conexión
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

// Recuperación de los datos del cliente seleccionado
$nombre = $_POST['nombre'];
$sql = "SELECT * FROM clientes WHERE nombre = '$nombre'";
$result = $conn->query($sql);

// Comprobación de si se encontró el cliente
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $cedula = $row['cedula'];
  $cel = $row['cel'];
  $email = $row['email'];
  $ciudad = $row['ciudad'];
  $dir = $row['dir'];

  // Devolución de los datos del cliente en formato JSON
  $data = array(
    "cedula" => $cedula,
    "cel" => $cel,
    "email" => $email,
    "ciudad" => $ciudad,
    "dir" => $dir
  );
  echo json_encode($data);
} else {
  echo "Cliente no encontrado";
}

// Cierre de la conexión a la base de datos
$conn->close();
?>

