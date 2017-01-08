<?php
require_once(__DIR__."/../core/ValidationException.php");

class Producto {
	private $id;
	private $titulo;
  private $descripcion;
  private $precio;
	private $foto;
  private $fecha_hora;
	private $email_user;

	public function __construct($id=NULL, $email=NULL, $descripcion=NULL, $titulo=NULL, $foto=NULL, $precio=NULL) {

        $this->id=$id;
		$this->titulo = $titulo;
		$this->descripcion = $descripcion;
		$this->foto = $foto;
		$this->email_user = $email;
    $this->precio=$precio;
	}

  public function getId() {
  	return $this->id;
  }

	public function getTitulo() {
		return $this->titulo;
	}

	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}

	public function getDescripcion() {
		return $this->descripcion;
	}

	public function setDescripcion($descripcion) {
		$this->descripcion = $descripcion;
	}

	public function getFoto() {
		return $this->foto;
	}

	public function setFoto($foto) {
		$this->foto = $foto;
	}

	public function getEmail() {
		return $this->email_user;
	}

	public function setEmail($email) {
		$this->email_user = $email;
	}


	public function getPrecio() {
		return $this->precio;
	}

	public function setPrecio($precio) {
		$this->precio = $precio;
	}
}
