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

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Inventario</title>
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
                var id_lote = prompt("Introduce el envase a modificar:");

                // Realizamos la petición AJAX para buscar el lote
                $.ajax({
                    url: "buscar_envases.php",
                    type: "POST",
                    data: {id_lote: id_lote},
                    dataType: "json",
                    success: function(resultado) {
                        // Mostramos la ventana emergente con los datos del lote
                        $("#ventana-emergente").show();

                        // Llenamos los campos de la ventana emergente con los datos del lote
						
                        $("#id_envasado").val(resultado.id);
                        $("#id_lote").val(resultado.Descripcion);
                        $("#materia").val(resultado.Cantidad);
                    },
                    error: function() {
                        alert("Error al buscar el lote");
                    }
                });
            });
			// Agregamos el evento click al botón de guardar cambios
            $("#btn-guardar-cambios").click(function() {
                // Obtenemos los datos de la ventana emergente
                var id_envasado = $("#id_envasado").val();
                var id_lote = $("#id_lote").val();
                var materia = $("#materia").val();

// Realizamos la petición AJAX para guardar los cambios en la base de datos
$.ajax({
	url: "modificar_envases.php",
	type: "POST",
	data: {
		id_envasado: id_envasado,
		id_lote: id_lote,
		materia: materia,
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
<script>
        $(document).ready(function() {
            // Agregamos el evento click al botón
            $("#modificar1").click(function() {
				event.preventDefault()
                // Pedimos al usuario el ID del lote
                var id_lote1 = prompt("Introduce el embalaje a modificar:");

                // Realizamos la petición AJAX para buscar el lote
                $.ajax({
                    url: "buscar_embalaje.php",
                    type: "POST",
                    data: {id_lote1: id_lote1},
                    dataType: "json",
                    success: function(resultado1) {
                        // Mostramos la ventana emergente con los datos del lote
                        $("#ventana-emergente1").show();

                        // Llenamos los campos de la ventana emergente con los datos del lote
						
                        $("#id_envasado1").val(resultado1.id);
                        $("#id_lote1").val(resultado1.Descripcion);
                        $("#materia1").val(resultado1.cant);
                    },
                    error: function() {
                        alert("Error al buscar el lote");
                    }
                });
            });
			// Agregamos el evento click al botón de guardar cambios
            $("#btn-guardar-cambios1").click(function() {
                // Obtenemos los datos de la ventana emergente
                var id_envasado1 = $("#id_envasado1").val();
                var id_lote1 = $("#id_lote1").val();
                var materia1 = $("#materia1").val();

// Realizamos la petición AJAX para guardar los cambios en la base de datos
$.ajax({
	url: "modificar_embalaje.php",
	type: "POST",
	data: {
		id_envasado1: id_envasado1,
		id_lote1: id_lote1,
		materia1: materia1,
	},
	success: function() {
		alert("Los cambios se han guardado correctamente");
		$("#ventana-emergente1").hide();
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

 
				// Consultar la tabla
				$sql = "SELECT descripcion, cantidad FROM envases";
				$resultado = $conexion->query($sql);

				// Consultar la tabla
				$sql1 = "SELECT descripcion, cant FROM embalaje";
				$resultado1 = $conexion->query($sql1);	
				
				
$sql_usuario = "SELECT foto FROM usuarios WHERE nombres = '$nombre_usuario'";

$resultado_usuario = mysqli_query($conexion, $sql_usuario);

// Obtener la ruta de la imagen del usuario actual
$fila_usuario = mysqli_fetch_assoc($resultado_usuario);
$ruta_imagen = $fila_usuario['foto'];

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
						<img src="<?php echo $ruta_imagen; ?>" alt="Foto de perfil del usuario" class="img-responsive">

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
				<img src="<?php echo $ruta_imagen; ?>" alt="Foto de perfil del usuario" class="img-responsive">
				</div>
				<figcaption class="navLateral-body-cr hide-on-tablet">
					<span>
					<span>Usuario: <?php echo htmlspecialchars($nombre_completo); ?> <br>
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


<section class="full-width pageContent">
    <section class="full-width header-well">
        <div class="full-width header-well-icon">
            <figure class="full-width">
                    <img src="assets/img/nuevologo.jpeg" alt="LOGO" class="img-responsive">
            </figure>
            <div class="full-width header-well-text">
            <p class="text-condensedLight">
                 ENVASES Y EMBALAJE
            </p>
        </div>						
</section>
<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
    <div class="mdl-tabs__tab-bar">
        <a href="#tabNewProduct" class="mdl-tabs__tab is-active">Inventario de Envases </a>
        <a href="#tabNewEgreso" class="mdl-tabs__tab">Inventario de Embalaje</a>
    </div>

    <div class="mdl-tabs__panel is-active" id="tabNewProduct">
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
                <div class="full-width panel mdl-shadow--2dp">
                    <div class="full-width panel-tittle bg-primary text-center tittles">
                        Inventario de Envases
                    </div>
                    <div class="full-width panel-content">
					<form><h6 class="text-center">Buscar por nombre de producto</h6>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable" style="text-align: center;">
    <label class="mdl-button mdl-js-button mdl-button--icon" for="filtro_nombre">
      <i class="zmdi zmdi-search"></i>
    </label>
    <div class="mdl-textfield__expandable-holder">
      <input class="mdl-textfield__input" type="text" id="filtro_nombre" onkeyup="filtrarTabla()" placeholder="Buscar...">
      <label class="mdl-textfield__label" for="filtro_nombre"></label>
    </div>
  </div>
</form>
                        <form>
                            <div class="mdl-grid">
                                <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
                                <div style="overflow-x: auto;">   
								<table id="tabla_productos" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive">
                                        <thead>
                                            <tr>
                                            <th class="mdl-data-table"style="text-align: center;">TIPO DE ENVASE</th>
                                            <th class="mdl-data-table" style="text-align: center;">CANTIDAD</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php   
									   
									   // Mostrar los resultados en la tabla
									   if ($resultado->num_rows > 0) {
										   while($row = $resultado->fetch_assoc()) {
											   echo "<tr><td style='text-align:center'>" . $row["descripcion"] . "</td>
											   <td style='text-align:center'>" . $row["cantidad"] . "</td></tr>";
											 }
									   } else {
										   echo "0 resultados";
									   }
															  ?>
                                        </tbody>
                                    </table>
									<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" type="submit"style="margin-left:450px"  id="modificar" >
											<i class="zmdi zmdi-refresh"></i>
										<div class="mdl-tooltip" for="modificar">Modificar Inventario</div>
										</button>
								</div>
                                </div>
                            </div>	
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	       
	<div id="ventana-emergente" style="display: none;">
		   <div class="mdl-grid">
		   <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
									   
   <h6>Modificar Producto</h6>
   <form>
	   <label >Codigo:</label>
	   <input type="text" id="id_envasado" readonly><br>
	   <label >Producto:</label>
	   <input type="text" id="id_lote"><br>

	   <label>Cantidad:</label>
	   <input type="text" id="materia"><br>

	   <button class="mdl-button mdl-js-button mdl-button--rised mdl-js-ripple-effect mdl-button--colored bg-primary" type="button" id="btn-guardar-cambios">Guardar cambios</button>
   </form>
</div>
		   </div></div>       
    <div class="mdl-tabs__panel" id="tabNewEgreso">
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
                <div class="full-width panel mdl-shadow--2dp">
                    <div class="full-width panel-tittle bg-primary text-center tittles">
                        Inventario de Embalajes
                    </div>
                    <div class="full-width panel-content">
					<form><h6 class="text-center">Buscar por nombre de producto</h6>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable" style="text-align: center;">
    <label class="mdl-button mdl-js-button mdl-button--icon" for="filtro_nombre1">
      <i class="zmdi zmdi-search"></i>
    </label>
    <div class="mdl-textfield__expandable-holder">
      <input class="mdl-textfield__input" type="text" id="filtro_nombre1" onkeyup="filtrarTabla1()" placeholder="Buscar...">
      <label class="mdl-textfield__label" for="filtro_nombre1"></label>
    </div>
  </div>
</form>
                        <form>
                            <div class="mdl-grid">
                                <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
                                <div style="overflow-x: auto;">    
								<table id="tabla_productos1" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive">
									<thead>
                                            <tr>
                                            <th class="mdl-data-table"style="text-align: center;">TIPO DE EMBALAJE</th>
                                            <th class="mdl-data-table" style="text-align: center;">CANTIDAD</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php   
									   
									   // Mostrar los resultados en la tabla
									   if ($resultado1->num_rows > 0) {
										   while($row = $resultado1->fetch_assoc()) {
											   echo "<tr><td style='text-align:center'>" . $row["descripcion"] . "</td>
											   <td style='text-align:center'>" . $row["cant"] . "</td></tr>";
											 }
									   } else {
										   echo "0 resultados";
									   }
															  ?>
                                        </tbody>
                                    </table>
									<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" type="submit"style="margin-left:450px"  id="modificar1" >
											<i class="zmdi zmdi-refresh"></i>
										<div class="mdl-tooltip" for="modificar1">Modificar Inventario</div>
										</button>
								</div>
                                </div>
                            </div>	
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

	
	       
<div id="ventana-emergente1" style="display: none;">
		   <div class="mdl-grid">
		   <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
									   
   <h6>Modificar Producto</h6>
   <form>
	   <label >Codigo:</label>
	   <input type="text" id="id_envasado1" readonly><br>
	   <label >Producto:</label>
	   <input type="text" id="id_lote1"><br>

	   <label>Cantidad:</label>
	   <input type="text" id="materia1"><br>

	   <button class="mdl-button mdl-js-button mdl-button--rised mdl-js-ripple-effect mdl-button--colored bg-primary" type="button" id="btn-guardar-cambios1">Guardar cambios</button>
   </form>
</div>
		   </div></div>       
<script>
// Función para filtrar la tabla por nombre
function filtrarTabla() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("filtro_nombre");
    filter = input.value.toUpperCase();
    table = document.getElementById("tabla_productos");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
</script>
<script>
// Función para filtrar la tabla por nombre
function filtrarTabla1() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("filtro_nombre1");
    filter = input.value.toUpperCase();
    table = document.getElementById("tabla_productos1");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
</script>
</body>
</html>