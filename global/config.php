<?php
	
define("SERVIDOR", "localhost");
define("USUARIO", "root");
define("PASSWORD", "");
define("BD", "reyzone_onlineshop");
define("KEY_TOKEN", "ABC.asd-354*");
define("CLIENT_ID", "AdRq6__nTdExz2koeRaqraReBhrkq-TSjLF4COXrRndCqGXj7vuXDlu5yUrNs4rVdwDpfUHxHq5XFn7G");
define("CURRENCY", "MXN");
define("MONEDA", "$");

session_start();

$num_cart = 0;
if(isset($_SESSION['carrito']['productos'])){
    $num_cart = count($_SESSION['carrito']['productos']);

}

?>