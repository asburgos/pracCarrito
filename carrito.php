<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL ^ E_NOTICE);
require_once 'compras.class.php';

$compras = new carrito();
echo json_encode($compras->crearTablaProductos($compras->leerScv()));

