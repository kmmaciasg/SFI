<?php
ob_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Orden Guardada</title>
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

// Realizar la consulta para obtener el último número de orden
$resultado = mysqli_query($conexion, "SELECT numero_orden FROM pdf WHERE id=(SELECT MAX(id) FROM pdf);
");

// Obtener el resultado de la consulta
if ($fila = mysqli_fetch_assoc($resultado)) {
  $ultimo_numero = $fila["numero_orden"];
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
<?php
$numeroOrden = $ultimo_numero;

// Realizamos la conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'lachila');

// Verificamos si hubo un error en la conexión
if ($conexion->connect_error) {
  die('Error en la conexión: ' . $conexion->connect_error);
}

// Realizamos la consulta a la base de datos para obtener los datos correspondientes a la orden
$sql = "SELECT cliente, fecha, cajas, pago, embalaje, creador, transportadora, responsable, notas FROM pdf WHERE numero_orden = '$numeroOrden'";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
  // Si encontramos los datos correspondientes a la orden, los enviamos como respuesta en formato JSON
  $datosOrden = $resultado->fetch_assoc();

  // Hacemos una segunda consulta para obtener los datos del cliente
  $nombreCliente = $datosOrden['cliente'];
  $sql2 = "SELECT cedula, cel, email, ciudad, dir FROM clientes WHERE nombre = '$nombreCliente'";
  $resultado2 = $conexion->query($sql2);
  $datosCliente = $resultado2->fetch_assoc();

  
  $cliente=$datosOrden["cliente"];
  $fecha = $datosOrden["fecha"];
  $cajas = $datosOrden["cajas"];
   $pago = $datosOrden["pago"];
 $embalaje = $datosOrden["embalaje"];
  $creador= $datosOrden["creador"];
 $transportadora = $datosOrden["transportadora"];
$responsable= $datosOrden["responsable"];
$notas=$datosOrden["notas"];
		 // Mostramos los datos correspondientes al cliente en los inputs de texto correspondientes
$cedula = $datosCliente["cedula"];
$cel = $datosCliente["cel"];
$email = $datosCliente["email"];
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
	<form>
            <div class="full-width panel mdl-shadow--2dp">
                <div class="full-width bg-primary text-center tittles">
                   ORDEN DE DESPACHO 
            	
                </div>
               	
				
                <div class="full-width panel-content">
                    
                    <div class="mdl-grid">
                        <div class="row">
                                 <div class="col-sm-5">
                                 <h4 class=" text-center">Cite - Barbosa - Santander - Colombia </h4>
                                 <h4 class="text-condensedLight text-center">Tel: 3212287588</h4>
    
                                 <h4  class="tittles text-center"> NO.
                                 <spam  class="tittles" type="text" name="numero_orden" id="numero_orden" ><?php echo $ultimo_numero; ?></spam>
                                 </h4> </div>
                                  <div class="col-sm-5">
                                   <img src="assets/img/nuevologo.jpeg" alt="LOGO" class="img-responsive">
                                   </div>
                         </div>
                         
                        <div class="row">
                                <div class="col-sm-3">
   
                                <h5 class="tittles" style="margin-bottom: -10px;">Fecha</h5>

                                   <span class="text-condensedLight" type="text"><?php echo $fecha; ?></span>
                                   
                                   <h5 class="tittles"style="margin-bottom: -10px;">Cliente
                                    </h5> <span class="text-condensedLight" type="text"><?php echo  $cliente; ?></input>
                                   

                                    <h5 class="tittles"style="margin-bottom: -10px;">Direccion
                                         </h5> <span class="text-condensedLight" type="text"><?php echo $dir; ?></input>
                                         
                                         <h5 class="tittles" style="margin-bottom: -10px;">Cedula
                                         </h5> <span class="text-condensedLight" type="text"><?php echo  $cedula; ?></input>
                                         
                                        
                                      
                                </div>
                                <div class="col-sm-2">
                                    <h5 class="tittles" style="margin-bottom: -10px;">Ciudad
                                       </h5>
                                       <span class="text-condensedLight" type="text"><?php echo $ciudad; ?></input>
                                   
									<h5 class="tittles" style="margin-bottom: -10px;">Email
                                          </h5>
                                          <span class="text-condensedLight" type="text"><?php echo $email; ?></input>
                                          <h5 class="tittles"  style="margin-bottom: -10px;">Celular
                                         </h5> <span class="text-condensedLight" type="text"><?php echo $cel; ?></input>
                                         

                                    <h5 class="tittles" style="margin-bottom: -10px;"># de Cajas
                                      </h5> <span class="text-condensedLight" type="text"><?php echo $cajas; ?></input>
                                   
                                       
                                         

                                </div>

                                <div class="col-sm-2">
             
                                <h5 class="tittles" style="margin-bottom: -10px;">Transportadora
                                         </h5> <span class="text-condensedLight" type="text"><?php echo $transportadora; ?></input>
                                   
                                         <h5 class="tittles" style="margin-bottom: -10px;">Creador
                                         </h5> <span class="text-condensedLight" type="text"><?php echo $creador; ?></input>
                                   
                                         <h5 class="tittles" style="margin-bottom: -10px;">Responsable
                                         </h5> <span class="text-condensedLight" type="text"><?php echo $responsable; ?></input>
                                         <h5 class="tittles" style="margin-bottom: -10px;">Embalaje
                                         </h5> <span class="text-condensedLight" type="text"><?php echo $embalaje; ?></input>
                                        
                                    
                                </div>
                                <div class="col-sm-2">
                                     
                                <h5 class="tittles" style="margin-bottom: -10px;">Modo de Pago
                                         </h5> <span class="text-condensedLight" type="text"><?php echo $pago; ?></input>
                                         <h5 class="tittles" style="margin-bottom: -10px;">Notas
                                         </h5> <span class="text-condensedLight" type="text"><?php echo  $notas; ?></input>
                                    
             </div>
                        </div>
                    </div>
                    <?php
include 'conexion_db.php'; 
$numero_orden = $ultimo_numero;
// Consulta para seleccionar los datos de la tabla "ordenes_despacho"
$sql2 = "SELECT codigo, producto, cantidad, lv, lc FROM ordenes_despacho WHERE numero_orden = '$numero_orden'";
$result = $conexion->query($sql2);

// código para generar la tabla

echo " <div class='row'>
<div class='col-sm-11'>
<table id='tabla-productos' class='mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive'>
      <tr>
      <th class='mdl-data-table'style='text-align: center;'>Código</th>
      <th class='mdl-data-table'style='text-align: center;'>Producto</th>
      <th class='mdl-data-table'style='text-align: center;'>Cantidad</th>
      <th class='mdl-data-table'style='text-align: center;'>LV</th>
      <th class='mdl-data-table'style='text-align: center;'>LC</th>
      </tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td style='text-align:center'>" . $row["codigo"]. "</td>
          <td style='text-align:center'>" . $row["producto"]. "</td>
          <td style='text-align:center'>" . $row["cantidad"]. "</td>
          <td style='text-align:center'>" . $row["lv"]. "</td>
          <td style='text-align:center'>" . $row["lc"]. "</td></tr>";
}
echo "</table>";
?>
 
                       
                </div>
            </div>
	</form>
</div>

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
$nombre_archivo = $ultimo_numero;
$file_path = "../sfi/ordenes de despacho/{$nombre_archivo}.pdf";

// Guardar el PDF en la carpeta "ordenes de despacho" con el nombre de la variable
file_put_contents($file_path, $pdf_content);
// Redirigir a la página "home.php"

// Redirigir a la página "home.php"
header("Location: home.php");
exit;

?>
