<?php
session_start();
require "vistas/inicio.php";
require "vistas/saludo.php";
require "modelo.php";

if (isset($_SESSION['dni'])) {// Si hay almacenado un dni muestro todo, si no vuelve a validar

    if (isset($_POST['comprar'])) {// Si accede desde detalles

        $carro = new Carrito($_POST['id'], $_POST['nombre'], $_POST['precio'], $_POST['cantidad']);// Creo objeto Producto
        if (isset($_SESSION['idProducto'])) {// Si existen las variables de sesion directamente añado los datos del producto a las variables

            if ($carro->CompExiste()) {
                $carro->AddProducto();
            }
        } else {// Si no existen las inicializo y despues los añado
            $carro->IniciarCarrito();
            $carro->AddProducto();
        }

        require "vistas/vistacarrito.php";
    } else {

        if (isset($_POST['vercarrito'])) {// Si accede desde principal

            if (isset($_SESSION['idProducto'])) {// Muestro el carrito
                require "vistas/vistacarrito.php";
            } else {// Si esta vacio informo de ello y no muestro ninguna tabla
                $mensaje = "<h1>El carrito esta vacio</h1>";
                require "vistas/mensaje.php";
            }
        }
    }
} else {
    header('Location: validar.php');
}
require "vistas/final.php";