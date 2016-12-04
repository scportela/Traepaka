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

    public function getFechaHora(){
      return $fecha_hora;
    }

    public function setFechaHora($fecha_hora){
      $this->fecha_hora=$fecha_hora;
    }

    public function getMensaje(){
      return $this->mensaje;
    }

    public function setMensaje($mensaje){
      $this->mensaje=$mensaje;
    }

    public function getLeido(){
      return $this->leido;
    }

    public function setLeido($leido){
      $this->leido=$leido;
    }

    public function getEmailUsuarioEnvia(){
      return $this->email_usuario_envia;
    }

    public function setEmailUsuarioEnvia($email_usuario_envia){
      $this->email_usuario_envia=$email_usuario_envia;
    }

  }
 ?>
