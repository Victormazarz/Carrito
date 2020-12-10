<?php

class BBDD
{
    public static function Conectar()
    {

        $link = new mysqli('localhost', 'root', '', 'virtualmarket');
        if ($link->connect_errno) {
        } else {
            $link->set_charset('utf-8');
            return $link;
        }
    }


    function __get($var)
    {
        return $this->$var;
    }
}

class Producto
{

    private $idProducto;
    private $nombre;
    private $origen;
    private $foto;
    private $marca;
    private $categoria;
    private $peso;
    private $unidades;
    private $volumen;
    private $precio;


    function __construct($idProducto, $nombre, $origen, $foto, $marca, $categoria, $peso, $unidades, $volumen, $precio)
    {

        $this->idProducto = $idProducto;
        $this->nombre = $nombre;
        $this->origen = $origen;
        $this->foto = $foto;
        $this->marca = $marca;
        $this->categoria = $categoria;
        $this->peso = $peso;
        $this->unidades = $unidades;
        $this->volumen = $volumen;
        $this->precio = $precio;
    }


    public static function getAll($link)
    {
        $consulta = "SELECT * FROM productos";
        $result = $link->query($consulta);
        return $result;
    }

    public function get($link)
    {
        $consulta = "SELECT * FROM productos WHERE idProducto=$this->idProducto";
        $result = $link->query($consulta);
        return $result;
    }
}

class Pedidos
{

    public $idPedido;
    private $fecha;
    private $dirEntrega;
    private $nTarjeta;
    private $fechaCaducidad;
    private $matriculaRepartidor;
    private $dniCliente;


    function __construct($idPedido, $fecha, $dirEntrega, $nTarjeta, $fechaCaducidad, $matriculaRepartidor, $dniCliente)
    {

        $this->idPedido = $idPedido;
        $this->fecha = $fecha;
        $this->dirEntrega = $dirEntrega;
        $this->nTarjeta = $nTarjeta;
        $this->fechaCaducidad = $fechaCaducidad;
        $this->matriculaRepartidor = $matriculaRepartidor;
        $this->dniCliente = $dniCliente;
    }

    public static function getAll($link)
    {
        $consulta = "SELECT * FROM pedidos";
        $result = $link->query($consulta);
        return $result;
    }

    public function getMax($link)
    {
        $consulta = "SELECT * FROM pedidos WHERE idPedido=(SELECT max(idPedido) FROM pedidos); ";
        $result = $link->query($consulta);
        return $result;
    }

    function insertar($link)
    {
        $sql = "INSERT INTO pedidos (idPedido,fecha,dniCliente) values('$this->idPedido',now(),'$this->dniCliente')";
        $result = $link->query($sql);
        return $result;
    }

    public function borrarPedidos($link)
    {
        $sql = "DELETE FROM pedidos WHERE idPedido=$this->idPedido";
        $result = $link->query($sql);
        return $result;
    }

    public function buscar($link)
    {
        $sql = "SELECT * FROM pedidos WHERE idPedido=$this->idPedido";
        $result = $link->query($sql);
        return $result->fetch_assoc();
    }

    public function modificartodo($link)
    {
        $sql = "UPDATE `pedidos` SET `fecha` = '$this->fecha', `dniCliente` = '$this->dniCliente' WHERE `pedidos`.`idPedido` = '$this->idPedido'";
        $result = $link->query($sql);
        return $result;
    }
}

class Cliente
{

    private $dniCliente;
    private $nombre;
    private $direccion;
    private $email;
    private $pwd;


    function __construct($dniCliente, $nombre, $direccion, $email, $pwd)
    {

        $this->dniCliente = $dniCliente;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->email = $email;
        $this->pwd = $pwd;
    }


    public function get($var)
    {
        return $this->$var;
    }
    function buscar($link)
    {
        $sql = "SELECT * FROM clientes WHERE dniCliente = '$this->dniCliente'";
        $result = $link->query($sql);
        return $result->fetch_assoc();
    }

    function borrar($link)
    {
        $sql = "DELETE FROM clientes WHERE dniCliente=$this->dniCliente";
        $result = $link->query($sql);
        return $result;
    }

    function insertar($link)
    {
        $sql = "INSERT INTO clientes values('$this->dniCliente','$this->nombre','$this->direccion','$this->email','$this->pwd','false')";
        $result = $link->query($sql);
        return $result;
    }

    public static function getAll($link)
    {
        $consulta = "SELECT * FROM clientes";
        $result = $link->query($consulta);
        return $result;
    }

    public function modificartodo($link)
    {
        $sql = "UPDATE `clientes` SET `nombre` = '$this->nombre', `direccion` = '$this->direccion', `email` = '$this->email'WHERE `clientes`.`dniCliente` = '$this->dniCliente' ";
        $result = $link->query($sql);
        return $result;
    }
}

class LineasPedidos
{


    private $idPedido;
    private $nlinea;
    private $idProducto;
    private $cantidad;


    function __construct($idPedido, $nlinea, $idProducto, $cantidad)
    {

        $this->idPedido = $idPedido;
        $this->nlinea = $nlinea;
        $this->idProducto = $idProducto;
        $this->cantidad = $cantidad;
    }

    function insertar($link)
    {
        $sql = "INSERT INTO lineaspedidos values('$this->idPedido','$this->nlinea','$this->idProducto','$this->cantidad')";
        $result = $link->query($sql);
        return $result;
    }

    function buscar($link)
    {
        $sql = "SELECT * FROM lineaspedidos WHERE idPedido=$this->idPedido";
        $result = $link->query($sql);
        return $result;
    }

    function borrar($link)
    {

        $sql = "DELETE FROM lineaspedidos WHERE idPedido=$this->idPedido and nlinea=$this->nlinea";
        $result = $link->query($sql);
        return $result;
    }
}

class Carrito
{

    private $id;
    private $nombre;
    private $precio;
    private $cantidad;


    function __construct($id, $nombre, $precio, $cantidad)
    {

        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
    }

    function AddProducto()// Añadir los datos recibidos por el objeto a las arrays de sesion
    {

        $_SESSION['idProducto'][$_SESSION['total']] = $this->id;
        $_SESSION['nombreProducto'][$_SESSION['total']] = $this->nombre;
        $_SESSION['precio'][$_SESSION['total']] = $this->precio;
        $_SESSION['cantidad'][$_SESSION['total']] = $this->cantidad;
        $_SESSION['total']++;
    }

    function CompExiste()//Comprobar si el pedido existe
    {
        $comp = true;
        for ($i = 0; $i < $_SESSION['total']; $i++) {

            if ($_SESSION['idProducto'][$i] == $this->id) {// Si en el array de sesion idProducto ya existe el id del objeto
                $_SESSION['cantidad'][$i] = $_SESSION['cantidad'][$i] + $this->cantidad;// al array con ese indice se le suma la cantidad del objeto
                $comp = false;
            }
        }
        return $comp;
    }

    function BorrarCarrito()// vaciar carrito y devolver total a 0
    {
        unset($_SESSION['idProducto']);
        unset($_SESSION['nombreProducto']);
        unset($_SESSION['precio']);
        unset($_SESSION['cantidad']);
        $_SESSION['total'] = 0;
    }

    function IniciarCarrito(){// iniciarlizar carrito
        $_SESSION['idProducto'] = array();
        $_SESSION['nombreProducto'] = array();
        $_SESSION['precio'] = array();
        $_SESSION['cantidad'] = array();
        $_SESSION['total'] = 0;
    }
}
