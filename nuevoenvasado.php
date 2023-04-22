<?php
// Conectarse a la base de datos
  $conexion = mysqli_connect ("localhost", "root", "", "lachila" ); 

  $fecha = $_POST['fecha'];
  $tipoenvase = $_POST['tipo'];
  $loteagua = $_POST['arealoteagua'];
  $materia = $_POST['areaMateriaPrima'];
  $empleado = $_POST['Empleado'];
  $cantidad = $_POST['Cant'];
  $lote = $_POST['opciones'];
  

  // Insertar los datos en la base de datos
  $sql = "INSERT INTO envasado (Lote, loteagua, Tipo_Envase, Usuario, cantidad, fecha_envasado, materia) VALUES ('$lote','$loteagua','$tipoenvase', '$empleado','$cantidad','$fecha','$materia')";

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
