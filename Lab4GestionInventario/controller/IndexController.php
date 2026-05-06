<?php

class IndexController {

    public function __construct() {
        $this->view = new View();
    } // constructor
    
     public function mostrar(){
         $data['listado']=null;
         
         $this->view->show("indexView.php", $data);
     } // listar
     
} // fin clase
