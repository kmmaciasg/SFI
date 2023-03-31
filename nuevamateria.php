<?php
// Conectarse a la base de datos
  $conexion = mysqli_connect ("localhost", "root", "", "lachila" ); 

  
  $materia = $_POST['MateriaPrima2'];
  

  // Insertar los datos en la base de datos
  $sql = "INSERT INTO materias (nombre) VALUES ('$materia')";

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