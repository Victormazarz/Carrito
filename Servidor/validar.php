<?php
require "vistas/inicio.php";
require "Modelo.php";// TODAS LAS CONTRASEÑAS SON 'HOLA'
session_start();
$base = new BBDD();
$link = $base::Conectar();
unset($_SESSION['dni']);
if (isset($_SESSION['dni'])) {// Si ya existe una variable de sesion dni lo manda directamente a principal.php 
    header('Location: principal.php');
} else {
    if (isset($_POST['enviar'])) {

        $cliente = new Cliente($_POST['dni'],'','','','');//Creo el objeto usuario y lo busco en la BBDD segun su dni
        $fila = $cliente->buscar($link);
       
        if ($fila) {// si la base devuelve algo
            if ($_POST['dni'] == $fila['dniCliente'] && password_verify($_POST['pwd'], $fila['pwd'])) {//compruebo si la pwd es correcta
                if ($fila['administrador'] == 'true') {// Si es admin lo mando al CRUD
                    header('Location: ../Cliente/adminmenu.html');
                } else {// si no lo es almaceno los datos en las arrays de sesion y lo mando a principal
                    $_SESSION['nombre'] = $fila['nombre'];
                    $_SESSION['dni'] = $_POST['dni'];
                    $_SESSION['total'] = 0;
                    header('Location: principal.php');
                }

                // Las siguientes lineas son para mostrar que ha ocurrido un error

            } else {
                require "vistas/validación.php";
                $mensaje = "Error al iniciar sesion";
                require "vistas/mensaje.php";
            }

        } else {
            require "vistas/validación.php";
            $mensaje = "Error al iniciar sesion";
            require "vistas/mensaje.php";
        }
       
    } else {
        require "vistas/validación.php";
    }
}
require "vistas/final.php";
