<?php


class ItemsController {
    
//    private $view;
    
    public function __construct() {
        $this->view = new View();
    } // constructor
    
     public function mostrar(){
         require 'model/ItemsModel.php';
         $items=new ItemsModel();
         $data['listado']=$items->listar();
         
         $this->view->show("listar.php", $data);
     } // listar
} // fin clase

?>
