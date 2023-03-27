<?php
// Conectarse a la base de datos
  $conexion = mysqli_connect ("localhost", "root", "", "lachila" ); 

  $fecha = $_POST['fecha'];
  $alcohol = $_POST['Alcohol'];
  $brix = $_POST['brix'];
  $empleado = $_POST['Empleado'];
  $acidez = $_POST['Acidez'];
  $ph = $_POST['PH'];
  $temperatura = $_POST['Temperatura'];
  $solidos = $_POST['SolidosTotales'];
  $lote = $_POST['opciones'];
  

  // Insertar los datos en la base de datos
  $sql = "INSERT INTO registro_variables (Lote, Usuario, brix, alcohol, ph, solidos, ac, temperatura, fecha_registro) VALUES ('$lote', '$empleado','$brix','$alcohol','$ph','$solidos','$acidez','$temperatura','$fecha')";

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