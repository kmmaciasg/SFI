<?php
ob_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Guia de Despacho</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/sweetalert2.css">
	<link rel="stylesheet" href="css/material.min.css">
	<link rel="stylesheet" href="css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>



</head>
<?php
// Conectarse a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "lachila");

session_start(); // Iniciar sesión
    if(isset($_SESSION['nombre_usuario'])) // Comprobar si se ha iniciado sesión
        $nombre_usuario = $_SESSION['nombre_usuario']; // Obtener el nombre de usuario guardado en la sesión
        $apellido_usuario = $_SESSION['apellido_usuario']; // Obtener el apellido de usuario guardado en la sesión
       
		
// Concatenar el nombre y apellido en una sola cadena de texto
$nombre_completo = $nombre_usuario . " " . $apellido_usuario;
   
if (isset($_GET['orden'])) {
    $numeroOrden = $_GET['orden'];
  } else {
    // Si no se proporcionó "orden", redirigir a otra página o mostrar un mensaje de error
    echo 'No se encontraron datos para el número de orden ingresado';
    exit();
  }
  

// Realizamos la conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'lachila');

// Verificamos si hubo un error en la conexión
if ($conexion->connect_error) {
  die('Error en la conexión: ' . $conexion->connect_error);
}

// Realizamos la consulta a la base de datos para obtener los datos correspondientes a la orden
$sql = "SELECT cliente, responsable FROM pdf WHERE numero_orden = '$numeroOrden'";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
  // Si encontramos los datos correspondientes a la orden, los enviamos como respuesta en formato JSON
  $datosOrden = $resultado->fetch_assoc();

  // Hacemos una segunda consulta para obtener los datos del cliente
  $nombreCliente = $datosOrden['cliente'];
  $sql2 = "SELECT cedula, cel, ciudad, dir FROM clientes WHERE nombre = '$nombreCliente'";
  $resultado2 = $conexion->query($sql2);
  $datosCliente = $resultado2->fetch_assoc();

  
  $cliente=$datosOrden["cliente"];
  $responsable=$datosOrden["responsable"];
		 // Mostramos los datos correspondientes al cliente en los inputs de texto correspondientes
$cedula = $datosCliente["cedula"];
$cel = $datosCliente["cel"];
$ciudad = $datosCliente["ciudad"];
$dir = $datosCliente["dir"];
		
} else {
  // Si no encontramos los datos correspondientes a la orden, enviamos un mensaje de error
  echo 'No se encontraron datos para el número de orden ingresado';
}


// Cerramos la conexión a la base de datos
$conexion->close();
?>


<body>
 <br>
</br>

<hr style="height: 2px; border: none; background-color: black; margin-left: 10px; margin-right: 10px; ">


<form>


				
                <div class="full-width panel-content">
                    
                    <div class="mdl-grid">
                        <div class="row">
                                 <div  style="border: 1px solid black; padding: 4px;margin-left: 10px" class="col-sm-3">
                                 
                                 R.F: <?php echo  $responsable; ?>
                                  </div>
                                  <div class="col-sm-6">
                                   <img src="assets/img/nuevologo.jpeg" alt="LOGO" class="img-responsive">
                                   </div>
                         </div>
                         
                        <div class="row">
                                <div class="col-sm-1">
   
                               
                                   <h4 class="tittles">Cliente
                                    </h4> 
                                    
                                    <h4 class="tittles">Ciudad
                                       </h4>

                                  
                                        
                                      
                                </div>
                                <div class="col-sm-5">
                                <span class="text-condensedLight" style="text-decoration: underline; " type="text"><?php echo  $cliente; ?></span>
                                
                                <br>   <span class="text-condensedLight" style="text-decoration: underline;" type="text"><?php echo $ciudad; ?></span>
                                   
                                       

                                    
                                         

                                </div>

                                <div class="col-sm-1">
             
                                <h4 class="tittles">Cedula </h4>
                                
                                        <h4 class="tittles">Celular</h4>
                                          
                                    
                                </div>
                                <div class="col-sm-3">
                                 <span class="text-condensedLight" style="text-decoration: underline;"type="text"><?php echo  $cedula; ?></span>
                                 <br>   
                                 
                                <span class="text-condensedLight"style="text-decoration: underline;" type="text"><?php echo $cel; ?></span>
                                         
             </div>
             </div>
             <div class="row">
             <div class="col-sm-1">

                     <h4 class="tittles">Direccion</h4>
                     <br>
                     <h4 class="tittles">Presentacion</h4>
             </div>
             <div class="col-sm-10">
                                       <span class="text-condensedLight"style="text-decoration: underline;" type="text"><?php echo $dir; ?></span>
                                       <br>
                                       <br><br>
                                       <span class="text-condensedLight"><hr style="height: 1px; background-color: black; margin-left: 10px; margin-right: 0px; ">
