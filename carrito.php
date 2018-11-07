<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL ^ E_NOTICE);
require_once 'carrito.class.php';

$compras = new carrito();
if($_POST['accion']== "listar"){
    echo json_encode($compras->crearTablaProductos($compras->leerScv()));
}
if($_POST['accion']== "anadir"){
    $cantidad = 1;
    $datas = [$_POST['id'],$_POST['nombre'],$_POST['precio'],$cantidad];
    echo json_encode(array("html"=>$compras->insertaCarrito($datas)));
}