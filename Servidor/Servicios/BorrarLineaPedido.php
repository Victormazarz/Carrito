<?php

include "../modelo.php";

$base = new BBDD();
$link = $base::Conectar();

$id = $_POST['id'];
$linea = $_POST['linea'];

$lp = new LineasPedidos($id,$linea,$idProd="",$cant="");
$lp->borrar($link);


