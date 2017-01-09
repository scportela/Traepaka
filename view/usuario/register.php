<?php
 //file: view/users/register.php
//CAMBIAR COSAS Y AÑADIR LAS CLASES PARA MOSTRAR EL FORMULARIO BONITO
 require_once(__DIR__."/../../core/ViewManager.php");
 require_once(__DIR__ . "/../../core/I18n.php");


 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $user = $view->getVariable("user");
 $view->setVariable("title", "Registro");
?>
<h1><?= i18n("Register")?></h1>
<form class= "contacto" enctype="multipart/form-data" action="index.php?controller=usuario&amp;action=register" method="POST">
  <div>
    <label><?= i18n("Username")?>:</label><input type='text' name="username" value=''>
  </div>
  <div>
    <label>Email:</label><input type='text' name="email" value=''>
  </div>
  <div>
    <label><?= i18n("Password")?>:</label><input type='password'name="passwd" value=''>
  </div>
  <div>
    <label><?= i18n("Photo")?>:</label><input type='file' name="foto" value=''>
  </div>
    <input type="submit" value="<?= i18n("Register")?>">
  </div>
</form>
