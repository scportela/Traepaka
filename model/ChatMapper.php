<?php
  require_once(__DIR__."/../core/db_connection.php");
  class ChatMapper{
    private $db;

    public function __construct() {
      $this->db = PDOConnection::getInstance();
    }

    public function getChatById($id){
      $stmt=$this->db->prepare("SELECT * FROM chat WHERE id=?");
      $stmt->execute(array($id));
      $chat=$stmt->fetch(PDO::FETCH_ASSOC);

      if($chat!=NULL){
        return new Chat($chat["id"],$chat["id_articulo"],$chat["fecha_hora"],$chat["email_usuario_vendedor"],$chat["email_usuario_comprador"]);
      }else{
        return NULL;
      }
    }

    public function createChat(Chat $chat){
      $stmt=$this->db->prepare("INSERT INTO chat(id_articulo,fecha_hora,email_usuario_vendedor,email_usuario_comprador) VALUES(?,NOW(),?,?)");
      $stmt->execute(array($chat->getIdArticulo,$chat->getFechaHora,$chat->getEmailUsuarioVendedor,$chat->getEmailUsuarioComprador));
      return $this->db->lastInsertId();
    }

    public function deleteChat($id){
      $stmt=$this->db->prepare("DELETE FROM chat WHERE id=?");
      $stmt->execute(array($id));
    }
  }
 ?>
