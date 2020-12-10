<?php

include "../modelo.php";

$base = new BBDD();
$link = $base::Conectar();

$pedido = new Pedidos($_POST['id'],'','','','','','');
$pedido->borrarPedidos($link);

//Pedidos::borrarPedidos($_POST['id'],$link);


