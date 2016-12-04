<?php
 require_once(__DIR__."/../../core/ViewManager.php");

 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $user = $view->getVariable("currentuser");
 $productos = $view->getVariable("unProducto");
 $view->setVariable("title", "Registro");
?>
<?php foreach($productos as $producto){ ?>
<h1><?php echo $producto->getTitulo(); ?></h1>
<div class="contacto">
<img class="Dimg" src="<?php echo $producto->getFoto(); ?>">
    <div class="articulo test">
        <h2> <?php echo $producto->getEmail(); ?> </h2>

        <div class="precio">
          <?php echo $producto->getPrecio(); ?> €
        </div>
        <div class= "descripcion">
          <?php echo $producto->getDescripcion(); ?>
        </div>
        <?php
        if($user->getEmail()!= $producto->getEmail()){ ?>

        <a href="index.php?controller=chat&amp;action=crear&amp;emailvendedor=<?php echo $producto->getEmail() ?>&amp;id_articulo=<?php echo $producto->getId() ?> ">
        <button class="btn btn-success btn-block" >
          <i class="fa fa-comment" aria-hidden="true"></i>
           ¡ Iniciar chat !
        </button>
      </a>
      <?php } ?>

   </div>
 </div>
 <?php } ?>
