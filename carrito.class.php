<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL ^ E_NOTICE);
define ("RUTA","/var/www/datas/");
define ("FICHERO", "productos.csv");

class carrito {
  
   
    public function leerScv(){
        $aData = array();
        $row = 0;
        if (($gestor = fopen(FICHERO, "r")) !== FALSE) {
            while (($data = fgetcsv($gestor, 1000, ";")) !== FALSE) {
                $aData[$row] = $data;
                $row++;
            }
            fclose($gestor);
        }
        return $aData;
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
        foreach ($array as &$value) {
            $html .='<tr id="$value[0]">
                    <th scope="row">'.$value[0].'</th>
                    <td>'.$value[1].'</td>
                    <td>'.$value[4].' €</td>
                    <td><button type="button" class="btn btn-primary" onclick="enviar('.$value[0].')">+</button></td>
                  </tr>';
        }
        $html .='</tbody></table>';
        return $html;
    }
}
