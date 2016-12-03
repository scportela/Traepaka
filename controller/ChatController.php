<?php
  require_once(__DIR__."/../model/Chat.php");
  require_once(__DIR__."/../model/ChatMapper.php");
  require_once(__DIR__."/../model/LineaChat.php");
  require_once(__DIR__."/../model/LineaChatMapper.php");
  // require_once(__DIR__."/../model/Articulo.php");
  // require_once(__DIR__."/../model/ArticuloMapper.php");

  require_once(__DIR__."/../core/ViewManager.php");
  require_once(__DIR__."/../controller/BaseController.php");

  class ChatController extends BaseController{

      private $chatMapper;
      private $lineaChatMapper;

      public function __construct(){
        parent::__construct();

        $this->chatMapper = new ChatMapper();
        $this->lineaChatMapper = new LineaChatMapper();
      }

      public function crear(){
        if (!isset($_GET["emailvendedor"] && !isset($_GET["id_articulo"]))) {
          throw new Exception("emailvendedor & id_articulo is mandatory");
        }

        $chat = new Chat(NULL,$_GET["id_articulo"],NULL,$_GET["emailvendedor"],$view->getVariable("currentuser"));

        $id = $this->chatMapper->createChat($chat)

        $lineas = new LineaChat($id);

        $this->view->setVariable("lineaChat",$lineas);

        $this->view->render("chat", "chat");
      }

      public function listadoChats() {

        $chats = $this->chatMapper->getListForUser($view->getVariable("currentuser"));

        $this->view->setVariable("chat", $chats);

        $this->view->render("chat", "listadoChats");
      }

      public function chat(){
        if (!isset($_GET["id"])) {
          throw new Exception("id is mandatory");
        }

        $chatId = $_GET["id"];

        $lineaChat = $this->lineaChatMapper->getListaLineaChat($chatId);


        $this->view->setVariable("lineaChat", ($lineaChat==NULL)?new LineaChat($chatId):$lineaChat);

        $this->view->render("chat", "chat");
      }
  }
 ?>
