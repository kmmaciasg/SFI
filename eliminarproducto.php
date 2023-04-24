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
// Procesar los datos ingresados por el usuario
$producto = $_POST["producto"];
$numeroorden = $_POST["numero_orden"];

$sql = "DELETE FROM ordenes_despacho WHERE producto = '$producto' AND numero_orden = '$numeroorden'";

if (mysqli_query($conn, $sql)) {
    echo '
    <script>
      alert("El producto fue eliminado correctamente");
      window.close();
      window.opener.actualizarTabla();
    </script>
    ';
  } else {
    echo "No se encontró el producto en la tabla de productos.";
  }


mysqli_close($conn);
?>
