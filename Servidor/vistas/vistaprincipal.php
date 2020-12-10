<?php

echo "<form method='POST' action='./vercarrito.php'>";
echo "<h1 style='text-align: center;'>PRODUCTOS DE ALIMENTACION<button type='submit' name='vercarrito' width='50px' style='float:right;padding: 0;border: none;background: none;margin-right:10px;border-width:2px;'><img src='img/carrito3.jpg' width='50px'/><br>".$_SESSION['total']." Productos</button></h1>";
echo "</form>";
echo "<div>";

while ($fila = $result->fetch_assoc()) {
    echo "<div style='float: left; margin:20px;text-align:center;border-width:2px;border-style:solid;border-radius:20px;width:150px;height:250px;'>";
    echo "<img src='img/" . $fila['foto'] . "'width='120' height='130' style='margin-top:30px'><br>";
    echo $fila['nombre'] . "<br>";
    echo $fila['precio'] . "€<br>";
    echo "<a href='detalle.php?id=" . $fila['idProducto'] . "' name='detalles'/>Ver detalles</a><br>";
    echo "</div>";
}
echo "</div>";
