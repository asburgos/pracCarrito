<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL ^ E_NOTICE);
define ("RUTA","/var/www/datas/");
define ("FICHERO", "productos.csv");
define("JSON","productos.json");

class carrito {
    private $cantidad = 1;
    function leerScv(){
        $aData = array();
        $row = 0;
        if (($gestor = fopen(FICHERO, "r")) !== FALSE) {
            while (($data = fgetcsv($gestor,1000,";")) !== FALSE) {
                $aData[$row] = $data;
                $row++;
            }
            fclose($gestor);
        }
        return $aData;
    }
    
    public function crearTablaProductos ($data){
        $html='<table class="table">
               <thead>
                 <tr>
                   <th scope="col">ID</th>
                   <th scope="col">PRODUCTOS</th>
                   <th scope="col">PRECIO €</th>
                   <th scope="col"></th>
                 </tr>
               </thead>
               <tbody>';
        foreach ($data as $value) {
            $html .='<tr id="'.$value[0].'">
                        <th scope="row">'.$value[0].'</th>
                        <td>'.$value[1].'</td>
                        <td>'.$value[4].'</td>
                        <td><button type="button" class="btn btn-primary" onclick="enviar('.$value[0].')">+</button></td>
                    </tr>';
        }
        $html .='</tbody></table>';
        return $html;
    }
    public function insertaCarrito($datas){
        $html="";
        $accion="";
        $pintarLinea = function ($datas){

           return $html ='<tr id="'.$datas['id']."_carrito".'">
                <th scope="row">'.$this->cantidad.'</th>
                <td>'.$datas['nombre'].'</td>
                <td>'.$datas['precio'].'</td>
              </tr>';
        };

        if(!file_exists(JSON)){

            $str='[{"id":'.$datas['id'].',"cantidad":'.$datas['cantidad'].',"precio":'.$datas['precio'].'"}]';
            file_put_contents(JSON,$str);
            $accion = "nuevo";
            $html = $pintarLinea($datas);

        }else{

            $json = file_get_contents(JSON);
            $json = json_decode($json);
            $encontrado = false;

            foreach($json as $key => $value){

                if($value['id'] === $datas['id']){

                    $json[$key]['cantidad'] = (int) $value['cantidad']++;
                    $cantidad = $value['cantidad'];
                    $json[$key]['precio'] = $datas['precio']*$cantidad;
                    echo $json[$key]['precio'];
                    $accion = "aumentar";

                    $html = '<th scope="row">'.$cantidad.'</th>
                    <td>'.$datas['id'].'</td>
                    <td>'.$datas['precio'].'</td>';
                    $encontrado = true;
                    break;
                }
            }
            if(!$encontrado){
               
                $json[] = array("id"=>$datas['id'], "cantidad"=> $datas['cantidad'],"precio"=>$datas['precio']);
                $accion = "nuevo";
                $html = $pintarLinea($datas);
            }
            file_put_contents(JSON,json_encode($json));
        }
        return array("html"=>$html,"id"=>$datas['id'],"accion"=>$accion);
    }
}