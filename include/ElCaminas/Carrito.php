<?php

namespace ElCaminas;
use \PDO;
use \ElCaminas\Producto;
class Carrito
{
    protected $connect;
    /** Sin parámetros. Sólo crea la variable de sesión
    */
    public function __construct()
    {
        global $connect;
        $this->connect = $connect;
        if (!isset($_SESSION['carrito'])){
            $_SESSION['carrito'] = array();
        }

    }
    public function addItem($id, $cantidad){
        $_SESSION['carrito'][$id] = $cantidad;
    }
    public function deleteItem($id){
      unset($_SESSION['carrito'][$id]);
    }
    public function empty(){
      unset($_SESSION['carrito']);
      self::__construct();
    }
    public function howMany(){
      return count($_SESSION['carrito']);
    }

    public function getTotal(){
      $total=0;
      if ($this->howMany() > 0){
        foreach($_SESSION['carrito'] as $key => $cantidad){
          $producto = new Producto($key);
          $subtotal = $producto->getPrecioReal() * $cantidad;
          $total += $subtotal;
        }
      }
      return $total;
    }
    public function toHtml(){
      //NO USAR, de momento
      $str = <<<heredoc
      <table class="table">
        <thead> <tr> <th>#</th> <th>Producto</th> <th>Cantidad</th> <th>Precio</th> <th>Total</th> <th></th></tr> </thead>
        <tbody>
heredoc;
      $total = 0.00;
      $redirigir="/tienda2/index.php";
      if(isset($_GET['redirect'])){
        $redirigir=$_GET['redirect'];
      }
      if ($this->howMany() > 0){
        $i = 0;
        foreach($_SESSION['carrito'] as $key => $cantidad){
          $producto = new Producto($key);
          $i++;
          $subtotal = $producto->getPrecioReal() * $cantidad;
          $subtotalTexto = number_format($subtotal , 2, ',', ' ') ;
          $str .=  "<tr><th scope='row'>$i</th><td><a href='" .  $producto->getUrl() . "'>" . $producto->getNombre();
          $str .= "</a> <a class='open-modal' href=" .$producto->getUrl() . "><span class='fa fa-external-link' style='color:#000;'></a></td>";
          $str .= "<td>$cantidad</td><td>" .  $producto->getPrecioReal() ." €</td>";
          $str .= "<td>$subtotalTexto €</td><td><a href='carro.php?redirect=".urlencode($redirigir)."&action=delete&id=$key' onclick='return checkDelete();'><span class='fa fa-trash'></a></td></tr>";
        }
      }
      $total = $this->getTotal();
      $totalTexto = number_format($total , 2, ',', ' ') ;
      $str .= <<<heredoc
          <tr><td colspan=3></td><th scope='row'>Precio Total</th><td colspan=2>$totalTexto €</td></tr>
        </tbody>
      </table>
heredoc;
      return $str;
    }
}
