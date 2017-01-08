<?php
  require_once(__DIR__."/../model/Chat.php");
  require_once(__DIR__."/../model/ChatMapper.php");
  require_once(__DIR__."/../model/LineaChat.php");
  require_once(__DIR__."/../model/LineaChatMapper.php");
  require_once(__DIR__."/../model/Producto.php");
  require_once(__DIR__."/../model/ProductoMapper.php");
  require_once(__DIR__."/../model/Usuario.php");
  require_once(__DIR__."/../model/UsuarioMapper.php");

  require_once(__DIR__."/../core/ViewManager.php");
  require_once(__DIR__."/../controller/BaseController.php");

  class ChatController extends BaseController{

      private $chatMapper;
      private $lineaChatMapper;
      private $productoMapper;
      private $usuarioMapper;

      public function __construct(){
        parent::__construct();

        $this->chatMapper = new ChatMapper();
        $this->lineaChatMapper = new LineaChatMapper();
        $this->productoMapper = new ProductoMapper();
        $this->usuarioMapper = new UsuarioMapper();
      }

      public function crear(){
        if (!isset($_GET["emailvendedor"]) && !isset($_GET["id_articulo"])) {
          throw new Exception("emailvendedor & id_articulo is mandatory");
        }

        $idArticulo = $_GET["id_articulo"];

        $chat = new Chat(NULL,$idArticulo,NULL,$_GET["emailvendedor"],$this->view->getVariable("currentuser")->getEmail());

        $id = $this->chatMapper->createChat($chat);

        $lineas = new LineaChat($id);

        $chat->setId($id);
        $this->view->setVariable("chat",$chat);

        $articulo=$this->productoMapper->getUnProducto($idArticulo);
        $this->view->setVariable("producto",$articulo);

        $this->view->setVariable("lineaChat",$lineas);
        $this->view->render("chat", "chat");
      }

      public function listadoChats() {

        $chats = $this->chatMapper->getListForUser($this->view->getVariable("currentuser")->getEmail());
          //  var_dump($chats);
        $this->view->setVariable("chat", $chats);

        $this->view->render("chat", "listadoChats");
      }

      public function chat(){
        if (!isset($_GET["id"])) {
          throw new Exception("id is mandatory");
        }

        $chatId = $_GET["id"];

        $lineaChat = $this->lineaChatMapper->getListaLineaChat($chatId);

        $chat=$this->chatMapper->getChatById($chatId);
        $this->view->setVariable("chat",$chat);

        $this->view->setVariable("lineaChat", ($lineaChat==NULL)?new LineaChat($chatId):$lineaChat);

        $this->view->render("chat", "chat");
      }
  }
 ?>
