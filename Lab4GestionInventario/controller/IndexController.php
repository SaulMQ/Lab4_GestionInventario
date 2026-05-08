<?php
class IndexController {
    public function __construct() {
        $this->view = new View();
    }

    public function mostrar() {
        require 'model/ProyectoModel.php';
        $proyectos = new ProyectoModel();
        
        $datos = $proyectos->listar();
        $data['listado'] = $datos;
        $data['productos'] = $datos; // Esto es lo que lee el modal

        $this->view->show("indexView.php", $data);
    }
}