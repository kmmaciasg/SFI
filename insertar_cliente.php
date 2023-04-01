<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lachila";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos del nuevo producto
$nombre = $_POST["nombre"];
$cedula = $_POST["cedula"];
$cel = $_POST["cel"];
$email = $_POST["email"];
$ciudad = $_POST["ciudad"];
$dir = $_POST["dir"];

// Insertar el nuevo producto en la tabla productos
$sql = "INSERT INTO `clientes`(`nombre`, `cedula`, `cel`, `email`, `ciudad`, `dir`) VALUES ('$nombre','$cedula','$cel','$email','$ciudad','$dir')";

if ($conn->query($sql) === TRUE) {
  echo "Nuevo producto creado correctamente";
} else {
  echo "Error al crear el nuevo producto: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>