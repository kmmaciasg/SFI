<?php
// Conectarse a la base de datos
  $conexion = mysqli_connect ("localhost", "root", "", "lachila" ); 

  $fecha = $_POST['FechaNacimiento'];
  $ape = $_POST['Ape'];
  $cel = $_POST['Cel'];
  $nom = $_POST['Nom'];
  $di = $_POST['DI'];
  $contraseña = $_POST['passwordAdmin'];
  $tipo = $_POST['opciones'];
  

  // Insertar los datos en la base de datos
  $sql = "INSERT INTO usuarios (tipo, nombres, apellidos, num_telefono, num_documento, fecha_nacimiento, clave) VALUES ('$tipo', '$nom','$ape','$cel','$di','$fecha','$contraseña')";

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