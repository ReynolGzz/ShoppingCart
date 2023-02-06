<?php 
require '../global/config.php';

//El carrito se agrega de acuerdo al numero de articulos, no por cantidad de productos
if(isset($_POST['id'])){

    $id = $_POST['id'];
    $token = $_POST['token'];

    $token_tmp= hash_hmac('sha1', $id, KEY_TOKEN);

    if($token==$token_tmp){

            if(isset($_SESSION['carrito']['productos'][$id])){

                $_SESSION['carrito']['productos'][$id] += 1;
            }else{
                $_SESSION['carrito']['productos'][$id] = 1;
            }

            $datos['numero'] = count($_SESSION['carrito']['productos']);
            $datos['ok'] = true;
        }else{

            $datos['ok'] = false;

        }
}else{

    $datos['ok'] = false;
}
echo json_encode($datos);
