<?php
ini_set("display_errors", 1);
  //file: view/users/login.php
  require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__ . "/../../core/I18n.php");

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
            <?php
            foreach ($lineas as $linea):
                if (($user->getEmail() == $chat->getEmailUsuarioComprador() && $linea->getEnviadoComprador() == "1")
                    || ($user->getEmail() != $chat->getEmailUsuarioComprador() && $linea->getEnviadoComprador() == "0")
                ): ?>
              <div class="mensajeEnviado">
                  <p><?= $linea->getMensaje(); ?></p>
              </div>
                <?php else: ?>
              <div class="mensajeRecibido">
                  <p><?= $linea->getMensaje(); ?></p>
              </div>
                <?php endif;
            endforeach; ?>
        </div>
        <div class="enviar">
            <form action="index.php?controller=chat&amp;action=enviarMensaje" method="POST">
                <input type="hidden" name="idchat" value="<?= $chat->getId(); ?>"/>
                <input type="text" name="mensaje" placeholder="<?= i18n("Send your message...") ?>"></input>
            <input type="submit" value="<?= i18n("Send!") ?>!">
          </form>
        </div>
      </div>
      <div class="producto">
        <div class="imagen">
            <img class="imageChat" src="<?= $chat->getProducto()->getFoto(); ?>">
        </div>
        <div class= "descripcion">
            <?= $chat->getProducto()->getDescripcion(); ?>
        </div>
        <div class= "precio">
            <?= $chat->getProducto()->getPrecio(); ?>
        </div>
      </div>

    </div>
   </article>
