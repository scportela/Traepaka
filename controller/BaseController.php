<?php
//file: controller/BaseController.php

require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/Usuario.php");

/**
 * Class BaseController
 *
 * Implements a basic super constructor for
 * the controllers in the Blog App.
 * Basically, it provides some protected
 * attributes and view variables.
 *
 * @author  MO
 */
class BaseController {

  /**
   * The view manager instance
   * @var ViewManager
   */
  protected $view;

  /**
   * The current user instance
   * @var User
   */
  protected $currentUser;

  public function __construct() {

    $this->view = ViewManager::getInstance();

    // get the current user and put it to the view
    /*
    if (session_status() == PHP_SESSION_NONE) {
	     session_start();
    }*/

    if(isset($_SESSION["currentuser"])) {

      $this->currentUser = new Usuario($_SESSION["currentuser"]);
      //add current user to the view, since some views require it
      $this->view->setVariable("currentuser",
				  $this->currentUser->getEmail());
      $this->view->setVariable("currentuser",
    				  $this->currentUser);
    }
  }
}
