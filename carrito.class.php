<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL ^ E_NOTICE);
define ("RUTA","/var/www/datas/");
define ("FICHERO", "productos.csv");

class carrito {
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
        foreach ($array as $value) {

            $html .='<tr id="$value[0]">
                    <th scope="row" class="'.$value[0].'-child">'.$value[0].'</th>
                    <td class='.$value[0].'-child">'.$value[1].'</td>
                    <td class="'.$value[0].'-child">'.$value[4].'</td>
                    <td><button type="button" class="btn btn-primary" onclick="enviar('.$value[0].')">+</button></td>

                  </tr>';
        }
        $html .='</tbody></table>';
        return $html;
    }
}
