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
            <?php foreach ($lineas as $linea): ?>
                <?php if ($user->getEmail() == $linea->getEmailUsuarioEnvia()): ?>
              <div class="mensajeEnviado">
                  <p><?= $linea->getMensaje(); ?></p>
              </div>
                <?php else: ?>
              <div class="mensajeRecibido">
                  <p><?= $linea->getMensaje(); ?></p>
              </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="enviar">
          <form>
              <input type="hidden" id="idchat" value="<?= $chat->getId(); ?>"/>
            <input type="text" id="texto" placeholder="Enviar..."></input>
            <input type="submit" value="Enviar!">
          </form>
        </div>
      </div>
      <div class="producto">
        <div class="imagen">
            <img class="imageChat" src="<?= $producto[0]->getFoto(); ?>">
        </div>
        <div class= "descripcion">
            <?= $producto[0]->getDescripcion(); ?>
        </div>
        <div class= "precio">
            <?= $producto[0]->getPrecio(); ?>
        </div>
      </div>

    </div>
   </article>
