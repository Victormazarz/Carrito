<?php
include "../modelo.php";

$base = new BBDD();
$link = $base::Conectar();

$cliente = new Cliente($_POST['dni'], $nombre=" ", $direccion=" ", $email=" ", $pwd=" ");
$cli = $cliente->buscar($link);
echo json_encode($cli);