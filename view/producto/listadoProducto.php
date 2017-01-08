<?php
 require_once(__DIR__."/../../core/ViewManager.php");
 require_once(__DIR__ . "/../../core/I18n.php");


 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $user = $view->getVariable("currentuser");
 $productos = $view->getVariable("producto");
 $view->setVariable("title", "Registro");
?>
<article id="maincontent">
    <?php foreach ($productos as $producto): ?>
    <a href="index.php?controller=producto&amp;action=detalleProducto&amp;id=<?php echo $producto->getId() ?> ">
    <div class="articulo">
      <div class="articuloContent">
        <p> <?php echo $producto->getTitulo(); ?> </p>
        <img class="imgVP" src="<?php echo $producto->getFoto(); ?>">
        <div class= "precio">
          <?php echo $producto->getPrecio(); ?>
        </div>
        <div class= "descripcion">
          <?php echo $producto->getDescripcion(); ?>
        </div>
          <?php
          if ($user != NULL):
              if ($user->getEmail() != $producto->getEmail()): ?>

        <button class="btn btn-success btn-block" type="submit">
          <i class="fa fa-comment" aria-hidden="true"></i>
           <?= i18n("Chat !") ?>
        </button>
              <?php endif;
          endif; ?>

      </a>
      </div>
   </div>
 </a>
    <?php endforeach; ?>
</article>
