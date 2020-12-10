<?php
require "vistas/inicio.php";
require "Modelo.php";
session_start();

if (isset($_SESSION['dni'])) {// Si hay almacenado un dni muestro todo, si no vuelve a validar
    require "vistas/saludo.php";
    $base = new BBDD();
    $link = $base::Conectar();
    $result = Producto::getAll($link); //obtengo todos los productos de la BBDD

    require "vistas/vistaprincipal.php"; // los muestro todos en la vista
    require "vistas/final.php";
} else {
    header('Location: validar.php');
}
