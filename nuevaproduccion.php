<?php
// Conectarse a la base de datos
  $conexion = mysqli_connect ("localhost", "root", "", "lachila" ); 

  $fecha = $_POST['fecha'];
  $pesoinicial = $_POST['PesoInicial'];
  $pesodesperdicio = $_POST['PesoDesperdicio'];
  $pesoneto = $_POST['PesoNeto'];
  $adiciones = $_POST['Adiciones'];
  $lote = $_POST['#lote'];
  $empleado = $_POST['Empleado'];
  $cantidad = $_POST['Cantidad'];
  $materia = $_POST['opciones'];
  

  // Insertar los datos en la base de datos
  $sql = "INSERT INTO lotes (id, materia, fecha_inicio, peso_inicial, peso_neto, adicion, cantidad, usuario) VALUES ('$lote','$materia','$fecha','$pesoinicial','$pesoneto','$adiciones','$cantidad', '$empleado')";

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
