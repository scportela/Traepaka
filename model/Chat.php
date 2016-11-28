<?php
  class Chat{

    private $id;
    private $id_articulo;
    private $fecha_hora;
    private $email_usuario_vendedor;
    private $email_usuario_comprador;

    public function __construct($id=NULL,$id_articulo=NULL,$fecha_hora=NULL,$email_usuario_vendedor=NULL,$email_usuario_comprador=NULL){
      $this->id=$id;
      $this->id_articulo=$id_articulo;
      $this->fecha_hora=$fecha_hora;
      $this->email_usuario_vendedor=$email_usuario_vendedor;
      $this->email_usuario_comprador=$email_usuario_comprador;
    }

    public function getId(){
      return $this->id;
    }

    public function getIdArticulo(){
      return $this->id_articulo;
    }

    public function setIdArticulo($idArticulo){
      $this->id_articulo=$id_articulo;
    }

    public function getFechaHora(){
      return $this->fecha_hora;
    }

    public function setFechaHora($fecha_hora){
      $this->fecha_hora=$fecha_hora;
    }

    public function getEmailUsuarioVendedor(){
      return $this->email_usuario_vendedor;
    }

    public function setEmailUsuarioVendedor($email_usuario_vendedor){
      $this->email_usuario_vendedor=$email_usuario_vendedor;
    }

    public function getEmailUsuarioComprador(){
      return $this->email_usuario_comprador;
    }

    public function setEmailUsuarioComprador($email_usuario_comprador){
      $this->email_usuario_comprador=$email_usuario_comprador;
    }
  }
 ?>
