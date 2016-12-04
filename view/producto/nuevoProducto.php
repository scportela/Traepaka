<?php
 require_once(__DIR__."/../../core/ViewManager.php");

 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $user = $view->getVariable("currentuser");
?>
<h1>Nuevo Producto</h1>
<form class="contacto" enctype="multipart/form-data" action="index.php?controller=producto&amp;action=nuevoProducto" method="POST">
  <div>
    <label>Titulo:</label><input type='text' name="titulo" value=''>
  </div>
  <div>
    <label>Descripcion:</label><input type='text' name="descripcion" value=''>
  </div>
  <div>
    <label>Precio</label><input type='text'name="precio" value=''>
  </div>
  <div>
    <label>Foto</label><input type='file' name="foto" id="foto">
  </div>
  <?php $email=$user->getEmail(); ?>
  <input type="hidden" name="email" value="<?php echo $email; ?>">

    <input type="submit" value="Nuevo Producto">
  </div>
</form>
