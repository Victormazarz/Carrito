<?php
header('Content-Type: application/json; charset=utf-8');
include "../modelo.php";

$base = new BBDD();
$link = $base::Conectar();

$clientes = Cliente::getAll($link);
while ($fila = $clientes->fetch_assoc()) {
   $test[]= $fila;
}

echo json_encode($test);