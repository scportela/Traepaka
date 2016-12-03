<?php
 //file: view/layouts/default.php
 ini_set("display_errors",1);
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $currentuser = $view->getVariable("currentuser");

?>
<!DOCTYPE html>
<html>
  <head>

    <title>TRAEPAKÁ</title>

    <meta http-equiv="Content-Type" content="text/HTML; charset=utf8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/mediaQuerisMax.css">

          <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

      <!-- Optional theme -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

      <!-- Latest compiled and minified JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>



      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

    <script src="../js/nav.js"></script>

  </head>
  <body>
    <!-- header -->
    <header>



        <ul class="topnav" id="myTopnav">
           <li class="header_logo"><img src="img/logo.png"/></li>

           <li class="header_busqueda">
             <form class="b-header-busqueda">
               <input class="b-redondo b-header-busqueda" placeholder="Busca tu producto..." type="text">
             </form>
           </li>



               <ul class="header_usuario">

                 <?php if (isset($currentuser)): ?>

                   <li class="header_botones ">
                     <img src="img/anadir.png"/>
                   </li>
                   <li class="header_botones">
                     <button class="b-redondo b-header" type="button" name="button"> Chat </button>
                   </li>
                   <li class="header_botones">
                     <button class="b-redondo b-header" type="button" name="button"> Mi perfil</button>
                   </li>
                   <li>
                     <i class="about fa fa-question-circle fa-2x" aria-hidden="true"></i>
                   </li>
                   <li class="icon">
                     <a href="javascript:void(0);" onclick="myFunction()">&#9776;</a>
                   </li>

                <?php else: ?>

                <form action="index.php?controller=usuario&amp;action=login" method="POST">
                  <li class="header_botones">
                    <button class="b-redondo b-login" name="button">Login!</button>
                  </li>
                </form>
                <?php endif ?>

             </ul>


       </ul>



    </header>

    <main>
      <div id="flash">
	       <?= $view->popFlash() ?>
      </div>
      <?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
    </main>

    <!--<footer>
      <?php
      include(__DIR__."/language_select_element.php");
      ?>
    </footer>-->

  </body>
</html>