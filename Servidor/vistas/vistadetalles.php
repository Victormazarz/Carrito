<?php

echo "<form method='post' action=''>";
echo "<input type='submit' name='volver' value='Volver'/>";
echo "</form>";

echo "<div style='width: 500px;       
height: 300px;
margin: 0 auto;
margin-top:200px;
margin-left:35%;
font-size:20px;
text-align:justify;
border-style: solid;
border-width: 1px;
border-radius: 10px;
padding: 30px;'
>";
echo "<form method='post' action='./vercarrito.php'>";
while ($fila = $result->fetch_assoc()) {


    echo "<br>";
    echo "<table cellspacing=10>";

    echo "<tr><td rowspan='5'><img src='img/" . $fila['foto'] . "'width='100' height='130' style='align:right'></td><td><strong>IDProducto:</strong> </td><td>" . $fila['idProducto'] . "</td><td><strong>Nombre: </strong></td><td>" . $fila['nombre'] . "</td></tr>";
    echo "<tr><td><strong>Origen: </strong></td><td>" . $fila['origen'] . "</td><td><strong>Marca:</strong> </td><td>" . $fila['marca'] . "</td></tr>";
    echo "<tr><td><strong>Categoria:</strong> </td><td>" . $fila['categoria'] . "</td><td><strong>Peso:</strong> </td><td>" . $fila['peso'] . "g</td></tr>";
    echo "<tr><td><strong>Unidades:</strong> </td><td>" . $fila['unidades'] . "</td><td><strong>Valumen:</strong> </td><td>" . $fila['volumen'] . "g</td></tr>";
    echo "<tr><td><strong>Precio:</strong> </td><td>" . $fila['precio'] . "€</td><td><strong>Cantidad:</strong> </td><td><input type='number' value='1' style='font-size:20px;width:40px;' name='cantidad' size='7' min='1'/></td></tr>";
    echo "<td colspan='5'><input type='submit' value='Comprar' name='comprar' style='font-size:20px;margin-left:30%; width: 200px;  height: 40px;'/></td>";
    
    echo "</table>";


    echo "<input type='hidden' value=" . $fila['idProducto'] . " name='id' size='5' min='1'/>";
    echo "<input type='hidden' value=" . $fila['nombre'] . " name='nombre' size='5' min='1'/>";
    echo "<input type='hidden' value=" . $fila['precio'] . " name='precio' size='5' min='1'/>";
}
echo "</form>";
echo "</div>";
