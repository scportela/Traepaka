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
            array_push($chats, new Chat($chat["id"], $chat["id_articulo"], $chat["fecha_hora"], $chat["email_usuario_comprador"]));
  		}

      return $chats;
    }

    public function getListForUser($email){
      $stmt=$this->db->prepare("SELECT C.*,
                                       A.titulo as tituloarticulo, 
                                       A.descripcion AS descripcionarticulo, 
                                       A.precio AS precioarticulo, 
                                       A.foto AS fotoarticulo, 
                                       A.email_usuario AS emailvendedor 
                                       FROM articulo AS A INNER JOIN chat AS C ON A.id=C.id_articulo 
                                       WHERE (A.email_usuario=? OR C.email_usuario_comprador=?)");
      $stmt->execute(array($email,$email));
      $chat_db=$stmt->fetchAll(PDO::FETCH_ASSOC);
      $chats = array();

  		foreach ($chat_db as $chat) {
            if ($email == $chat["emailvendedor"]) {
                $emailfoto = $chat["email_usuario_comprador"];
            } else {
                $emailfoto = $chat["emailvendedor"];
            }

            $stmt2 = $this->db->prepare("SELECT L.mensaje AS ultimomensaje, 
                                       L.fecha_hora AS fechahoraultimomensaje
                                       FROM linea_chat AS L
                                       WHERE id_chat=?
                                       ORDER BY id DESC
                                       LIMIT 1");
            $stmt2->execute(array($chat["id"]));
            $ultimalinea = $stmt2->fetch(PDO::FETCH_ASSOC);

            $newChat = new Chat($chat["id"],
                $chat["id_articulo"],
                $chat["fecha_hora"],
                $chat["emailvendedor"],
                $chat["email_usuario_comprador"],
                $ultimalinea["ultimomensaje"],
                $ultimalinea["fechahoraultimomensaje"],
                new Producto($chat["id_articulo"],
                    $chat["emailvendedor"],
                    $chat["descripcionarticulo"],
                    $chat["tituloarticulo"],
                    $chat["fotoarticulo"],
                    $chat["precioarticulo"]),
                $this->fotoUsuario($emailfoto));

            if ($email == $chat["emailvendedor"]) {
                $enviado = 1;
            } else {
                $enviado = 0;
            }

            $newChat->setNumeroMensajesSinLeer($this->numeroMensajesSinLeer($newChat->getId(), $enviado));
            array_push($chats, $newChat);
  		}

      return $chats;
    }

    public function getChatById($id){
        $stmt = $this->db->prepare("SELECT C.*,
                                       A.titulo as tituloarticulo, 
                                       A.descripcion AS descripcionarticulo, 
                                       A.precio AS precioarticulo, 
                                       A.foto AS fotoarticulo, 
                                       A.email_usuario AS emailvendedor 
                                       FROM articulo AS A INNER JOIN chat AS C ON A.id=C.id_articulo
                                       WHERE C.id=?");
      $stmt->execute(array($id));
      $chat=$stmt->fetch(PDO::FETCH_ASSOC);

      if($chat!=NULL){
          return new Chat($chat["id"],
              $chat["id_articulo"],
              $chat["fecha_hora"],
              $chat["emailvendedor"],
              $chat["email_usuario_comprador"],
              NULL,
              NULL,
              new Producto($chat["id_articulo"],
                  $chat["emailvendedor"],
                  $chat["descripcionarticulo"],
                  $chat["tituloarticulo"],
                  $chat["fotoarticulo"],
                  $chat["precioarticulo"]));;
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
        $stmt = $this->db->prepare("INSERT INTO chat(id_articulo,fecha_hora,email_usuario_comprador) VALUES(?,NOW(),?)");
        $stmt->execute(array($chat->getIdArticulo(), $chat->getEmailUsuarioComprador()));
      return $this->db->lastInsertId();
    }

    public function deleteChat($id){
      $stmt=$this->db->prepare("DELETE FROM chat WHERE id=?");
      $stmt->execute(array($id));
    }

      public function numeroMensajesSinLeer($id_chat, $enviado)
      {
          $stmt = $this->db->prepare("SELECT COUNT(*) as numero FROM linea_chat WHERE id_chat=? AND leido=0 AND enviado_comprador=?");
          $stmt->execute(array($id_chat, $enviado));
          $num = $stmt->fetch(PDO::FETCH_ASSOC);

          return $num["numero"];
      }

      public function fotoUsuario($email)
      {
          $stmt = $this->db->prepare("SELECT foto FROM usuario WHERE email=?");
          $stmt->execute(array($email));
          $f = $stmt->fetch(PDO::FETCH_ASSOC);

          return $f["foto"];
      }
  }
 ?>
