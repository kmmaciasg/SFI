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

<script>
    function cargarDatos() {
  // obtener el último número de orden de la tabla o_despacho
  fetch("obtener_ultimo_numero_orden.php")
    .then(response => response.json())
    .then(data => {
      const numero_orden = data.numero_orden;
      
      // buscar los datos del último registro en la tabla pdf con ese número de orden
      fetch(`obtener_datos_pdf.php?numero_orden=${numero_orden}`)
        .then(response => response.json())
        .then(data => {
          // establecer los valores de los campos en el formulario HTML
          document.getElementById("numero_orden").textContent = data.numero_orden;
          document.getElementById("fecha").value = data.fecha;
          document.getElementById("opciones").value = data.cliente;
          document.getElementById("dir").value = data.direccion;
          document.getElementById("ciudad").value = data.ciudad;
          document.getElementById("email").value = data.email;
          document.getElementById("cajas").value = data.cajas;
          document.getElementById("pago").value = data.pago;
          document.getElementById("cedula").value = data.cedula;
          document.getElementById("cel").value = data.celular;
          document.getElementById("creador").value = data.creador;
          document.getElementById("responsable").value = data.responsable;
          document.getElementById("transportadora").value = data.transportadora;
          document.getElementById("Notas").value = data.notas;
          document.getElementById("embalaje").value = data.embalaje;
          actualizarTabla();
        })
        .catch(error => console.log(error));
    })
    .catch(error => console.log(error));
}
</script>
<script>
function actualizarTabla() {
    const numeroOrden = document.getElementById("numero_orden").value; // Obtener el número de orden ingresado por el usuario
const url = `actualizar_tabla.php?numero_orden=${numeroOrden}`; // Agregar el número de orden como parámetro en la URL
fetch(url)
    .then(response => response.text())
    .then(data => {
        // actualizar la tabla con la respuesta recibida
        document.getElementById("tabla-productos").innerHTML = data;
    })
    .catch(error => console.error(error));

}
</script>

</head>
<body onload="cargarDatos()">


<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
    <div class="mdl-grid">
    </div>
	<form>
            <div class="full-width panel mdl-shadow--2dp">
                <div class="full-width bg-primary text-center tittles">
                   ORDEN DE DESPACHO 
            	
                </div>
               	
				
                <div class="full-width panel-content">
                    
                    <div class="mdl-grid">
                        <div class="row">
                                 <div class="col-sm-5">
                                 <h5 class=" text-center">Cite - Barbosa - Santander - Colombia </h5>
                                 <h5 class="text-condensedLight text-center">Tel: 3212287588</h5>
    
                                 <h5 class="text-condensedLight text-center">
    NO. <span class="text-center" name="numero_orden" id="numero_orden" t></span>
</h5>

                                   </div>
                                  <div class="col-sm-5">
                                   <img src="assets/img/nuevologo.jpeg" alt="LOGO" class="img-responsive">
                                   </div>
                         </div>
                        <div class="row">
                                <div class="col-sm-5">
   
                                    <h6 class="text-condensedLight">Fecha
                                        <input type="date" name="fecha" id="fecha" class="mdl-textfield__input">
                                    </h6>

                                    <h6 class="text-condensedLight">Cliente
                                        <input class="mdl-textfield__input" type="text" name="opciones" id="opciones" >
                                    </h6>

                                    <h6 class="text-condensedLight">Direccion
                                        <input class="mdl-textfield__input" type="text"  name="dir" id="dir">
                                    </h6>
                                    <h6 class="text-condensedLight">Ciudad
                                        <input class="mdl-textfield__input" type="text"  name="ciudad" id="ciudad">
                                    </h6>
									<h6 class="text-condensedLight">Email
                                            <input class="mdl-textfield__input" type="text" name="email" id="email">
                                        </h6>

                                    <h6 class="text-condensedLight"># de Cajas
                                        <input class="mdl-textfield__input" type="number"  name="cajas" id="cajas" >
									</h6>
                                        
                                        <h6 class="text-condensedLight">Modo de Pago
                                        <input class="mdl-textfield__input" type="text" name="pago" id="pago">
                                    </h6>
                                </div>

                                <div class="col-sm-5">
             
                                      <h6 class="text-condensedLight">Cedula
                                        <input class="mdl-textfield__input" type="number" name="cedula" id="cedula">
                                    </h6>
                                    <h6 class="text-condensedLight">Celular
                                        <input class="mdl-textfield__input" type="number"  name="cel" id="cel">
                                    </h6>

                                    <h6 class="text-condensedLight">Creador
                                        <input class="mdl-textfield__input" type="text"  name="creador" id="creador">
                                    </h6>
                                    <h6 class="text-condensedLight">Responsable
                                        <input class="mdl-textfield__input" type="text"  name="responsable" id="responsable" >
                                    </h6>
                                    <h6 class="text-condensedLight">Transportadora
                                        <input class="mdl-textfield__input" type="text"  name="transportadora" id="transportadora">
                                    </h6>
                                        <h6 class="text-condensedLight">Notas
                                            <input class="mdl-textfield__input" type="text"  id="Notas">
                                        </h6>
                                        
                                    <h6 class="text-condensedLight">Embalaje
                                        <input class="mdl-textfield__input" type="text"  name="embalaje" id="embalaje">
                                    </h6>
                                </div>
                        </div>
                    </div>
                    <table id="tabla-productos" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive">
                                      <thead>
                                      <tr>
                                      </tr>
                                      </thead>
                                      <tbody>
                                        <!-- Aquí se mostrarán los productos -->
                                    </tbody>	
	              </table>
                       
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

// Output the generated PDF to Browser
$dompdf->stream("archivo_pdf", array("Attachment" => false));
?>
