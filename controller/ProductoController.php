<?php
  require_once(__DIR__."/../model/Producto.php");
  require_once(__DIR__."/../model/ProductoMapper.php");

  require_once(__DIR__."/../model/Usuario.php");
  require_once(__DIR__."/../model/UsuarioMapper.php");

  require_once(__DIR__."/../core/ViewManager.php");
  require_once(__DIR__."/../controller/BaseController.php");
  require_once(__DIR__."/../Recursos/class_imgUpldr.php");

  class ProductoController extends BaseController{
      private $productoMapper;

      public function __construct(){
        parent::__construct();
        $this->productoMapper = new productoMapper();
      }

      public function listadoProducto() {
        $productos = $this->productoMapper->getProductos();
        $this->view->setVariable("producto", $productos);
        $this->view->render("producto", "listadoProducto");
      }

      public function detalleProducto(){
        $id=$_GET["id"];
        $unProducto=$this->productoMapper->getUnProducto($id);
        $this->view->setVariable("unProducto",$unProducto);
        $this->view->render("producto", "unProducto");
      }

      public function listadoMisProductos(){
        $email = $_GET["user"];
        $productos = $this->productoMapper->getMisProductos($email);
        $this->view->setVariable("producto", $productos);
        $this->view->render("producto", "listadoProducto");
      }

      public function nuevoProducto() {
        $producto = new Producto();
        if (isset($_POST["titulo"])){
          $producto->setTitulo($_POST["titulo"]);
          $producto->setDescripcion($_POST["descripcion"]);
          $producto->setEmail($_POST["email"]);
          $producto->setPrecio($_POST["precio"]);
          //Recogemos archivo
          $foto=($_FILES["foto"]);
          $subir= new imgUpldr();

          $randomString=$this->generateRandomString(15);

          $ruta = "img/Productos/$randomString";
          $subir->_dest= "img/Productos/";
          $subir->_name= "$randomString";
          $subir->init($foto);
          $producto->setFoto($ruta);

          $this->productoMapper->save($producto);
        }

        $this->view->render("producto", "nuevoProducto");
      }

      //Método con rand()
      function generateRandomString($length) {
          return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
      }


      public function eliminarProducto(){

      }

      public function busquedaTitulo(){
        $cadena = $_POST["cadena"];
        $productos = $this->productoMapper->getBusqueda($cadena);
        $this->view->setVariable("producto", $productos);
        $this->view->render("producto", "listadoProducto");
      }

  }
 ?>
