<?php
include "../modelo.php";

$base = new BBDD();
$link = $base::Conectar();

$dni=$_POST['dni'];
$nombre=$_POST['nombre'];
$direccion=$_POST['direccion'];
$email=$_POST['email'];

$usuario = new Cliente($dni,$nombre,$direccion,$email,$pwd="");
echo $dni;
$usuario->modificartodo($link);

