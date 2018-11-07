<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL ^ E_NOTICE);
define ("RUTA","/var/www/datas/");
define ("FICHERO", "productos.csv");

class carrito {
    private $listaCompra =[];
  
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
        $accion = '';
        foreach ($this->listaCompra as $item){
            var_dump('entro');
            if($item[0]===$datas[0]){
                (int) $item[3]++;
                (int)$item[2] = $item[2]*$item[3];
                $html=["id"=>$item[0],"cantidad"=>$item[3],"precio"=>$item[2]];
                var_dump($html);
                $accion="aumentar";
            }else{
                $accion = "nuevo";
                $this->listaCompra [] = $datas;
                $html ='<tr id="'.$datas[1].'">
                <th scope="row">'.$datas[3].'</th>
                <td>'.$datas[1].'</td>
                <td>'.$datas[2].'</td>
              </tr>';
            }
        }


        
      return array("html"=>json_encode($html),"accion"=>$accion);
    }
}
