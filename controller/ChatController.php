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

        if ($lineaChat == NULL) {
          throw new Exception("no such chat with id: ".$chatId);
        }

        $this->view->setVariable("lineaChat", ($lineaChat==NULL)?new LineaChat():$lineaChat);

        $this->view->render("chat", "listadoChats");
      }
  }
 ?>
