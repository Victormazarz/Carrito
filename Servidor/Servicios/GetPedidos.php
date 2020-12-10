<?php
header('Content-Type: application/json; charset=utf-8');
include "../modelo.php";

$base = new BBDD();
$link = $base::Conectar();

$pedidos = Pedidos::getAll($link);
while ($fila = $pedidos->fetch_assoc()) {
   $test[]= $fila;
}

echo json_encode($test);