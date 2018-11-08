<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL ^ E_NOTICE);
define ("RUTA","/var/www/datas/");
define ("FICHERO", "productos.csv");

class carrito {
    private $listaCompra =[];
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
        
        if(empty($this->listaCompra)){
            $this->listaCompra[$datas['id']] = $this->cantidad;
            $accion = "nuevo";
            $html = $pintarLinea($datas);
        }

        if(isset($this->listaCompra[$datas['id']])){
            $cantidad = $this->listaCompra[$datas['id']];
            $cantidad++;
            //ENTRA AQUI YUJUUUUUU
            print_r($this->listaCompra);
            echo $cantidad."<- Esta es la cantidad";
            $datas['precio'] = $datas['precio']*$cantidad;
            $this->listaCompra[$datas['id']]=$cantidad;
            
             $accion = "aumentar";
             $html = '<th scope="row">'.$this->cantidad.'</th>
                <td>'.$datas['nombre'].'</td>
                <td>'.$datas['precio'].'</td>';
        }else{
            $this->listaCompra [$datas['id']] = $this->cantidad;
            $accion = "nuevo";
            $html = $pintarLinea($datas);
        }
        return array("html"=>$html,"id"=>$datas['id'],"accion"=>$accion);
       
        
    }
}
