<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL ^ E_NOTICE);
require_once 'carrito.class.php';
$compras = new carrito();
if($_POST['accion']== "listar"){
    echo json_encode($compras->crearTablaProductos($compras->leerScv()));
}
if($_POST['accion']== "anadir"){
    $datas = ["id"=>$_POST['id'],"nombre"=>$_POST['nombre'],"precio"=>$_POST['precio']];
    echo json_encode($compras->insertaCarrito($datas));
}