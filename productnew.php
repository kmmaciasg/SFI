<?php

$conexion = mysqli_connect ("localhost", "root", "", "lachila" ); 
session_start(); // Iniciar sesión
    if(isset($_SESSION['nombre_usuario'])){ // Comprobar si se ha iniciado sesión
        $nombre_usuario = $_SESSION['nombre_usuario']; // Obtener el nombre de usuario guardado en la sesión
        $apellido_usuario = $_SESSION['apellido_usuario']; // Obtener el apellido de usuario guardado en la sesión
       
		
// Concatenar el nombre y apellido en una sola cadena de texto
$nombre_completo = $nombre_usuario . " " . $apellido_usuario;
    } else {
        header("Location: index.php"); // Si no se ha iniciado sesión, redirigir al inicio de sesión
		
    }

	// verificar si el usuario tiene permiso para acceder a esta página
	$permiso = 'agregar nueva produccion';
	$permisos_usuariop = obtener_permisos_usuariop($nombre_completo);
	if (!in_array($permiso, $permisos_usuariop)) {
	  // el usuario no tiene permiso, redirigir a la página de inicio y mostrar mensaje de error
	  // Imprimir mensaje
  echo "Para realizar esta accion se requieren permisos especiales ";

  header("refresh:3;url=home.php");

  // Redirigir al usuario a la página de inicio
  exit;
	}
	
?>
<!DOCTYPE html>
<html lang="es">
<head>
	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Nueva Produccion</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/sweetalert2.css">
	<link rel="stylesheet" href="css/material.min.css">
	<link rel="stylesheet" href="css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="css/main.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')</script>
	<script src="js/material.min.js" ></script>
	<script src="js/sweetalert2.min.js" ></script>
	<script src="js/jquery.mCustomScrollbar.concat.min.js" ></script>
	<script src="js/main.js" ></script>
	<script>
        $(document).ready(function() {
            // Agregamos el evento click al botón
            $("#modificar").click(function() {
				event.preventDefault()
                // Pedimos al usuario el ID del lote
                var id_lote = prompt("Introduce el # del lote a buscar:");

                // Realizamos la petición AJAX para buscar el lote
                $.ajax({
                    url: "buscar_lote.php",
                    type: "POST",
                    data: {id_lote: id_lote},
                    dataType: "json",
                    success: function(resultado) {
                        // Mostramos la ventana emergente con los datos del lote
                        $("#ventana-emergente").show();

                        // Llenamos los campos de la ventana emergente con los datos del lote
                        $("#id_lote").val(resultado.id);
                        $("#materia").val(resultado.Materia);
                        $("#fecha_inicio").val(resultado.fecha_inicio);
                        $("#peso_inicial").val(resultado.peso_inicial);
                        $("#peso_neto").val(resultado.peso_neto);
                        $("#p_desperdicio").val(resultado.p_desperdicio);
                        $("#adicion").val(resultado.adicion);
                        $("#cantidad").val(resultado.Cantidad);
                        $("#usuario").val(resultado.Usuario);
                        $("#loteagua").val(resultado.loteagua);
                    },
                    error: function() {
                        alert("Error al buscar el lote");
                    }
                });
            });
			// Agregamos el evento click al botón de guardar cambios
            $("#btn-guardar-cambios").click(function() {
                // Obtenemos los datos de la ventana emergente
                var id_lote = $("#id_lote").val();
                var materia = $("#materia").val();
                var fecha_inicio = $("#fecha_inicio").val();
                var peso_inicial = $("#peso_inicial").val();
                var peso_neto = $("#peso_neto").val();
                var p_desperdicio = $("#p_desperdicio").val();
                var adicion = $("#adicion").val();
                var cantidad = $("#cantidad").val();
                var usuario = $("#usuario").val();
				var loteagua = $("#loteagua").val();

// Realizamos la petición AJAX para guardar los cambios en la base de datos
$.ajax({
	url: "guardar_cambios.php",
	type: "POST",
	data: {
		id_lote: id_lote,
		materia: materia,
		fecha_inicio: fecha_inicio,
		peso_inicial: peso_inicial,
		peso_neto: peso_neto,
		p_desperdicio: p_desperdicio,
		adicion: adicion,
		cantidad: cantidad,
		usuario: usuario,
		loteagua: loteagua
	},
	success: function() {
		alert("Los cambios se han guardado correctamente");
		$("#ventana-emergente").hide();
	},
	error: function() {
		alert("Error al guardar los cambios");
	}
});
});
});
</script>

