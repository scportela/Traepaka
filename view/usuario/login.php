<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__ . "/../../core/I18n.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Login");
$errors = $view->getVariable("errors");
?>
<div class="centrado">
<h1><?= i18n("Login") ?></h1>
<?= isset($errors["general"])?$errors["general"]:"" ?>



    <form class= "contacto" action="index.php?controller=usuario&amp;action=login" method="POST">

      <div>
        <label>Email:</label><input type='text' name="email" value=''>
      </div>
      <div>
        <label><?= i18n("Password")?></label><input type='password' name="passwd" value=''>
      </div>
      	<input type="submit" value="<?= i18n("Login") ?>">
      </div>
    </form>

</div>
<p><?= i18n("Not user?")?> <a href="index.php?controller=usuario&amp;action=register"> <?= i18n("Register here!")?> </a></p>
<?php $view->moveToFragment("css");?>
<link rel="stylesheet" src="css/style2.css">
<?php $view->moveToDefaultFragment(); ?>
