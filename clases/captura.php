<?php
	
include 'global/config.php';
include 'global/conexion.php';


$json=file_get_contents('php://input');
$datos=json_decode($json, true);

print_r($datos);

if(is_array($datos)){

    $id_transaccion = $datos['detalles'];
}