</head>
<body>
<?php
include 'conexion_db.php';

// Consulta SQL para obtener los datos
$sql = "SELECT nombre FROM materias";

// Ejecutar la consulta
$resultado = mysqli_query($conexion, $sql);
// Variable para contar el número de notificaciones no leídas
    $num_notificaciones = 0;
    ?>

    <!-- Notifications area -->
<section class="full-width container-notifications">
    <div class="full-width container-notifications-bg btn-Notification">

    </div>
	
    <section class="NotificationArea">
        <div class="full-width text-center NotificationArea-title tittles">Notificaciones <i class="zmdi zmdi-close btn-Notification"></i></div>
        <a href="#" class="Notification" id="notifation-unread-1">
            <div class="Notification-icon"><i class="zmdi zmdi-alert-triangle bg-info"></i></div>
            <div class="Notification-text">
                <?php
                // Crear una consulta SQL para seleccionar los productos con cantidad menor a 250
                $sql4 = "SELECT * FROM productos WHERE Cantidad < 250";

                // Ejecutar la consulta
                $resultado4 = $conexion->query($sql4);

                // Verificar si hay resultados
                if ($resultado4->num_rows > 0) {
                  // Si hay resultados, imprimir el mensaje en negrita y aumentar el número de notificaciones no leídas
                  echo '<p><strong>Productos terminados con stock menor a 250</strong></p>';
                  $num_notificaciones++;
                } else {
                  // Si no hay resultados, no imprimir nada
                }
                ?>
            </div>
            <div class="mdl-tooltip mdl-tooltip--left" for="notifation-unread-1">Notification no leida</div> 
        </a>  
		<a href="#" class="Notification" id="notifation-unread-2">
            <div class="Notification-icon"><i class="zmdi zmdi-alert-triangle bg-info"></i></div>
            <div class="Notification-text">
                <?php
                // Crear una consulta SQL para seleccionar los productos con cantidad menor a 250
                $sql5 = "SELECT * FROM bandas WHERE cant < 250";

                // Ejecutar la consulta
                $resultado5 = $conexion->query($sql5);

                // Verificar si hay resultados
                if ($resultado5->num_rows > 0) {
                  // Si hay resultados, imprimir el mensaje en negrita y aumentar el número de notificaciones no leídas
                  echo '<p><strong>Bandas de seguridad con stock menor a 250</strong></p>';
                  $num_notificaciones++;
                } else {
                  // Si no hay resultados, no imprimir nada
                }
                ?>
            </div>
            <div class="mdl-tooltip mdl-tooltip--left" for="notifation-unread-2">Notification no leida</div> 
        </a>       
		<a href="#" class="Notification" id="notifation-unread-3">
            <div class="Notification-icon"><i class="zmdi zmdi-alert-triangle bg-info"></i></div>
            <div class="Notification-text">
                <?php
                // Crear una consulta SQL para seleccionar los productos con cantidad menor a 250
                $sql6 = "SELECT * FROM colgantes WHERE cant < 250";

                // Ejecutar la consulta
                $resultado6 = $conexion->query($sql6);

                // Verificar si hay resultados
                if ($resultado6->num_rows > 0) {
                  // Si hay resultados, imprimir el mensaje en negrita y aumentar el número de notificaciones no leídas
                  echo '<p><strong>Colgantes con stock menor a 250</strong></p>';
                  $num_notificaciones++;
                } else {
                  // Si no hay resultados, no imprimir nada
                }
                ?>
            </div>
            <div class="mdl-tooltip mdl-tooltip--left" for="notifation-unread-3">Notification no leida</div> 
        </a> 
		<a href="#" class="Notification" id="notifation-unread-4">
            <div class="Notification-icon"><i class="zmdi zmdi-alert-triangle bg-info"></i></div>
            <div class="Notification-text">
                <?php
                // Crear una consulta SQL para seleccionar los productos con cantidad menor a 250
                $sql7 = "SELECT * FROM embalaje WHERE cant < 100";

                // Ejecutar la consulta
                $resultado7 = $conexion->query($sql7);

                // Verificar si hay resultados
                if ($resultado7->num_rows > 0) {
                  // Si hay resultados, imprimir el mensaje en negrita y aumentar el número de notificaciones no leídas
                  echo '<p><strong>Embalajes con stock menor a 100</strong></p>';
                  $num_notificaciones++;
                } else {
                  // Si no hay resultados, no imprimir nada
                }
                ?>
            </div>
            <div class="mdl-tooltip mdl-tooltip--left" for="notifation-unread-4">Notification no leida</div> 
        </a>
		<a href="#" class="Notification" id="notifation-unread-5">
            <div class="Notification-icon"><i class="zmdi zmdi-alert-triangle bg-info"></i></div>
            <div class="Notification-text">
                <?php
                // Crear una consulta SQL para seleccionar los productos con cantidad menor a 250
                $sql8 = "SELECT * FROM etiquetas WHERE cant < 250";

                // Ejecutar la consulta
                $resultado8 = $conexion->query($sql8);

                // Verificar si hay resultados
                if ($resultado8->num_rows > 0) {
                  // Si hay resultados, imprimir el mensaje en negrita y aumentar el número de notificaciones no leídas
                  echo '<p><strong>Etiquetas con stock menor a 250</strong></p>';
                  $num_notificaciones++;
                } else {
                  // Si no hay resultados, no imprimir nada
                }
                ?>
            </div>
            <div class="mdl-tooltip mdl-tooltip--left" for="notifation-unread-5">Notification no leida</div> 
        </a>  
		<a href="#" class="Notification" id="notifation-unread-6">
            <div class="Notification-icon"><i class="zmdi zmdi-alert-triangle bg-info"></i></div>
            <div class="Notification-text">
                <?php
                // Crear una consulta SQL para seleccionar los productos con cantidad menor a 250
                $sql9 = "SELECT * FROM envases WHERE Cantidad < 250";

                // Ejecutar la consulta
                $resultado9 = $conexion->query($sql9);

                // Verificar si hay resultados
                if ($resultado9->num_rows > 0) {
                  // Si hay resultados, imprimir el mensaje en negrita y aumentar el número de notificaciones no leídas
                  echo '<p><strong>Envases con stock menor a 250</strong></p>';
                  $num_notificaciones++;
                } else {
                  // Si no hay resultados, no imprimir nada
                }
                ?>
            </div>
            <div class="mdl-tooltip mdl-tooltip--left" for="notifation-unread-6">Notification no leida</div> 
        </a> 
		<a href="#" class="Notification" id="notifation-unread-7">
            <div class="Notification-icon"><i class="zmdi zmdi-alert-triangle bg-info"></i></div>
            <div class="Notification-text">
                <?php
                // Crear una consulta SQL para seleccionar los productos con cantidad menor a 250
                $sqll = "SELECT * FROM tapas WHERE cantidad < 250";

                // Ejecutar la consulta
                $resultadol = $conexion->query($sqll);

                // Verificar si hay resultados
                if ($resultadol->num_rows > 0) {
                  // Si hay resultados, imprimir el mensaje en negrita y aumentar el número de notificaciones no leídas
                  echo '<p><strong>Tapas con stock menor a 250</strong></p>';
                  $num_notificaciones++;
                } else {
                  // Si no hay resultados, no imprimir nada
                }
                ?>
            </div>
            <div class="mdl-tooltip mdl-tooltip--left" for="notifation-unread-7">Notification no leida</div> 
        </a>                                
    </section>
