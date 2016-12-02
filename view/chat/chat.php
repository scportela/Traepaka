<?php
  //file: view/users/login.php
  //AQUI HABRA QUE TOCAR PARA QUE EL USUARIO META TB EL EMAIL?
  require_once(__DIR__."/../../core/ViewManager.php");

  $view = ViewManager::getInstance();
  $view->setVariable("title", "Chat");
  $errors = $view->getVariable("errors");
  $lineas = $view->getVariable("lineaChat")
  $user = $view->getVariable("currentuser");
?>
   <article id="maincontentChat">

    <div class="chat">
      <div class="conversacion">
        <div class="mensajes">
          <?php foreach($lineas as $linea): ?>
            <?php if ($user==$linea->getEmailUsuarioEnvia() ): ?>
              <div class="mensajeEnviado">
                <p><?= $linea->getMensaje(); ?></p>
              </div>
            <?php else: ?>
              <div class="mensajeRecibido">
                <p><?= $linea->getMensaje(); ?></p>
              </div>
            <?php endif ?>
          <?php endforeach; ?>

        </div>
        <div class="enviar">
          <form>
            <input type="text" id="texto" placeholder="Enviar..."></input>
            <input type="submit" value="Enviar!">
          </form>
        </div>
      </div>
      <div class="producto">
        <div class="imagen">
          <img class="imageChat" src="../img/play4.jpg">
        </div>
        <div class= "descripcion">
         Playstation 4.
        </div>
        <div class= "precio">
         400€
        </div>
      </div>
    </div>
   </article>
