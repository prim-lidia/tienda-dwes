<?php
  session_start();
  include("./include/funciones.php");
  $connect = connect_db();

  $title = "Plantas el Caminàs -> ";
  $sinMenu = true;
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
  $redirigir="/tienda2/index.php";

  if(isset($_GET['redirect'])){
    $redirigir=$_GET['redirect'];
    echo $_GET['redirect'];
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


<div class="col-md-8 col-xs-offset-2">
  <div class="row carro">
    <h2 class='subtitle' style='margin:0'>Resúmen de la compra</h2>
    <?php  echo $carrito->toHtml();
    ?>
  </div>
  <div class="row">
    <br>
    <p class="pull-right">
      <a id="paypal-button-container" style="display:inline;"></a>
    </p>
  </div>

  <script src="https://www.paypalobjects.com/api/checkout.js"></script>

<!--<div id="paypal-button-container"></div>-->

<script>
        paypal.Button.render({

            env: 'sandbox', // sandbox | production

            // PayPal Client IDs - replace with your own
            // Create a PayPal app: https://developer.paypal.com/developer/applications/create
            client: {
                sandbox:    'AURtFahgo3cuV-8J35gOhzh0AhTk36fnkHRkuGs-ZBiDoRdzd4NGvRDFFvzkCqmoU3puoZ3FOyS2zkDX',
                production: '<insert production client id>'
            },

            // Show the buyer a 'Pay Now' button in the checkout flow
            commit: true,

            // payment() is called when the button is clicked
            payment: function(data, actions) {

                // Make a call to the REST api to create the payment
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: { total: '<?php echo $carrito->getTotal();?>', currency: 'EUR' }
                            }
                        ]
                    }
                });
            },

            // onAuthorize() is called when the buyer approves the payment
            onAuthorize: function(data, actions) {

                // Make a call to the REST api to execute the payment
                return actions.payment.execute().then(function() {
                    window.alert('Payment Complete!');
                    window.location.href = "./gracias.php";
                });
            }

        }, '#paypal-button-container');

    </script>
<?php
include("./include/footer.php");
?>
