<?php
  session_start();
  include("./include/funciones.php");
  $connect = connect_db();

  require './include/ElCaminas/Carrito.php';
  require './include/ElCaminas/Productos.php';
  require './include/ElCaminas/Producto.php';

  use ElCaminas\Carrito;
  use ElCaminas\Productos;
  use ElCaminas\Producto;
  $productos = new Productos();
  $carrito = new Carrito();

  try {
    $producto = $productos->getProductoById($_GET["id"]);
  }catch(Exception $e){
    http_response_code(404);
    exit();
  }
  $title = "TecnoCaminàs -> " . $producto->getNombre();

  $state = "normal";

  if(isset($_GET['state'])){
    $state = $_GET['state'];
  }
  if($state == "normal"){
    include("./include/header.php");
  }else if($state == "popup"){
    $urlCanonical = $producto->getUrl();
    include("./include/header-popup.php");
  } else if($state == "json"){
    echo $producto->getJson();
    exit();
  }

  include("./include/ventanaModal.phtml");

?>
<?php if($state == "normal"){ ?>
  <div class="col-md-9">
<?php }else if($state != "exclusive"){ ?>
  <div class="col-md-12">
<?php } ?>
  <div id= "infoProducto" class="row" style='position:relative; border:1px solid #ddd; border-radius:4px; padding:4px;' >
      <?php
        if($state == "normal" || $state == "exclusive"){
          echo $producto->getHtml();
        }else{
          echo $producto->getHtmlPopup();
        }
       ?>
  </div>
  <?php if($state == "normal"): ?>
  <div class="row">
    <h2 class='subtitle'>También te puede interesar...</h2>
    <?php
      foreach($productos->getRelacionados($producto->getId(),  $producto->getIdCategoria()) as $producto){
         echo $producto->getThumbnailHtml();
      }
    ?>
  </div>
<?php endif ?>

<?php
$bottomScripts = array();
$bottomScripts[] = "loadProducto.js";
$bottomScripts[] = "modalDomProducto.js";
if ("normal" == $state){
    include("./include/footer.php");
}else if("popup" == $state){
    include("./include/footer-popup.php");
}
?>