</section>

<!-- navLateral -->

<div class="full-width navBar">
		<div class="full-width navBar-options">
			<i class="zmdi zmdi-more-vert btn-menu" id="btn-menu"></i>	
			<div class="mdl-tooltip" for="btn-menu">Menu</div>
			<nav class="navBar-options-list">
				<ul class="list-unstyle">
					<li class="btn-Notification" id="notifications"> 
						<i class="zmdi zmdi-notifications"> <?php if ($num_notificaciones > 0) { ?>
    <span class="Notification-number"><?php echo $num_notificaciones; ?></span>
  <?php } ?></i>
						<!-- <i class="zmdi zmdi-notifications-active btn-Notification" id="notifications"></i> -->
						<div class="mdl-tooltip" for="notifications">Notificaciones</div>
					</li>
					<li class="btn-exit" id="btn-exit">
						<i class="zmdi zmdi-power"></i>
						<div class="mdl-tooltip" for="btn-exit">Salir</div>
					</li>
					<li class="text-condensedLight noLink" ><small> <?php echo htmlspecialchars($nombre_completo); ?></small></li>
					<li class="noLink">
						<figure>
							<img src="assets/img/avatar-male2.png" alt="Avatar" class="img-responsive">
						</figure>
					</li>
				</ul>
			</nav>
		</div>
	</div>
	<!-- navLateral -->
	<section class="full-width navLateral">
		<div class="full-width navLateral-bg btn-menu"></div>
		<div class="full-width navLateral-body">
			<div class="full-width navLateral-body-logo text-center tittles">
				<i class="zmdi zmdi-close btn-menu"></i> Inventario
			</div>
			<figure class="full-width" style="height: 77px;">
				<div class="navLateral-body-cl">
					<img src="assets/img/avatar-male.png" alt="Avatar" class="img-responsive">
				</div>
				<figcaption class="navLateral-body-cr hide-on-tablet">
					<span>
					<span>Usuario: <?php echo htmlspecialchars($nombre_completo); ?><br>
					</span>
				</figcaption>
			</figure>
			<nav class="full-width">
				<ul class="full-width list-unstyle menu-principal">
					<li class="full-width">
						<a href="home.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-home"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								INICIO
							</div>
						</a>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="#!" class="full-width btn-subMenu">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-hospital-alt"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								PRODUCCION
							</div>
							<span class="zmdi zmdi-chevron-left"></span>
						</a>
						<ul class="full-width menu-principal sub-menu-options">
							<li class="full-width">
								<a href="productnew.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-hospital-alt"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Nueva Produccion
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="product1.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-label"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Producciones en Fase 1
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="product2.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-label"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Producciones en Fase 2
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="product3.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-label"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Producciones en Envasado
									</div>
								</a>
							</li>
						</ul>
					</li>
					
					<li class="full-width divider-menu-h"></li>
					 <li class="full-width">
							 <a href="parametros.php" class="full-width">
							 <div class="navLateral-body-cl">
								<i class="zmdi zmdi-cocktail"></i>
							 </div>
							 <div class="navLateral-body-cr hide-on-tablet">
								PARAMETROS
							 </div>
						     </a>
					    </li>
                    </li>
					<li class="full-width divider-menu-h"></li>
					    <li class="full-width">
						    <a href="ADMIN.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-face"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								ADMINISTRACION
							</div>  
						    </a>
						</li>		
					</li>	
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="#!" class="full-width btn-subMenu">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-camera-switch"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								INGRESOS Y SALIDAS
							</div>
							<span class="zmdi zmdi-chevron-left"></span>
						</a>
						<ul class="full-width menu-principal sub-menu-options">
							<li class="full-width">
						    <a href="producfin.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-assignment-check"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								Producto Terminado
							</div>
						    </a>
							</li>
							<li class="full-width">
						     <a href="envases.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-battery"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								Envases
							</div>
						    </a>
					        </li>
							<li class="full-width">
						    <a href="embalaje.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-card-giftcard"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								Embalaje
							</div>
						    </a>
					        </li>
							<li class="full-width">
						    <a href="etiquetas.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-file"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								Etiquetas
							</div>
						    </a>
					        </li>
							<li class="full-width">
						    <a href="colgantes.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-receipt"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								Colgantes
							</div>
						    </a>
					        </li>
							<li class="full-width">
						    <a href="tapas.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-album"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								Tapas
							</div>
						    </a>
					        </li>
							<li class="full-width">
						    <a href="bandas.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-check-all"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								Bandas de Seguridad
							</div>
						    </a>
					        </li>
						</ul>
					</li>
	
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="#!" class="full-width btn-subMenu">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-file-text"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								INVENTARIOS
							</div>
							<span class="zmdi zmdi-chevron-left"></span>
						</a>
						<ul class="full-width menu-principal sub-menu-options">
							<li class="full-width">
								<a href="inventario_pt.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-file-text"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Producto Terminado
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="inventario_e.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-file-text"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Envases y Embalaje
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="inventario_ec.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-file-text"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Etiquetas y Colgantes
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="inventario_tb.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-file-text"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Tapas y Bandas
									</div>
								</a>
							</li>
						</ul>	
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="#!" class="full-width btn-subMenu">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-window-maximize"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								HISTORIAL
							</div>
							<span class="zmdi zmdi-chevron-left"></span>
						</a>
						<ul class="full-width menu-principal sub-menu-options">
							<li class="full-width">
								<a href="historial_pl.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-window-maximize"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Producto Terminado y Lotes
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="historial_e.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-window-maximize"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Envases y Embalaje
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="Historial_ec.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-window-maximize"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Etiquetas y Colgantes
									</div>
								</a>
							</li>
							<li class="full-width">
                            <a href="Historial_tb.php" class="full-width">
                                <div class="navLateral-body-cl">
                                    <i class="zmdi zmdi-window-maximize"></i>
                                </div>
                                <div class="navLateral-body-cr hide-on-tablet">
                                    Tapas y Bandas
                                </div>
                            </a>
                        </li>
                        <li class="full-width">
                            <a href="Historial_ep.php" class="full-width">
                                <div class="navLateral-body-cl">
                                    <i class="zmdi zmdi-window-maximize"></i>
                                </div>
                                <div class="navLateral-body-cr hide-on-tablet">
                                    Envasado y Parametros
                                </div>
                            </a>
                        </li>
						</ul>	
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="#!" class="full-width btn-subMenu">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-calendar-note"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								PEDIDOS
							</div>
							<span class="zmdi zmdi-chevron-left"></span>
						</a>
						<ul class="full-width menu-principal sub-menu-options">
							<li class="full-width">
								<a href="generar_o.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-calendar-note"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Generar Orden Despacho
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="completar_o.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-calendar-note"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Completar Orden Despacho
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="reparto.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-calendar-note"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Pedidos en Reparto
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="historial_o.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-calendar-note"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Historial Orden Despacho
									</div>
								</a>
							</li>
						</ul>
					</li>
					
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="#!" class="full-width btn-subMenu">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-truck"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								RUTA
							</div>
							<span class="zmdi zmdi-chevron-left"></span>
						</a>
						<ul class="full-width menu-principal sub-menu-options">
							<li class="full-width">
								<a href="generar_r.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-truck"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Generar Ruta
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="completar_r.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-truck"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Completar Ruta
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="historial_r.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-truck"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Historial Rutas
									</div>
								</a>
							</li>
						</ul>
							
					<li class="full-width divider-menu-h"></li>
					 <li class="full-width">
							 <a href="Facturacion.php" class="full-width">
							 <div class="navLateral-body-cl">
								<i class="zmdi zmdi-assignment-check"></i>
							 </div>
							 <div class="navLateral-body-cr hide-on-tablet">
								FACTURACION
							 </div>
						     </a>
					    </li>
                    </li>
					</li>
				</ul>	
			</nav>
		</div>
	</section>

	<!-- pageContent -->
	<section class="full-width pageContent">
		<section class="full-width header-well">
			<div class="full-width header-well-icon">
				<figure class="full-width">
						<img src="assets/img/nuevologo.jpeg" alt="LOGO" class="img-responsive">
				</figure>
				<div class="full-width header-well-text">
				<p class="text-condensedLight">
					 NUEVA PRODUCCION
				</p>
			</div>						
	</section>
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
			<div class="mdl-tabs__tab-bar">
				<a href="#tabNewProduct" class="mdl-tabs__tab is-active">AGREGAR NUEVA PRODUCCION</a>
				<a href="#tabNewMateria" class="mdl-tabs__tab">AGREGAR MATERIAS PRIMAS</a>
			</div>
			<div class="mdl-tabs__panel is-active" id="tabNewProduct">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-primary text-center tittles">
								Nueva Producción 
							</div>
							<div class="full-width panel-content">
								<form action= "nuevaproduccion.php" method="POST">
									<div class="mdl-grid">
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
										
										<label for="fecha">Fecha de Producción:</label>
										<input type="date" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" />


											
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input"  type="number" step="0.0000001" oninput="calcularPesoNeto()" name="PesoInicial" id="PesoInicial">
												<label class="mdl-textfield__label" for="PesoInicial">Peso Inicial Kg</label>
												<span class="mdl-textfield__error">Peso Invalido</span>
											</div>
												
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="number" step="0.0000001" oninput="calcularPesoNeto()" name="PesoDesperdicio" id="PesoDesperdicio">
												<label class="mdl-textfield__label" for="PesoDesperdicio">Peso Desperdicio Kg</label>
												<span class="mdl-textfield__error">Peso Invalido</span>
											</div>
											
											<h6 class="text-condensedLight">Peso Neto: 
												<input class="mdl-textfield__input" type="number" step="0.0000001" name="PesoNeto" id="PesoNeto" readonly>
											</h6>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text" name="Adiciones" id="Adiciones">
												<label class="mdl-textfield__label" for="Adiciones">Adiciones</label>
												<span class="mdl-textfield__error">Adicion Invalida</span>
											</div>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="number" step="0.0000001"name="Cantidad" id="Cantidad">
												<label class="mdl-textfield__label" for="Cantidad">Cantidad en L</label>
												<span class="mdl-textfield__error">Peso Invalido</span>
											</div>
										</div>
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
											
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text" name="#lote" id="#lote">
												<label class="mdl-textfield__label" for="#lote">Número de Lote</label>
												<span class="mdl-textfield__error">Número de lote invalido</span>
											</div>
												<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="number"  name="#loteagua" id="#loteagua">
												<label class="mdl-textfield__label" for="#loteagua">Lote Agua</label>
												<span class="mdl-textfield__error">Número de lote invalido</span>
											</div>
											<h6 class="text-condensedLight">Selecciona la materia prima
												
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable" style="text-align: center;">
    <label class="mdl-button mdl-js-button mdl-button--icon" for="filtro_nombre" >
      <i class="zmdi zmdi-search"></i>
    </label>
    <div class="mdl-textfield__expandable-holder">
      <input class="mdl-textfield__input" type="text" id="filtro_nombre" onkeyup="filtrarTabla()" placeholder="Buscar..."  onkeydown="if (event.keyCode === 13) {detenerEnvioFormulario();}">
      <label class="mdl-textfield__label" for="filtro_nombre"></label>
    </div>
  </div>
											</h6>
												<?php
												 echo "<select name='opciones' id='opciones'>";
												 echo "<option value='' selected></option>"; // Agregar opción inicial vacía
												 while ($fila = mysqli_fetch_assoc($resultado)) {
												   echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
												 }
												 echo "</select>";
										    ?>
										
					
											<h6 class="text-condensedLight">Usuario:  
											<input class="mdl-textfield__input" type="text" name="Empleado" id="Empleado" value="<?php echo $nombre_completo ?>" readonly>
											</h6>
                                                
											
										</div>
									</div>
									<p class="text-center">
										<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" type="submit" onclick="pasarfase1()" id="guardar">
											<i class="zmdi zmdi-plus"></i>
										<div class="mdl-tooltip" for="guardar">Agregar Produccion</div>
										</button>
										<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" type="submit" id="modificar" >
											<i class="zmdi zmdi-refresh"></i>
										<div class="mdl-tooltip" for="modificar">Modificar Produccion</div>
										</button>
									</p>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="ventana-emergente" style="display: none;">
			<div class="mdl-grid">
			<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
										
    <h6>Modificar lote</h6>
    <form>
        <label >ID:</label>
        <input type="text" id="id_lote" readonly><br>

        <label>Materia:</label>
        <input type="text" id="materia"><br>

        <label>Fecha de inicio:</label>
        <input type="date" id="fecha_inicio"><br>

        <label>Peso inicial:</label>
        <input type="number" id="peso_inicial"><br>

        <label>Peso neto:</label>
        <input type="number" id="peso_neto"><br>

        <label>Porcentaje de desperdicio:</label>
        <input type="number" id="p_desperdicio"><br>

        <label>Adición:</label>
        <input type="text" id="adicion"><br>

        <label>Cantidad:</label>
        <input type="number" id="cantidad"><br>

        <label>Usuario:</label>
        <input type="text" id="usuario"  readonly><br>

        <label>Lote de agua:</label>
        <input type="text" id="loteagua"><br>

        <button class="mdl-button mdl-js-button mdl-button--rised mdl-js-ripple-effect mdl-button--colored bg-primary" type="button" id="btn-guardar-cambios">Guardar cambios</button>
    </form>
