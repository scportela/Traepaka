<?php
  require_once(__DIR__."/../core/PDOConnection.php");
  require_once(__DIR__."/Chat.php");

  class ChatMapper{
    private $db;

    public function __construct() {
      $this->db = PDOConnection::getInstance();
    }

    public function getList(){
      $stmt=$this->db->prepare("SELECT * FROM chat");
      $stmt->execute();
      $chat_db=$stmt->fetchAll(PDO::FETCH_ASSOC);
      $chats = array();

  		foreach ($chat_db as $chat) {
  			array_push($chats, new Chat($chat["id"], $chat["id_articulo"], $chat["fecha_hora"], $chat["email_usuario_vendedor"], $chat["email_usuario_comprador"]));
  		}

      return $chats;
    }

    public function getListForUser($email){
      $stmt=$this->db->prepare("SELECT C.*,
                                L.mensaje AS ultimomensaje,
                                L.fecha_hora AS fechahoraultimomensaje,
                                A.titulo as tituloarticulo,
                                A.descripcion AS descripcionarticulo,
                                A.precio AS precioarticulo,
                                A.foto AS fotoarticulo,
                                A.email_usuario AS emailvendedor,
                                U.foto as foto
                                FROM usuario AS U, articulo AS A RIGHT OUTER JOIN chat AS C ON A.id=C.id_articulo
                                LEFT OUTER JOIN linea_chat AS L ON C.id=L.id_chat
                                WHERE (C.email_usuario_vendedor=? OR C.email_usuario_comprador=?) AND
                                      (U.email=C.email_usuario_vendedor OR U.email=C.email_usuario_comprador)");
      $stmt->execute(array($email,$email));
      $chat_db=$stmt->fetchAll(PDO::FETCH_ASSOC);
      $chats = array();

  		foreach ($chat_db as $chat) {
  			array_push($chats, new Chat($chat["id"],
                                    $chat["id_articulo"],
                                    $chat["fecha_hora"],
                                    $chat["email_usuario_vendedor"],
                                    $chat["email_usuario_comprador"],
                                    $chat["ultimomensaje"],
                $chat["fechahoraultimomensaje"],
                                    new Producto($chat["id_articulo"],
                                                 $chat["emailvendedor"],
                                                 $chat["descripcionarticulo"],
                                                 $chat["tituloarticulo"],
                                                 $chat["fotoarticulo"],
                                                 $chat["precioarticulo"]),
                $chat["foto"]));
  		}

      return $chats;
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

    // public function getChatWithMensages($id){
    //   $stmt=$this->db->prepare("SELECT
    //                             C.id AS id_chat,
    //                             C.id_articulo AS id_articulo,
    //                             C.fecha_hora AS fecha_hora_chat,
    //                             C.email_usuario_vendedor AS email_vendedor,
    //                             C.email_usuario_comprador AS email_comprador,
    //                             L.id AS id_mensaje,
    //                             L.fecha_hora AS fecha_hora_mensaje,
    //                             L.mensaje AS mensaje,
    //                             L.leido AS leido,
    //                             L.email_usuario_envia AS email_envia
    //                             FROM chat C LEFT OUTER JOIN linea_chat L ON C.id =L.id_chat
    //                             WHERE C.id=?");
    //   $stmt->execute(array($id));
    //   $chat_wt_mensages=$stmt->fetchAll(PDO::FETCH_ASSOC);
    //   if($chat_wt_mensages!=NULL){
    //     $chat = new Chat($chat_wt_mensages["id_chat"],$chat_wt_mensages["id_articulo"],$chat_wt_mensages["fecha_hora_chat"],$chat_wt_mensages["email_vendedor"],$chat_wt_mensages["email_comprador"]);
    //     $mensages_array = array();
		// 		if ($chat_wt_mensages[0]["id_mensaje"]!=null) {
		// 			foreach ($chat_wt_mensages as $linea){
		// 				$linea = new LineaChat( $linea["id_chat"],
    //                     						$linea["id_mensaje"],
    //                                 $linea["fecha_hora_mensaje"],
    //                     						$linea["mensaje"],
    //                     						$linea["leido"],
    //                     						$linea["email_envia"]
    //                                 );
		// 				array_push($mensages_array, $linea);
		// 			}
		// 		}
		// 		$post->setMensajes($mensages_array);
    //   }else{
    //     return NULL;
    //   }
    // }

    public function createChat(Chat $chat){
      $stmt=$this->db->prepare("INSERT INTO chat(id_articulo,fecha_hora,email_usuario_vendedor,email_usuario_comprador) VALUES(?,NOW(),?,?)");
      $stmt->execute(array($chat->getIdArticulo(),$chat->getEmailUsuarioVendedor(),$chat->getEmailUsuarioComprador()));
      return $this->db->lastInsertId();
    }

    public function deleteChat($id){
      $stmt=$this->db->prepare("DELETE FROM chat WHERE id=?");
      $stmt->execute(array($id));
    }
  }
 ?>
