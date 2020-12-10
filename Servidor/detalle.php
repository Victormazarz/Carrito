<?php
require "vistas/inicio.php";
require "Modelo.php";
session_start();
require "vistas/saludo.php";

if (isset($_SESSION['dni'])) {// Si hay almacenado un dni muestro todo, si no vuelve a validar

   $base = new BBDD();
   $link = $base::Conectar();

   $prod = new Producto($_GET['id'], '', '', '', '', '', '', '', '', ''); // Creo objeto producto con el idProducto
   $result = $prod->get($link);// Obtengo los datos de ese producto buscandolo por su id

   if (isset($_POST['volver'])) {// Boton volver a principal
      header("location: principal.php");
   }

   require "vistas/vistadetalles.php";//Muestro los datos del producto

   require "vistas/final.php";
} else {
   header('Location: validar.php');
}
