<?php
  //file: view/users/login.php
  require_once(__DIR__."/../../core/ViewManager.php");
  require_once(__DIR__ . "/../../core/I18n.php");

  $view = ViewManager::getInstance();
  $view->setVariable("title", "listadoChats");
  $errors = $view->getVariable("errors");
  $chats = $view->getVariable("chat");
  $user = $view->getVariable("currentuser");
?>
<div class="row contenidolistado">
    <div class="listadoChats col-md-12">
       <?php foreach($chats as $chat):?>

           <div class="chatLista  col-md-12">
           <?php if ($user->getEmail()==$chat->getEmailUsuarioComprador() ): ?>

               <div class="imagenPerfil">
                   <?php if ($chat->getNumeroMensajesSinLeer() != 0): ?>
                       <div class="notificacion"><span> <?= $chat->getNumeroMensajesSinLeer() ?></span></div>
                   <?php endif; ?>
               <img src="<?php echo $chat->getFotoUsuario(); ?>">
             </div>
             <div class="vistaPreliminarChat">
                 <a href="index.php?controller=chat&amp;action=chat&amp;id=<?= $chat->getId(); ?>">
                     <div class="ultimoMensaje">
                         <p><?php
                             if ($chat->getUltimoMensaje() == NULL) {
                                 echo "No hay mensajes para este chat";
                             } else {
                                 echo $chat->getUltimoMensaje();
                             }
                             ?></p>
                     </div>
                 </a>
               <div class="horaMensaje">
                   <p><?php if ($chat->getUltimoMensaje() != NULL) {
                           echo $chat->getFechaHoraUltimoMensaje();
                       } ?></p>
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
                 <?php if ($chat->getNumeroMensajesSinLeer() != 0): ?>
                     <div class="notificacion"><span> <?= $chat->getNumeroMensajesSinLeer() ?></span></div>
                 <?php endif; ?>
               <img src="<?php echo  $chat->getFotoUsuario(); ?>">
             </div>
             <div class="vistaPreliminarChat">
                 <a href="index.php?controller=chat&amp;action=chat&amp;id=<?= $chat->getId(); ?>">
                     <div class="ultimoMensaje">
                         <p><?php
                             if ($chat->getUltimoMensaje() == NULL) {
                                 echo "No hay mensajes para este chat";
                             } else {
                                 echo $chat->getUltimoMensaje();
                             } ?></p>
                     </div>
                 </a>
               <div class="horaMensaje">
                   <p><?php if ($chat->getUltimoMensaje() != NULL) {
                           echo $chat->getFechaHoraUltimoMensaje();
                       } ?></p>
               </div>

             </div>
           <?php endif; ?>
         </div>
       <?php endforeach; ?>
     </div>
   </div>
