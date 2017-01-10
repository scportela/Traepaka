<?php
 require_once(__DIR__."/../../core/ViewManager.php");
 require_once(__DIR__ . "/../../core/I18n.php");


 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $user = $view->getVariable("currentuser");
?>
<h1>Nuevo Producto</h1>
<form class="contacto" enctype="multipart/form-data" action="index.php?controller=producto&amp;action=nuevoProducto" method="POST">
  <div>
    <label><?= i18n("Title") ?>:</label><input type='text' name="titulo" value=''>
  </div>
  <div>
    <label><?= i18n("Description") ?>:</label><input type='text' name="descripcion" value=''>
  </div>
  <div>
    <label><?= i18n("Price") ?></label><input type='text'name="precio" value=''>
  </div>
  <div>
    <label><?= i18n("Photo") ?></label><input type='file' name="foto" id="foto">
  </div>
    <input type="submit" value="<?= i18n("New Item") ?>">
  </div>
</form>
