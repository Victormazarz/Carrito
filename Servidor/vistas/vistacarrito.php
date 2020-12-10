<?php
$preciototal=0;
echo "<form method='post' action=''>";
echo "<h1>Detalles del carrito</h1>";
echo "</form>";

echo "<div style='width:200px;text-align:center;margin: 0 auto;'>";
echo "<form method='POST' action='./confirmar.php' style='width=2;'>";
echo "<table border=1 style='text-align:center;'>";
echo "<tr><td>ID</td><td>NOMBRE</td><td>PRECIO</td><td>CANTIDAD</td><td>IMPORTE</td></tr>";

for ($i=0; $i < $_SESSION['total']; $i++) { 
 
    echo "<tr><td>" . $_SESSION["idProducto"][$i] . "</td><td>" . $_SESSION["nombreProducto"][$i] . "</td><td>" . $_SESSION["precio"][$i] . "€</td><td>".$_SESSION["cantidad"][$i]."</td><td>" . ($_SESSION["precio"][$i] * $_SESSION["cantidad"][$i]) . "€</td></tr>";
    $preciototal = $preciototal+($_SESSION["precio"][$i] * $_SESSION["cantidad"][$i]);
}

echo "<tr><td></td><td></td><td></td><td>TOTAL</td><td>" . $preciototal . "€</td></tr>";
echo "</table>";

echo "<table><tr>";
echo "<td><input type='submit' Value='Procesar pedido' name='pagar'/></td>";
echo "</form>";
echo "</div>";

echo "<form method='post' action='./principal.php'>";
echo "<td><input type='submit' Value='Seguir Comprando' name='pagar'/></td>";
echo "</form></tr></table>";




