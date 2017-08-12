<?php
require_once 'ControladorPrestamo.php';

$cPrestamo = new ControladorPrestamo();

$s = $_POST['valorBusqueda'];
$mensaje = '';

if (isset($s)) {
	$Prestamo = $cPrestamo->obtenerPorCliente($s);

	$mensaje.= "<thead>";
    $mensaje.= "<tr>";
    $mensaje.= "<th>ID</th>";
    $mensaje.= "<th>DUI</th>";
    $mensaje.= "<th>Nombre</th>";
    $mensaje.= "<th>Monto</th>";
    $mensaje.= "<th>Saldo</th>";
    $mensaje.= "<th>Tasa</th>";
    $mensaje.= "<th>Cuotas</th>";
    $mensaje.= "<th>Opciones</th>";
    $mensaje.= "</tr>";
    $mensaje.= "</thead>";
    $mensaje.= "<tbody>";

    $numPrestamos = count($Prestamo);

    for ($i = 0; $i < $numPrestamos; $i++) {
    	$mensaje .= "<tr>";
        $mensaje .= "<td>" . $Prestamo[$i]->id_prestamo . "</td>";
        $mensaje .= '<td>' . $Prestamo[$i]->cliente->dui . '</td>';
        $mensaje .= '<td>' . $Prestamo[$i]->cliente->nombres . ' ' . $Prestamo[$i]->cliente->apellidos . '</td>';
        $mensaje .= '<td>' . $Prestamo[$i]->monto . '</td>';
        $mensaje .= '<td>' . $Prestamo[$i]->saldo . '</td>';
        $mensaje .= '<td>' . $Prestamo[$i]->tasa_interes . '</td>';
        $mensaje .= '<td>' . $Prestamo[$i]->cantidad_cuotas . '</td>';
        $mensaje .= '<td>'.'<a href="detallePrestamo.php?id_prestamo='.$Prestamo[$i]->id_prestamo.' data-toggle="tooltip" data-placement="bottom" title="Detalle""><button class="btn btn-sm btn-info"><i class="glyphicon glyphicon-eye-open"></i></button></a>' . '<a href="webpago.php?id_prestamo='.$Prestamo[$i]->id_prestamo.'&fecha_ultimo_pago='.$Prestamo[$i]->fecha_ultimo_pago.'&nombres='.$Prestamo[$i]->cliente->nombres.'&apellidos='.$Prestamo[$i]->cliente->apellidos.'&monto='.$Prestamo[$i]->monto.'&tasa_interes='.$Prestamo[$i]->tasa_interes.'&cantidad_cuotas='.$Prestamo[$i]->cantidad_cuotas.'&valor_cuota='.$Prestamo[$i]->valor_cuota.' data-toggle="tooltip" data-placement="bottom" title="Nuevo Pago" "><button class="btn btn-sm btn-info"><i class="glyphicon glyphicon-usd"></i></button></a>' . '<a href="reporte.php?id_prestamo='.$Prestamo[$i]->id_prestamo.'&dui='.$Prestamo[$i]->cliente->dui.'&nombres='.$Prestamo[$i]->cliente->nombres.'&apellidos='.$Prestamo[$i]->cliente->apellidos.'&monto='.$Prestamo[$i]->monto.'&tasa='.$Prestamo[$i]->tasa_interes.'data-toggle="tooltip" data-placement="bottom" title="Reporte""><button class="btn btn-sm btn-info"><i class="glyphicon glyphicon-file"></i></button></a></tr>';

    }
}
$mensaje .= '</tbody>';
echo $mensaje;
