<?php
include("./basededatos/config.php");
function connect_db(){
    $connect = new PDO("mysql:host=" . DB_HOST .";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASSWORD);
    return $connect;
}

function get_redirect(){
  if(isset($_GET['redirect'])){
    $URI = urldecode($_GET['redirect']);
  }else{
    $URI = $_SERVER['REQUEST_URI'];
  }

  $redirect = str_replace("state=exclusive", "state=normal", $URI);

  return urlencode($redirect);
}
?>