</span> </div>     
                    </div>
                    <div class="col-sm-6">
                                   <img src="assets/img/fragil.jpeg" alt="LOGO" class="img-responsive"style="margin-left: 150px; ">
                                   </div>
                                   </div> </div> </div></form><br>
                                   <hr style="height: 2px; border: none; background-color: black; margin-left: 10px; margin-right: 10px; ">

                                   
</br>

<hr style="height: 2px; border: none; background-color: black; margin-left: 10px; margin-right: 10px; ">


<form>


				
                <div class="full-width panel-content">
                    
                    <div class="mdl-grid">
                        <div class="row">
                                 <div  style="border: 1px solid black; padding: 4px;margin-left: 10px" class="col-sm-3">
                                 
                                 R.F: <?php echo  $responsable; ?>
                                  </div>
                                  <div class="col-sm-6">
                                   <img src="assets/img/nuevologo.jpeg" alt="LOGO" class="img-responsive">
                                   </div>
                         </div>
                         
                        <div class="row">
                                <div class="col-sm-1">
   
                               
                                   <h4 class="tittles">Cliente
                                    </h4> 
                                    
                                    <h4 class="tittles">Ciudad
                                       </h4>

                                  
                                        
                                      
                                </div>
                                <div class="col-sm-5">
                                <span class="text-condensedLight" style="text-decoration: underline; " type="text"><?php echo  $cliente; ?></span>
                                
                                <br>   <span class="text-condensedLight" style="text-decoration: underline;" type="text"><?php echo $ciudad; ?></span>
                                   
                                       

                                    
                                         

                                </div>

                                <div class="col-sm-1">
             
                                <h4 class="tittles">Cedula </h4>
                                
                                        <h4 class="tittles">Celular</h4>
                                          
                                    
                                </div>
                                <div class="col-sm-3">
                                 <span class="text-condensedLight" style="text-decoration: underline;"type="text"><?php echo  $cedula; ?></span>
                                 <br>   
                                 
                                <span class="text-condensedLight"style="text-decoration: underline;" type="text"><?php echo $cel; ?></span>
                                         
             </div>
             </div>
             <div class="row">
             <div class="col-sm-1">

                     <h4 class="tittles">Direccion</h4>
                     <br>
                     <h4 class="tittles">Presentacion</h4>
             </div>
             <div class="col-sm-10">
                                       <span class="text-condensedLight"style="text-decoration: underline;" type="text"><?php echo $dir; ?></span>
                                       <br>
                                       <br><br>
                                       <span class="text-condensedLight"><hr style="height: 1px; background-color: black; margin-left: 10px; margin-right: 0px; ">
</span> </div>     
                    </div>
                    <div class="col-sm-6">
                                   <img src="assets/img/fragil.jpeg" alt="LOGO" class="img-responsive"style="margin-left: 150px; ">
                                   </div>
                                   </div> </div> </div></form><br>
                                   <hr style="height: 2px; border: none; background-color: black; margin-left: 10px; margin-right: 10px; ">


</body>

</html> 

<?php
$html=ob_get_clean();
 //echo $html; 

 // include autoloader
// include autoloader
require_once 'dompdf/autoload.inc.php';
// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();


$options = $dompdf->getOptions();

$options->setIsRemoteEnabled(true);

$options->setChroot(__DIR__);
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('letter');
//$dompdf->setPaper('A4', 'landscape');
// Render the HTML as PDF
$dompdf->render();
$pdf_content = $dompdf->output();
// Definir el nombre del archivo con una variable
$nombre_archivo = $numeroOrden;
$file_path = "../sfi/guias de despacho/{$nombre_archivo}.pdf";
// Guardar el PDF en la carpeta "ordenes de despacho" con el nombre de la variable
file_put_contents($file_path, $pdf_content);
// Redirigir a la página "home.php"

// Redirigir a la página "home.php"
header("Location: historial_o.php");
exit;

?>