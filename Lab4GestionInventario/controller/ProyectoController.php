<?php

class ProyectoController
{

    public function __construct()
    {
        $this->view = new View();
    } // constructor

    public function mostrar()
    {
        require 'model/ProyectoModel.php';
        $proyectos = new ProyectoModel();
        $data['listado'] = $proyectos->listar();

        $this->view->show("proyectoView.php", $data);
    } // listar


    public function mostrarregistro()
    {
        require 'model/ProyectoModel.php';
        $proyectos = new ProyectoModel();
        $data['listado'] = $proyectos->listar();

        if (
            $_SERVER['REQUEST_METHOD'] === 'POST'
            && isset($_POST['nombre'], $_POST['cantidad'])
        ) {
            $proyectos->mostrarregistro(
                $_POST['nombre'],
                $_POST['cantidad']
            );
        }

        $this->view->show("ingresoView.php", $data);
    }

    public function gestionar()
    {
        require 'model/ProyectoModel.php';
        $proyectos = new ProyectoModel();
        $data['listado'] = $proyectos->listar();
        $this->view->show("gestionarProyecto.php", $data);
    }

} // fin clase