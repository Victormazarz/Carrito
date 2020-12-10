<?php

include "../modelo.php";

$base = new BBDD();
$link = $base::Conectar();

$id = $_POST['id'];
$linea = $_POST['linea'];
$idProducto = $_POST['idProducto'];
$cantidad = $_POST['cantidad'];

$lp = new LineasPedidos($id,$linea,$idProducto,$cantidad);
$lp->insertar($link);