</div>
			</div></div>
			<div class="mdl-tabs__panel" id="tabNewMateria">
					<div class="mdl-grid">
						<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
							<div class="full-width panel mdl-shadow--2dp">
								<div class="full-width panel-tittle bg-primary text-center tittles">
									Nueva Materia Prima 
								</div>
								<div class="full-width panel-content">
									<form action= "nuevamateria.php" method="POST">
										<div class="mdl-grid">
											<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
												<h5 class="text-condensedLight">Nombre de la Materia Prima</h5>
												<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
													<input class="mdl-textfield__input" type="text"  name="MateriaPrima2"id="MateriaPrima2">
													<label class="mdl-textfield__label" for="MateriaPrima2">Materia Prima</label>
													<span class="mdl-textfield__error">Nombre invalido</span>
												</div>
											</div>
											<p class="text-center">
												<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" type="submit" id="AgregarMateria">
													<i class="zmdi zmdi-plus"></i>
												</button>
												<div class="mdl-tooltip" for="AgregarMateria">Agregar Materia Prima</div>
											</p>
										</div>	
									</form>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</section>
	<script>
    function detenerEnvioFormulario() {
		event.preventDefault()
    }
  </script>
	<script>// JavaScript
const listaProductos = document.getElementById("opciones");
const filtroNombre = document.getElementById("filtro_nombre");

