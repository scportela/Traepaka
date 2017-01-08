<?php
  require_once(__DIR__."/../core/PDOConnection.php");
  require_once(__DIR__."/LineaChat.php");

  class LineaChatMapper{
    private $db;

    public function __construct(){
      $this->db=PDOConnection::getInstance();
    }

    public function getListaLineaChat($id_chat){
      $stmt = $this->db->prepare("SELECT * FROM linea_chat WHERE id_chat=?");
        $stmt->execute(array($id_chat));
        $linea_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $lineas = array();

  		foreach ($linea_db as $linea) {
  			array_push($lineas, new LineaChat($linea["id_chat"], $linea["id"], $linea["fecha_hora"], $linea["mensaje"], $linea["leido"], $linea["email_usuario_envia"]));
  		}

      return $lineas;
    }

    public function getUltimaLinea($id_chat){
      $stmt=$this->db->prepare("SELECT * FROM linea_chat WHERE id_chat=? ORDER BY id DESC");
      $stmt->execute(array($id));
      $linea=$stmt->fetch(PDO::FETCH_ASSOC);

      if ($linea!=NULL) {
        return new LineaChat($linea["id_chat"], $linea["id"], $linea["fecha_hora"], $linea["mensaje"], $linea["leido"], $linea["email_usuario_envia"]);
      }else{
        return NULL;
      }
    }

    public function guardaLinea(LineaChat $linea){
      $stmt=$this->db->prepare("INSERT INTO linea_chat (id_chat,id,fecha_hora,mensaje,leido,email_usuario_envia) VALUES(?,?,?,?,?,?)");
      $stmt->execute(array($linea->id_chat,$linea->id,$linea->fecha_hora,$linea->mensaje,$linea->leido,$linea->email_usuario_envia));
      return $this->db->lastInsertId();
    }

    public function marcarLineaComoLeida($id_chat,$id){
      $stmt=$this->db->prepare("UPDATE linea_chat SET leido=1 WHERE id_chat=? AND id=?");
      $stmt->execute(array($id_chat,$id));
    }
  }

?>
