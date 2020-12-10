<?php
include "../modelo.php";

$base = new BBDD();
$link = $base::Conectar();
$pedido = new LineasPedidos($_POST['id'], $nlinea=" ", $idProducto=" ", $cantidad=" ");
$ped = $pedido->buscar($link);

while ($fila = $ped->fetch_assoc()) {
    $test[]= $fila;
 }

echo json_encode($test);