function filtrarLista() {
  const filtro = filtroNombre.value.toUpperCase(); // Obtener el valor del campo de texto y convertirlo a mayúsculas
  const opciones = listaProductos.options; // Obtener las opciones de la lista

  for (let i = 0; i < opciones.length; i++) {
    const opcion = opciones[i];
    const valor = opcion.value.toUpperCase(); // Obtener el valor de la opción y convertirlo a mayúsculas

    if (valor.includes(filtro)) {
      opcion.style.display = "block"; // Mostrar la opción si el valor coincide con el filtro
    } else {
      opcion.style.display = "none"; // Ocultar la opción si el valor no coincide con el filtro
    }
  }
}

listaProductos.addEventListener("change", filtrarLista); // Agregar evento onchange para la lista desplegable
filtroNombre.addEventListener("input", filtrarLista); // Agregar evento input para el campo de texto

</script>
	<script>
function pasarfase1() {

  var pesoinicial = document.getElementById("PesoInicial").value;
  var fecha = document.getElementById("fecha").value;
  var pesodesperdicio = document.getElementById("PesoDesperdicio").value;
  var pesoneto = document.getElementById("PesoNeto").value;
  var adiciones= document.getElementById("Adiciones").value;
  var lote = document.getElementById("#lote").value;
  var loteagua = document.getElementById("#loteagua").value;
  var empleado = document.getElementById("Empleado").value;
  var cantidad = document.getElementById("Cantidad").value;
  var materia = document.getElementById("opciones").value;


  // Creamos un objeto XMLHttpRequest para enviar los datos a actualizarinventario.php
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("POST", "pasarfase1.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("PesoInicial=" + pesoinicial  + "&fecha=" + fecha + "&PesoDesperdicio=" + pesodesperdicio + "&PesoNeto=" + pesoneto + "&Adiciones=" + adiciones + "&#lote=" + lote+ "&#loteagua=" + loteagua + "&Empleado=" + empleado + "&Cantidad=" + cantidad + "&opciones=" + materia);

  

  // Retornamos false para evitar que el formulario se envíe automáticamente
  return false;
}
</script>	

<script>
function calcularPesoNeto() {
  // Obtener los valores ingresados por el usuario
  var pesoInicial = document.getElementById("PesoInicial").value;
  var pesoDesperdicio = document.getElementById("PesoDesperdicio").value;

  // Calcular el peso neto
  var pesoNeto = pesoInicial - pesoDesperdicio;

  // Actualizar el valor del campo de entrada correspondiente
  document.getElementById("PesoNeto").value = pesoNeto;
}
</script>
<?php
// función para conectarse a la base de datos
function conectar_bd() {
  $servidor = 'localhost';
  $usuario = 'root';
  $password = '';
  $bd = 'lachila';
  
  $conexion = mysqli_connect($servidor, $usuario, $password, $bd);
  
  if (!$conexion) {
    die('Error al conectar a la base de datos: ' . mysqli_connect_error());
  }
  
  return $conexion;
}	

function obtener_permisos_usuariop($nombre_completo) {

	
$conexion = conectar_bd();
$query = "SELECT p.id, p.nombre FROM permisos p 
INNER JOIN usuarios_permisos u ON p.id = permiso_id
WHERE u.usuario_nombre = '$nombre_completo'";
$resultado = mysqli_query($conexion, $query);
$permisos = array();
while ($fila = mysqli_fetch_assoc($resultado)) {
  $permisos[] = $fila["nombre"];
}
mysqli_free_result($resultado);
mysqli_close($conexion);
return $permisos;
}
?>	
</body>
</html>