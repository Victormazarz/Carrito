<?php

include "../modelo.php";


 //$fecha = $_GET['fecha'];
 $fecha = '2020-08-15';
 $dirEntrega = "";
 $nTarjeta = "";
 $fechaCaducidad = "";
 $matriculaRepartidor = "";
 //$dniCliente = $_GET['dni'];
 $dniCliente = '32';


$base = new BBDD();
$link = $base::Conectar();

$ultimoped = new Pedidos('','','','','','','');

$ultimopedido =$ultimoped->getMax($link);
$fila = $ultimopedido->fetch_assoc();
$id = $fila['idPedido']+1;

$pedido = new Pedidos($id, $fecha, $dirEntrega, $nTarjeta, $fechaCaducidad, $matriculaRepartidor, $dniCliente);
$pedido->insertar($link);
echo $fila['idPedido']+1;



