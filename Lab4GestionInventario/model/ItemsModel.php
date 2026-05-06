<?php

class ItemsModel {
    
    protected $db;
    
    public function __construct() {
        //require 'libs/SPDO.php';
        //$this->db= SPDO::singleton();
    } // constructor
    
    public function listar(){
        //$consulta=$this->db->prepare('call sp_listar()');
        //$consulta->execute();
        //$resultado=$consulta->fetchAll();
        //$consulta->closeCursor();
        //return $resultado;
        
        $data = array(
            array(1, "arroz"),
            array(2, "frijoles"),
            array(3, "leche"),
            array(4, "azucar")
        );
        
        return $data;
    } // listar
    
} // fin clase

?>

