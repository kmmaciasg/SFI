<?php
include 'conexion_db.php'; 
$numero_orden = $_GET['numero_orden'];
// Consulta para seleccionar los datos de la tabla "ordenes_despacho"
$sql2 = "SELECT codigo, producto, cantidad, lv, lc FROM ordenes_despacho WHERE numero_orden = '$numero_orden'";
$result = $conexion->query($sql2);

// código para generar la tabla
echo "<table id='tabla-productos' class='mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive'>
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
