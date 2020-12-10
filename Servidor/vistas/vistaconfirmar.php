<?php
$str="";
$str .="<h1>Informacion de tu pedido</h1>";
$total=0;

for ($i=0; $i < $_SESSION['total']; $i++) { 
        $str .="<strong>".$_SESSION["nombreProducto"][$i]."</strong>";
        $str .="<br>";
        $str .="Precio: ".$_SESSION["cantidad"][$i] ." x ".$_SESSION["precio"][$i]."€ : " . ($_SESSION["precio"][$i] * $_SESSION["cantidad"][$i]) . "€";
        $str .="<hr>";
        $total += $_SESSION["precio"][$i] * $_SESSION["cantidad"][$i];
    
}

$str .="Total del pedido: ".$total."€";
echo $str;
echo "<br><a href='principal.php'>Volver</a>";