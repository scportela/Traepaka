<?php
// Controlador de Usuarios

require_once '../Model/Pincho.php';
require_once '../Model/Ingrediente.php';
require_once '../Model/Establecimiento.php';
require_once '../Model/Comentario.php';
require_once 'ActualizadorController.php';
require_once '../Recursos/class_imgUpldr.php';

$subir= new imgUpldr;


//die(var_dump($_REQUEST));

$evento = $_REQUEST['evento'];

switch ($evento) {

//crea un pincho nuevo en el sistema
    case 'registrarPincho':
        $nombEst=$_SESSION["nombreUsuario"];
        $id= new Pincho("","","","","","","","","","","");
        $newid=$id->nextIDPincho();

        //coge el valor de los checkbox del formulario
        if(isset($_POST["checkbox1"])){
            $check1=1;
        }else{
            $check1=0;
        }
        if(isset($_POST["checkbox2"])){
            $check2=1;
        }else{
            $check2=0;
        }
        if(isset($_POST["checkbox3"])){
            $check3=1;
        }else{
            $check3=0;
        }
	//Imagen por defecto
        if (empty($_FILES['perfilPincho']['name'])) {
          $pincho = new Pincho($newid,$_POST["descripcion"],$_POST["precio"],$_POST["nombre"],0,$check1,
              $check2,$check3,$_POST["descripInteres"],'ramon',$nombEst,"../Recursos/img/Pincho.jpg");
          $pincho->AltaPincho();

        } else {
	//Cuando hay una sola imagen
          $nombre=$_POST["nombre"];
          $var= "$nombre";
          $ruta = "../Recursos/img/Pinchos/$var";
	//$subir variable global de la clase que maneja imagenes
	//_dest es ruta del destino de la imagen
	//_name es el nombre con el que queremos que se guarde la imagen
	//para redimensionar seria con _width y _height dandoles valores numericos.
          $subir->_dest= "../Recursos/img/Pinchos/";
          $subir->_name= "$nombre";
	//llamamos a init para realizar la subida
          $subir->init($_FILES['perfilPincho']);
	//Finalmente creamos el objeto pincho en la bd
          $pincho = new Pincho($newid,$_POST["descripcion"],$_POST["precio"],$_POST["nombre"],0,$check1,
              $check2,$check3,$_POST["descripInteres"],'ramon',$nombEst,$ruta);
          $pincho->AltaPincho();
	//varias imagenes
          if (!empty($_FILES['file']['name'])) {
            for($x=0; $x<count($_FILES["file"]["name"]); $x++){
              //Creamos el objeto de la clase que maneja las imagenes
	            $up = new imgUpldr;
              $file = $_FILES["file"];
              $var = $nombre;
              $aux=$file["name"][$x];

              $ruta = "../Recursos/img/Usuarios/$var/$aux";
              $up->_name=$file["name"][$x];
              $up->_dest= "../Recursos/img/Usuarios/$nombre/";

              $img["size"] = $file["size"][$x];
              $img["tmp_name"] = $file["tmp_name"][$x];
              $img["type"] = $file["type"][$x];
              $img["error"] = $file["error"][$x];

              $up->init($img);

              $pincho->altaFotos($ruta);
            }
          }
        }



        //registra el pincho en la bd
        $i=0;
        while (isset($_POST["ingre$i"])) {
          //recoge los ingredientes del formulario
          $ingrepp= new Ingrediente($newid,$_POST["ingre$i"]);
          //añade ingredientes al pincho
          $ingrepp->AltaIngrediente();
          $i++;
        }



      //$pincho->ConsultarPincho();
      actualizarEstablecimiento();
      header("location: PinchoController.php?evento=consultarPinchoEst");
  break;


    case 'listarAsignar':
      $lista = new Pincho("","","","","","","","","","","");
      $lista->listarPinchoA();
      header("location: ../View/AsignarPinchoJPro.php");
      break;

    case 'semifinal':
      $pincho = new Pincho("","","","","","","","","","","");
      $pincho->asignarPincho($_POST["idPincho1"],$_POST["jPro2"],"ramon");
      header("location: JuradoProfesionalController.php?evento=asignarPincho");
      break;

    //consulta un pincho ya existente de un establecimiento en el sistema
    case 'consultarPinchoEst':
        $claveEstablecimiento=$_SESSION['nombreUsuario'];
        $pincho = new Pincho('','','','','','','','','','',$claveEstablecimiento); //Foto avatar, a revisar.
        $pincho->ConsultarPinchoEst();

        $id = $_SESSION["ConsultarPincho"];
        foreach ($id as $key) {
            $ingrediente = new Ingrediente($key['idPincho'],'');
            //$ingrediente->ListarIngredientes();
            $id1=$key['idPincho'];
        }
        $ingrediente->ListarIngredientes();


        header("location: PinchoController.php?evento=consultarPincho&idPincho=$id1");
    break;

    //modificar
    //consulta un pincho ya existente en el sistema
    case 'consultarPincho':
        $idPincho=$_REQUEST["idPincho"];
        $pincho = new Pincho($idPincho,'','','','','','','','','',''); //Foto avatar, a revisar.
        $pincho->ConsultarPincho();

        $ingre = new Ingrediente($idPincho,'');
        $ingre->ListarIngredientes();

        $comentario = new Comentario($idPincho,'','','');
        $comentario->listarComentarios();

        header("location: ../View/consultarPincho.php");
    break;
//modificar un pincho
    case 'modificarPincho':

        $idPincho=$_SESSION["nombreUsuario"];//el valor del idPincho es la clave del estblecimiento

        //coge el valor de los checkbox del formulario
        if(isset($_POST["checkbox1"])){
            $check1=1;
        }else{
            $check1=0;
        }
        if(isset($_POST["checkbox2"])){
            $check2=1;
        }else{
            $check2=0;
        }
        if(isset($_POST["checkbox3"])){
            $check3=1;
        }else{
            $check3=0;
        }
        $pincho = new Pincho($idPincho,$_POST["descripcion"],$_POST["precio"],$_POST["nombre"],0,$check1,
            $check2,$check3,$_POST["descripInteres"],'',''); //Foto avatar, a revisar.

        //$ingre= new Ingrediente($nombEst,$_POST["ingrediente"]);

        $pincho->ModificarPincho($idPincho);

       // $ingre->ModificarIngrediente();

        header("location: PinchoController.php?evento=consultarPinchoEst");
    break;



    case 'generarCodigo':
      $claveEstablecimiento=$_SESSION['nombreUsuario'];
      $pincho = new Pincho('','','','','','','','','','',$claveEstablecimiento);
      $pincho->ConsultarPinchoEst();
      $numCod=$_POST["Codigo"];
      $id = $_SESSION["ConsultarPincho"];

      foreach ($id as $key) {
        $pincho = new Pincho($key['idPincho'],'','',$key['nombrePincho'],'','','','','','',$claveEstablecimiento);
      }
      $codigo=array();
      for ($i=0; $i < $numCod ; $i++) {
        $cod=$pincho->generarCodigo();
        array_push($codigo,$cod);
      }
      $_SESSION['codigos']=$codigo;
      header("location: ../View/listarCodigo.php");
      break;

    case 'consultarPinchoYEstablecimiento':
        $id = $_POST["idPincho"];
        $pincho = new Pincho($id,'','','','','','','','','',''); //Foto avatar, a revisar.
        $pincho->ConsultarPincho();

        $ingrediente = new Ingrediente($id,'');
        $ingrediente->ListarIngredientes();

        $Usuario = new Establecimiento($_POST["establecimiento"],"","","","","","","","");
        $Usuario->ConsultarEstablecimiento();


        header("location: ../View/validarPincho.php");
        break;

    case 'listarPinchosValidar':

        $pincho = new Pincho('','','','','','','','','','','');
        $pincho->listarPinchos();
        $pincho->contarValidar();

        header("location: ../View/listarValidarPinchos.php");
        break;

    case 'validarPincho':
        $idPincho=$_POST['idPincho'];
        $pincho = new Pincho($idPincho,'','','',1,'','','','','','');
        $pincho->ValidarPincho();
        //$pincho->contarValidar();

        header("location: PinchoController.php?evento=listarPinchosValidar");
        break;

    case 'listarPinchos':

        $pincho = new Pincho('','','','','','','','','','','');
        $pincho->listarPinchos();

        header("location: ../View/listarPinchos.php");
        break;

    case 'crearFolleto':
        $pincho = new Pincho('','','','','','','','','','','');
        $pincho->listarPinchos();
        $_SESSION["cFolleto"] = array();

        header("location: ../View/crearFolleto.php");
    break;

    case 'guardarFolleto':
        //echo $_POST["idPincho"];
        array_push($_SESSION["cFolleto"],$_POST["idPincho"]);



        header("location: ../View/crearFolleto.php");
    break;

    case 'mostrarFolleto':

          $id=$_SESSION["cFolleto"];
          //var_dump($_SESSION["cFolleto"]);
          //$_SESSION["MFolleto"]=array();
          $tempo = array();
          foreach ($id as $value) {
            $pincho = new Pincho($value,'','','','','','','','','','');
            //array_push($tempo,$pincho->consultarFolleto());
            array_push($tempo,$pincho->consultarFolleto());
          }
          $_SESSION["MFolleto"] = $tempo;


          $pincho = new Pincho('','','','','','','','','','','');
          $pincho->consultarFolleto();


          header("location: ../View/consultarFolleto.php");
    break;

    case 'validarCodigo1':
      $cod = $_POST["codigo"];
      $pincho = new Pincho('','','','','','','','','','','');
      $var=$pincho->validarCodigo($cod);
      $_SESSION["cod1"]=$cod;
      if ($var=="NOVALIDO") {
        header("location: ../View/votacionJPopular.php?llave1=NO1");
      } else {
        $_SESSION["P1"]=$pincho->consultarPinchoVoto($var["idPincho"]);
        header("location: ../View/votacionJPopular.php?llave1=ok");
      }
      break;


    case 'validarCodigo2':
      $cod = $_POST["codigo"];
      $pincho = new Pincho('','','','','','','','','','','');
      $var=$pincho->validarCodigo($cod);
      $_SESSION["cod2"]=$cod;
      if ($var=="NOVALIDO") {
        header("location: ../View/votacionJPopular.php?llave2=NO2&llave1=ok");
      } else if ($_SESSION["cod2"] == $_SESSION["cod1"]) {
        header("location: ../View/votacionJPopular.php?llave2=NO2&llave1=ok");
      } else {
        $_SESSION["P2"]=$pincho->consultarPinchoVoto($var["idPincho"]);
        header("location: ../View/votacionJPopular.php?llave2=ok&llave1=ok");
      }
      break;

    case 'validarCodigo3':
      $cod = $_POST["codigo"];
      $pincho = new Pincho('','','','','','','','','','','');
      $var=$pincho->validarCodigo($cod);
      $_SESSION["cod3"]=$cod;
      if ($var=="NOVALIDO") {
        header("location: ../View/votacionJPopular.php?llave3=NO3&llave2=ok&llave1=ok");
      } else if ($_SESSION["cod2"] == $_SESSION["cod3"] || $_SESSION["cod3"] == $_SESSION["cod1"]) {
        header("location: ../View/votacionJPopular.php?llave3=NO3&llave2=ok&llave1=ok");
      } else {
        $_SESSION["P3"]=$pincho->consultarPinchoVoto($var["idPincho"]);
        header("location: ../View/votacionJPopular.php?llave3=ok&llave2=ok&llave1=ok");
      }
      break;

    case 'carrusel':
      $pincho = new Pincho('','','','','','','','','','','');
      $pincho->carrusel();
      header("location: ../View/home.php");

      break;


    case 'AlataComentario':

        $idUsu=$_SESSION["nombreUsuario"];
        $nComent= new Comentario("","","","");
        $newid=$nComent->nextIDComent();

        $id=$_POST["idPincho"];
        $comentario = new Comentario($id,$newid,$idUsu,$_POST["comentario"]);
        $comentario->altaComentario($newid);

        header("location: PinchoController.php?evento=consultarPincho&idPincho=$id");
        break;


    case 'BajaComentario':
        $nComent = $_POST['nComentario'];
        $comentario = new Comentario('',$nComent,'','');
       $comentario->bajaComentario($nComent);

        header("location: ../View/consultarPincho.php");
     break;

    case 'listarComentarios':

        $idPincho=$key['idPincho'];
        $comentario = new Comentario($idPincho,'','','');
        $comentario->listarComentarios();

        //header("location: ../View/listarPinchos.php");
     break;

    default:
      $name=$_REQUEST['jPro'];
      $pincho = new Pincho('','','','','','','','','','','');
      $pincho->actualizarPinchos($name);
      header("location: ../View/AsignarPinchoJPro.php?name=$name");
      break;
}

?>
