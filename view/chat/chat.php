<?php
  //file: view/users/login.php
  require_once(__DIR__."/../../core/ViewManager.php");

  $view = ViewManager::getInstance();
  $view->setVariable("title", "Chat");
  $errors = $view->getVariable("errors");
  $lineas = $view->getVariable("lineaChat");
  $chat = $view->getVariable("chat");
  $producto=$view->getVariable("producto");
  $user = $view->getVariable("currentuser");

?>
   <article id="maincontentChat">
    <div class="chat">
      <div class="conversacion">
        <div class="mensajes">
          <?php foreach($lineas as $linea){ ?>
            <?php if($user==$linea->getEmailUsuarioEnvia()){ ?>
              <div class="mensajeEnviado">
                <p><?php echo $linea->getMensaje(); ?></p>
              </div>
            <?php }else{ ?>
              <div class="mensajeRecibido">
                <p><?php echo $linea->getMensaje(); ?></p>
              </div>
            <?php } ?>
          <?php } ?>
        </div>
        <div class="enviar">
          <form>
            <input type="hidden" id="idchat" value="<?php echo $chat->getId(); ?>"/>
            <input type="text" id="texto" placeholder="Enviar..."></input>
            <input type="submit" value="Enviar!">
          </form>
        </div>
      </div>
      <?php foreach($producto as $productos){ ?>
      <div class="producto">
        <div class="imagen">
          <img class="imageChat" src="<?php echo $productos->getFoto(); ?>">
        </div>
        <div class= "descripcion">
         <?php echo $productos->getDescripcion(); ?>
        </div>
        <div class= "precio">
         <?php echo $productos->getPrecio(); ?>
        </div>
      </div>
      <?php } ?>

    </div>
   </article>
