<?php
// Obtenemos los datos enviados por la petición AJAX
$numeroRuta = $_POST["numero_ruta"];
$lugaresVisitados = $_POST["lugares_visitados"];

// Creamos la conexión a la base de datos MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lachila";

$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobamos si hay algún error en la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
}

// Insertamos los datos en la tabla 'ruta'
$sql = "INSERT INTO ruta (N_ruta, lugares) VALUES ('$numeroRuta', '$lugaresVisitados')";

if ($conn->query($sql) === TRUE) {
    echo "Los datos se han insertado correctamente en la base de datos.";
} else {
    echo "Error al insertar los datos en la base de datos: " . $conn->error;
}

// Cerramos la conexión a la base de datos
$conn->close();
?>
