<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

/**
* Class User
*
* Represents a User in the blog
*
* @author lipido <lipido@gmail.com>
*/
class Usuario {

	/**
	* The user name of the user
	* @var string
	*/
	private $nombre;

	private $password;

	private $foto;

	private $email;

	/**
	* The password of the user
	* @var string
	*/
	/**
	* The constructor
	*
	* @param string $username The name of the user
	* @param string $passwd The password of the user
	*/
	public function __construct($email=NULL, $password=NULL, $nombre=NULL, $foto=NULL) {

		$this->nombre = $nombre;
		$this->password = $password;
		$this->foto = $foto;
		$this->email = $email;
	}


	public function getNombre() {
		return $this->nombre;
	}


	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}


	public function getPassword() {
		return $this->password;
	}

	public function setPassword($password) {
		$this->password = $password;
	}

	public function getFoto() {
		return $this->foto;
	}

	public function setFoto($foto) {
		$this->foto = $foto;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;
	}






}
