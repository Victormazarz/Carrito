<?php
echo "<h1>VALIDACION<h1>";
echo "<form action='../Servidor/validar.php' method='POST' >";
echo "  <table>";
echo "      <tr>";
echo "         <td>ID: </td>";
echo "          <td><input type='text' name='dni'></td>";
echo "      </tr>";
echo "      <tr>";
echo "         <td>Contrasena: </td>";
echo "         <td><input type='text' name='pwd'></td>";
echo "      </tr>";
echo "      <tr>";
echo "          <td><input type='submit' name='enviar'></td>";
echo "      </tr>";
echo "  </table>";
echo "</form>";