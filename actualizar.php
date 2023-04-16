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

// Obtener los datos del producto y orden de despacho
$producto = $_POST["producto"];
$LV = $_POST["LV"];
$LC = $_POST["LC"];
$numero_orden = $_POST["numero_orden"];

// Obtener el código del producto
$sql = "SELECT * FROM ordenes_despacho WHERE numero_orden = '$numero_orden' AND producto = '$producto';
";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $codigo_producto = $row["codigo"];
} else {
    echo "No se encontró el producto en la tabla de productos.";
}

// Actualizar los valores de lv y lc en la tabla ordenes_despacho
$sql2 = "UPDATE ordenes_despacho SET lv = '$LV', lc = '$LC' WHERE numero_orden = '$numero_orden'AND producto = '$producto'" ;

if (mysqli_query($conn, $sql2)) {
    echo '
    <script>
    alert("Los valores de lv y lc fueron actualizados correctamente.")
    window.close();
    window.opener.actualizarTabla();
    </script>
    '; 
} else {
    echo "Error al actualizar los valores de lv y lc: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
