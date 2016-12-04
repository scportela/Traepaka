<?php
  require_once(__DIR__."/../core/PDOConnection.php");
  require_once(__DIR__."/Producto.php");

  class ProductoMapper{
    private $db;

    public function __construct() {
      $this->db = PDOConnection::getInstance();
    }

    public function getProductos(){
      $stmt=$this->db->prepare("SELECT * FROM articulo");
      $stmt->execute();
      $producto_db=$stmt->fetchAll(PDO::FETCH_ASSOC);
      $productos = array();
  		foreach ($producto_db as $producto) {
  			array_push($productos, new Producto($producto["id"], $producto["email_usuario"], $producto["descripcion"],
                                        $producto["titulo"], $producto["foto"], $producto["precio"]));
  		}


      return $productos;
    }

    public function getUnProducto($id){
      $stmt=$this->db->prepare("SELECT * FROM articulo WHERE id=?");
      $stmt->execute(array($id));
      $producto_db=$stmt->fetchAll(PDO::FETCH_ASSOC);
      $productos = array();
  		foreach ($producto_db as $producto) {
  			array_push($productos, new Producto($producto["id"], $producto["email_usuario"], $producto["descripcion"],
                                        $producto["titulo"], $producto["foto"], $producto["precio"]));
  		}


      return $productos;
    }


    public function getMisProductos($email){
      $stmt=$this->db->prepare("SELECT * FROM articulo WHERE email_usuario=?");
      $stmt->execute(array($email));
      $producto_db=$stmt->fetchAll(PDO::FETCH_ASSOC);
      $productos = array();
  		foreach ($producto_db as $producto) {
  			array_push($productos, new Producto($producto["id"], $producto["email_usuario"], $producto["descripcion"],
                                        $producto["titulo"], $producto["foto"], $producto["precio"]));
  		}
      return $productos;
    }

    public function save($producto) {
  		$stmt = $this->db->prepare("INSERT INTO articulo(id,titulo,descripcion,precio,foto,fecha_hora,email_usuario) values (?,?,?,?,?,?,?)");

  		$stmt->execute(array(null,$producto->getTitulo(), $producto->getDescripcion(), $producto->getPrecio(), $producto->getFoto(),null,$producto->getEmail()));
  	}

    public function getBusqueda($cadena){
      $stmt=$this->db->prepare("SELECT * FROM articulo WHERE titulo=?");
      $stmt->execute(array($cadena));
      $producto_db=$stmt->fetchAll(PDO::FETCH_ASSOC);
      $productos = array();
  		foreach ($producto_db as $producto) {
  			array_push($productos, new Producto($producto["id"], $producto["email_usuario"], $producto["descripcion"],
                                        $producto["titulo"], $producto["foto"], $producto["precio"]));
  		}


      return $productos;
    }




  }
 ?>
