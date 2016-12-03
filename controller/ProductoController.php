<?php
  require_once(__DIR__."/../model/Producto.php");
  require_once(__DIR__."/../model/ProductoMapper.php");

  require_once(__DIR__."/../core/ViewManager.php");
  require_once(__DIR__."/../controller/BaseController.php");

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
        $id=1;

        $unProducto=$this->productoMapper->getUnProducto($id);

        $this->view->setVariable("unProducto",$unProducto);

        $this->view->render("producto", "unProducto");
      }
  }
 ?>
