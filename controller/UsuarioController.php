<?php

require_once(__DIR__."/../core/ViewManager.php");


require_once(__DIR__."/../model/Usuario.php");
require_once(__DIR__."/../model/UsuarioMapper.php");
require_once (__DIR__."/../Recursos/class_imgUpldr.php");
require_once(__DIR__."/../controller/BaseController.php");



/**
 * Class UsersController
 *
 * Controller to login, logout and user registration
 *
 */
class UsuarioController extends BaseController {

  /**
   * Reference to the usuarioMapper to interact
   * with the database
   *
   * @var usuarioMapper
   */
  private $usuarioMapper;


  public function __construct() {
    parent::__construct();

    $this->usuarioMapper = new UsuarioMapper();


    // Users controller operates in a "welcome" layout
    // different to the "default" layout where the internal
    // menu is displayed
    //$this->view->setLayout("welcome");
  }

 /**
   * Action to login
   *
   * Logins a user checking its creedentials agains
   * the database
   *
   * When called via GET, it shows the login form
   * When called via POST, it tries to login
   *
   * The expected HTTP parameters are:
   * <ul>
   * <li>login: The username (via HTTP POST)</li>
   * <li>passwd: The password (via HTTP POST)</li>
   * </ul>
   *
   * The views are:
   * <ul>
   * <li>posts/login: If this action is reached via HTTP GET (via include)</li>
   * <li>posts/index: If login succeds (via redirect)</li>
   * <li>users/login: If validation fails (via include). Includes these view variables:</li>
   * <ul>
   *  <li>errors: Array including validation errors</li>
   * </ul>
   * </ul>
   *
   * @return void
   */
  public function login() {

    //echo $_POST["email"];
    if (isset($_POST["email"])){ // reaching via HTTP Post...
      //process login form
      if ($this->usuarioMapper->isValidUser($_POST["passwd"], $_POST["email"])==1) {

	$_SESSION["currentuser"]= $_POST["email"];


	$this->view->redirect("usuario", "register");

      }else{
	$errors = array();
	$errors["general"] = "Username is not valid";
	$this->view->setVariable("errors", $errors);
      }
    }

    // render the view (/view/usuario/login.php)
    $this->view->render("usuario", "login");
  }

 /**
   * Action to register
   *
   * When called via GET, it shows the register form.
   * When called via POST, it tries to add the user
   * to the database.
   *
   * The expected HTTP parameters are:
   * <ul>
   * <li>login: The username (via HTTP POST)</li>
   * <li>passwd: The password (via HTTP POST)</li>
   * </ul>
   *
   * The views are:
   * <ul>
   * <li>users/register: If this action is reached via HTTP GET (via include)</li>
   * <li>users/login: If login succeds (via redirect)</li>
   * <li>users/register: If validation fails (via include). Includes these view variables:</li>
   * <ul>
   *  <li>user: The current User instance, empty or being added
   *  (but not validated)</li>
   *  <li>errors: Array including validation errors</li>
   * </ul>
   * </ul>
   *
   * @return void
   */
  public function register() {

    $user = new Usuario();

    if (isset($_POST["username"])){ // reaching via HTTP Post...

      // populate the User object with data form the form
      $user->setNombre($_POST["username"]);
      $user->setPassword($_POST["passwd"]);
      $user->setEmail($_POST["email"]);

      $foto=($_FILES["foto"]);
      $subir= new imgUpldr();

      $randomString=$this->generateRandomString(15);

      $ruta = "img/Usuarios/$randomString";
      $subir->_dest= "img/Usuarios/";
      $subir->_name= "$randomString";
      $subir->init($foto);
      $user->setFoto($ruta);


	    $this->usuarioMapper->save($user);


	  $this->view->setFlash("Username ".$user->getNombre()." successfully added. Please login now");


    }

    // Put the User object visible to the view
    $this->view->setVariable("user", $user);

    // render the view (/view/users/register.php)
    $this->view->render("usuario", "register");

  }
  function generateRandomString($length) {
          return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
      }

 /**
   * Action to logout
   *
   * This action should be called via GET
   *
   * No HTTP parameters are needed.
   *
   * The views are:
   * <ul>
   * <li>users/login (via redirect)</li>
   * </ul>
   *
   * @return void
   */
  public function logout() {
    session_destroy();

    // perform a redirection. More or less:
    // header("Location: index.php?controller=users&action=login")
    // die();
    $this->view->redirect("Usuario", "login");

  }

}
