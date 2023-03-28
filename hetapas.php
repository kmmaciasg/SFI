<?php
// Conectarse a la base de datos
  $conexion = mysqli_connect ("localhost", "root", "", "lachila" ); 

  $fecha = $_POST['fecha2'];
  $empleado = $_POST['Empleado2'];
  $cantidad = $_POST['cant2'];
  $producto = $_POST['opciones2'];
  
  

  // Insertar los datos en la base de datos
  $sql = "INSERT INTO `historial-t-e` (producto, egreso, cantidad, Usuario) VALUES ('$producto','$fecha','$cantidad', '$empleado')";

  $resultado = mysqli_query($conexion, $sql);

  if ($resultado) {echo '
    <script>
    alert("Los datos fueron grabados correctamente")
    window.location= "../sfi/home.php"; 
    </script>
    '; 
  } else {
      echo "Error al insertar los datos: " . mysqli_error($conexion);
  }
  
  // Cerrar la conexión con la base de datos
  mysqli_close($conexion);
  ?>