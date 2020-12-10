<?php
require "vistas/inicio.php";
require "modelo.php";
session_start();

if (isset($_SESSION['dni'])) {// Si hay almacenado un dni muestro todo, si no vuelve a validar

    require "vistas/saludo.php";
    $base = new BBDD();
    $link = $base::Conectar();

    if (isset($_POST['pagar'])) {// Si accede desde el carrito

        $peds = new Pedidos('', '', '', '', '', '', '');// Creo objeto pedidos
        $carro = new Carrito('', '', '', '');// Creo objeto carro
        $result = $peds->getMax($link);// Obtengo el ultimo id de Producto
        while ($fila = $result->fetch_assoc()) {

            $pedido = new Pedidos(($fila['idPedido'] + 1), 'dir', "tarjeta", "fechacad", "matr", 'now()', $_SESSION['dni']);// Creo el pedido sumandole uno al ultimo idPedido, fecha de hoy y el dni almacenado en la varible de sesion
            $pedido->insertar($link);// inserto el pedido

            $contlinea = 0;// contador de lineas para lineas de pedido
            for ($i = 0; $i < $_SESSION['total']; $i++) {
                $idpedido = ($fila['idPedido'] + 1);// Sumo uno al ultimo pedido insertado
                $contlinea = $contlinea + 1;// Sumo uno a la linea
                $linea = new LineasPedidos($idpedido, $contlinea, $_SESSION['idProducto'][$i], $_SESSION['cantidad'][$i]);// Creo el objeto lineas de pedidos con los datos correspondientes
                $linea->insertar($link);// inserto la linea
            }

            require "vistas/vistaconfirmar.php";
        }
    }
    $carro->BorrarCarrito();

    require "vistas/final.php";
} else {
    header('Location: validar.php');
}

        