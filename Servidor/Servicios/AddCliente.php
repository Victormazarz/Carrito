<?php

include "../modelo.php";

$dni = trim($_POST['dni']);
$nombre = trim($_POST['nombre']);
$direccion = trim($_POST['direccion']);
$email = trim($_POST['email']);
$pwd = 'hola';

$pass_cifrada = password_hash($pwd,PASSWORD_DEFAULT,array("cost"=>12));


$base = new BBDD();
$link = $base::Conectar();

$cliente = new Cliente($dni, $nombre, $direccion, $email, $pass_cifrada);
$cliente->insertar($link);


