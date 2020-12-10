<?php
include "../modelo.php";

$base = new BBDD();
$link = $base::Conectar();

$pedido = new Pedidos($_POST['id'], $nombre=" ", $direccion=" ", $email=" ", $pwd=" ", $qeqe=" ", $ewew=" ");
$ped = $pedido->buscar($link);

echo json_encode($ped);