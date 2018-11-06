<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL ^ E_NOTICE);
define ("RUTA","/var/www/datas/");
define ("FICHERO", "productos.csv");

class compras {
    private $doc;
  
    public function __construct() {
        if(!file_exists(FICHERO)){
            return json_encode(array("status" => "ko", "message" => "Debe introducir un artista primero"));
        }
        $this->doc = fopen(FICHERO, "r");
    }
    public function __destruct() {
        fclose($this->doc);
    }
    public function leerScv(){
        $datos = fgetcsv($this->doc, ";");
        $num = count($datos);

        for ($columna = 0; $columna < $num; ++$columna) {
            $elementos []= explode(";", $datos[$columna]);
        }
        return $elementos;
    } 
    public function crearTablaProductos ($array){
        $html='<table class="table">
               <thead>
                 <tr>
                   <th scope="col">ID</th>
                   <th scope="col">PRODUCTOS</th>
                   <th scope="col">PRECIO</th>
                   <th scope="col"></th>
                 </tr>
               </thead>
               <tbody>';
  

 /* <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
  </tbody>
</table>*/
    }
}
