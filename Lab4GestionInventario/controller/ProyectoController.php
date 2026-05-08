<?php

class ProyectoController
{
    private $view;

    public function __construct()
    {
        $this->view = new View();
    } // constructor

    /**
     * Muestra la tabla principal de proyectos y carga el modal de retiro
     */
    public function mostrar()
{
    require 'model/ProyectoModel.php';
    $proyectos = new ProyectoModel();

    // LLAMADA ÚNICA (Solo una vez al modelo)
    $datos = $proyectos->listar();

    // ASIGNAR LA VARIABLE (No vuelvas a llamar a la función listar)
    $data['listado'] = $datos;
    $data['productos'] = $datos;

    $this->view->show("proyectoView.php", $data);
}
    /**
     * Muestra el formulario de ingreso de existencias y procesa el registro
     */
    public function mostrarregistro()
    {
        require 'model/ProyectoModel.php';
        $proyectos = new ProyectoModel();

        // Procesar el POST si se enviaron datos
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST'
            && isset($_POST['nombre'], $_POST['cantidad'])
        ) {
            $proyectos->mostrarregistro(
                $_POST['nombre'],
                $_POST['cantidad']
            );
            // Opcional: podrías redirigir aquí para evitar reenvío de formulario
        }

        // Cargamos la lista para el <select> del formulario de ingreso
        $data['listado'] = $proyectos->listar();

        $this->view->show("ingresoView.php", $data);
    }

    /**
     * Muestra la interfaz de gestión (editar/eliminar)
     */
    public function gestionar()
    {
        require 'model/ProyectoModel.php';
        $proyectos = new ProyectoModel();

        // Nuevamente, llamada única al modelo
        $datos = $proyectos->listar();
        
        $data['listado'] = $datos;
        $data['productos'] = $datos;

        $this->view->show("gestionarProyecto.php", $data);
    }

} // fin clase