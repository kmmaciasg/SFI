<?php
// Conectarse a la base de datos
  $conexion = mysqli_connect ("localhost", "root", "", "lachila" ); 

  $cantidad = $_POST['cant'];
  $producto = $_POST['opciones'];
  
// Verificar si hubo error en la conexión
if (mysqli_connect_errno()) {
    echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
    exit();
  }
  
  // Obtener la cantidad actual del producto desde la base de datos
  $consulta = "SELECT cantidad FROM productos WHERE descripcion = '$producto'";
  $resultado = mysqli_query($conexion, $consulta);
  
  // Verificar si hubo error en la consulta
  if (!$resultado) {
    echo "Error en la consulta a la base de datos: " . mysqli_error($conexion);
    mysqli_close($conexion);
    exit();
  }
  
  // Obtener el resultado de la consulta
  
  $fila = mysqli_fetch_array($resultado);
  if (isset($fila)) {
    // El array ha sido inicializado
    
  $cantidadActual = $fila["Cantidad"];

    
  // Calcular la nueva cantidad sumando las unidades ingresadas y las actuales
  $nuevaCantidad = $cantidadActual + $cantidad;
  
  // Actualizar la cantidad en la base de datos
  $consulta = "UPDATE productos SET cantidad = '$nuevaCantidad' WHERE descripcion = '$producto'";
  $resultado = mysqli_query($conexion, $consulta);
  
    // Aquí puedes agregar cualquier código que necesites
  } else {

     // Verificar si hubo error en la consulta
  if (!$resultado) {
    echo "Error en la consulta a la base de datos: " . mysqli_error($conexion);
    mysqli_close($conexion);
    exit();
  }
    // El array no ha sido inicializado
    // Aquí puedes agregar cualquier código que necesites
  }

 
  
  // Verificar si hubo error en la consulta
  if (!$resultado) {
    echo "Error en la consulta a la base de datos: " . mysqli_error($conexion);
    mysqli_close($conexion);
    exit();
  }
  
  // Cerrar la conexión a la base de datos
  mysqli_close($conexion);
  ?>