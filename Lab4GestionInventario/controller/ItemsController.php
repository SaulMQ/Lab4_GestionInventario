<?php


class ItemsController {
    
//    private $view;
    
    public function __construct() {
        $this->view = new View();
    } // constructor
    
     public function mostrar(){
         require 'model/ItemsModel.php';
         $items=new ItemsModel();

         $listado = $items->listar();
         $data['listado']=$listado;
            $data['productos']=$listado; // Esto es lo que lee el modal
         
         $this->view->show("listar.php", $data);
     } // listar
} // fin clase

?>
