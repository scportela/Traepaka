<?php
  //file: view/users/login.php
  //AQUI HABRA QUE TOCAR PARA QUE EL USUARIO META TB EL EMAIL?
  require_once(__DIR__."/../../core/ViewManager.php");
 ini_set("display_errors",1);
  $view = ViewManager::getInstance();
  $view->setVariable("title", "listadoChats");
  $errors = $view->getVariable("errors");
  $chats = $view->getVariable("chat");
  $user = $view->getVariable("currentuser");
?>
      <div class="col-md-2"></div>
   <div class="row col-md-8 col-sm-12 col-xs-12">
     <div class="listadoChats">
       <?php foreach($chats as $chat):?>
         <div class="chatLista">
           <?php if ($user->getEmail()==$chat->getEmailUsuarioComprador() ): ?>
             <div class="imagenPerfil">
               <div class="notificacion"><span>2</span></div>
               <img src="<?php echo $chat->getFotoUsuario(); ?>">
             </div>
             <div class="vistaPreliminarChat">
               <div class="ultimoMensaje">
                 <p><?php echo  $chat->getUltimoMensaje(); ?></p>
               </div>
               <div class="horaMensaje">
                 <p><?php echo  $chat->getFechaHoraUltimoMensaje(); ?></p>
               </div>
               <div class="opcionesChat">
                 <button class="b-redondo b-borrar" type="button" name="button"> Borrar Chat </button>
               </div>
             </div>
             <div class="imagenListaDer">
               <img src="<?php echo  $chat->getProducto()->getFoto(); ?>">
             </div>
           <?php else: ?>
             <div class="imagenListaIzq">
               <img src="<?php echo  $chat->getProducto()->getFoto(); ?>">
             </div>
             <div class="imagenPerfil">
               <img src="<?php echo  $chat->getFotoUsuario(); ?>">
             </div>
             <div class="vistaPreliminarChat">
               <div class="ultimoMensaje">
                 <p><?= $chat->getUltimoMensaje(); ?></p>
               </div>
               <div class="horaMensaje">
                 <p><?= $chat->getUltimoMensaje(); ?></p>
               </div>
               <div class="opcionesChat">
                 <button class="b-redondo b-borrar" type="button" name="button"> Borrar Chat </button>
               </div>
             </div>
           <?php endif; ?>
         </div>
       <?php endforeach; ?>
     </div>
   </div>
