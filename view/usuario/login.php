<?php
//file: view/users/login.php
//AQUI HABRA QUE TOCAR PARA QUE EL USUARIO META TB EL EMAIL?
require_once(__DIR__."/../../core/ViewManager.php");

$view = ViewManager::getInstance();
$view->setVariable("title", "Login");
$errors = $view->getVariable("errors");
?>
<div class="centrado">
<h1>Login</h1>
<?= isset($errors["general"])?$errors["general"]:"" ?>



    <form class= "contacto" action="index.php?controller=usuario&amp;action=login" method="POST">

      <div>
        <label>Tu Email:</label><input type='text' name="email" value=''>
      </div>
      <div>
        <label>Contraseña</label><input type='password' name="passwd" value=''>
      </div>
      	<input type="submit" value="Login">
      </div>
    </form>

</div>
<p>¿No estas registrado?  <a href="index.php?controller=usuario&amp;action=register"> Registrarse </a></p>
<?php $view->moveToFragment("css");?>
<link rel="stylesheet" src="css/style2.css">
<?php $view->moveToDefaultFragment(); ?>
