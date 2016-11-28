<?php
  class LineaChat{

    private $id_chat;
    private $id;
    private $fecha_hora;
    private $mensaje;
    private $leido;
    private $email_usuario_envia;

    public function __construct($id_chat=NULL,$id=NULL,$fecha_hora=NULL,$mensaje=NULL,$leido=NULL,$email_usuario_envia=NULL){
      $this->id_chat=$id_chat;
      $this->id=$id;
      $this->fecha_hora=$fecha_hora;
      $this->mensaje=$mensaje;
      $this->leido=$leido;
      $this->email_usuario_envia=$email_usuario_envia;
    }

    public function getId(){
      return $id;
    }

    public function getIdChat(){
      return $id_chat;
    }
    
  }
 ?>
