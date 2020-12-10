<?php
include "../modelo.php";

$base = new BBDD();
$link = $base::Conectar();

$idPedido=$_POST['id'];
$fecha=$_POST['fecha'];
$dniCliente=$_POST['dniCliente'];

$pedido = new Pedidos($idPedido,$fecha,$dir="",$tar="",$cad="",$matr="",$dniCliente);
$pedido->modificartodo($link);

