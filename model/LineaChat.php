<?php
  class LineaChat{

    private $id_chat;
    private $id;
    private $fecha_hora;
    private $mensaje;
    private $leido;
      private $enviado_comprador;

      public function __construct($id_chat = NULL, $id = NULL, $fecha_hora = NULL, $mensaje = NULL, $leido = NULL, $enviado_comprador = NULL)
      {
      $this->id_chat=$id_chat;
      $this->id=$id;
      $this->fecha_hora=$fecha_hora;
      $this->mensaje=$mensaje;
      $this->leido=$leido;
          $this->enviado_comprador = $enviado_comprador;
    }

    public function getId(){
        return $this->id;
    }

    public function getIdChat(){
        return $this->id_chat;
    }

    public function getFechaHora(){
        return $this->fecha_hora;
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

      public function getEnviadoComprador()
      {
          return $this->enviado_comprador;
    }

      public function setEnviadoComprador($enviado_comprador)
      {
          $this->enviado_comprador = $enviado_comprador;
    }

  }
 ?>
