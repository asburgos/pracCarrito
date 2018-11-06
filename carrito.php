<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL ^ E_NOTICE);
require_once 'carrito.class.php';

$compras = new carrito();
echo print_r($compras->leerScv());
//echo json_encode($compras->crearTablaProductos($compras->leerScv()));

