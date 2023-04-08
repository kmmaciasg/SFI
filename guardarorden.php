<?php
// Conectarse a la base de datos
  $conexion = mysqli_connect ("localhost", "root", "", "lachila" ); 


  // Obtener los datos de los textos
$numero_orden = $_POST['numero_orden'];
$cliente = $_POST['opciones'];
$fecha = $_POST['fecha'];
$cajas = $_POST['cajas'];
$pago = $_POST['pago'];
$embalaje = $_POST['embalaje'];
$creador = $_POST['creador'];
$transportadora = $_POST['transportadora'];


// Insertar los datos en la tabla o_despacho
$sql = "INSERT INTO o_despacho (numero_orden, cliente, fecha, cajas, pago, embalaje, creador, transportadora) VALUES ('$numero_orden', '$cliente', '$fecha', '$cajas', '$pago', '$embalaje', '$creador', '$transportadora')";

if (mysqli_query($conexion, $sql)) {echo '
    <script>
    alert("Los datos fueron grabados correctamente")
    window.location= "../sfi/home.php"; 
    </script>
    '; 
} else {
    echo "Error al insertar los datos: " . mysqli_error($conexion);
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);

  ?>