<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");

/**
* Class UserMapper
*
* Database interface for User entities
*
* @author lipido <lipido@gmail.com>
*/
class UsuarioMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	/**
	* Saves a User into the database
	*
	* @param User $user The user to be saved
	* @throws PDOException if a database error occurs
	* @return void
	*/
	public function save($usuario) {

		$stmt = $this->db->prepare("INSERT INTO usuario(email,password,nombre,foto) values (?,?,?,?)");

		$stmt->execute(array($usuario->getEmail(), $usuario->getPassword(), $usuario->getNombre(), $usuario->getFoto()));

	}

	/**
	* Checks if a given username is already in the database
	*
	* @param string $username the username to check
	* @return boolean true if the username exists, false otherwise
	*/
	public function usernameExists($nombre) {
		$stmt = $this->db->prepare("SELECT count(nombre) FROM usuario where nombre=?");
		$stmt->execute(array($nombre));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}

	/**
	* Checks if a given pair of username/password exists in the database
	*
	* @param string $username the username
	* @param string $passwd the password
	* @return boolean true the username/passwrod exists, false otherwise.
	*/
	public function isValidUser($password, $email) {
		//echo "$password";
		//echo "$email";
		//die;
		$stmt = $this->db->prepare("SELECT count(email) FROM usuario where password=? and email=?");
		$stmt->execute(array($password, $email));

		if ($stmt->fetchColumn() > 0) {
			return 1;
		}
	}
}
