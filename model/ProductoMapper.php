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


  }
 ?>
