<?php
  session_start();
  include("./include/funciones.php");
  $connect = connect_db();

  $title = "Plantas el Caminàs -> Carro de la compra";

  require './include/ElCaminas/Carrito.php';
  require './include/ElCaminas/Producto.php';
  require './include/ElCaminas/Productos.php';
  use ElCaminas\Carrito;

  $carrito = new Carrito();
  //Falta comprobar qué acción: add, delete, empty
  $action="view";

  if(isset($_GET['action'])){
    $action=$_GET['action'];

    switch($_GET['action']){
      case "add":
        $carrito->addItem($_GET["id"], 1);
        break;
      case "delete":
        $carrito->deleteItem($_GET["id"]);
        break;
      case "empty":
        $carrito->empty();
        break;
    }
  }

  include("./include/header.php");
  include("./include/ventanaModal.phtml");
  $redirigir="/tienda2/index.php";

  if(isset($_GET['redirect'])){
    $redirigir=$_GET['redirect'];
  }

?>
<script>
  function checkDelete(){
    if(confirm("¿Seguro que deseas eliminar este producto del carrito?")){
      return true;
    }else{
      return false;
    }
  }
</script>

<div class="col-md-9">
  <div class="row carro">
    <h2 class='subtitle' style='margin:0'>Carrito de la compra</h2>
    <?php  echo $carrito->toHtml();
    ?>
  </div>
  <div class="row">
    <br>
    <p class="pull-right">
      <a class="btn btn-danger" href="<?php echo urldecode($redirigir); ?>">Seguir comprando</a> <a class="btn btn-danger" href="checkout.php">Finalizar compra</a>
    </p>
  </div>
<?php
$bottomScripts = array();
$bottomScripts[] = "modalIframeProducto.js";
include("./include/footer.php");
?>
