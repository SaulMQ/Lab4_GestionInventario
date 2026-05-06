<?php

class InventarioController
{

    public function __construct()
    {
        $this->view = new View();
    }

    public function mostrar()
    {
        require 'model/InventarioModel.php';
        $inventario = new InventarioModel();
        $data['listado'] = $inventario->listarProductos();
        $this->view->show("inventarioView.php", $data);
    }

    public function mostrarAlertas()
    {
        require 'model/InventarioModel.php';
        $inventario = new InventarioModel();
        $data['listadoRiesgo'] = $inventario->productosEnRiesgo();
        $this->view->show("productosRiesgo.php", $data);
    }

    public function mostrarFormulario()
    {
        require 'model/InventarioModel.php';
        $inventario = new InventarioModel();
        $data['productos'] = $inventario->listarProductos();
        $this->view->show("registrarProductosView.php", $data);
    }

    public function registrarProductos()
    {
        require 'model/InventarioModel.php';
        $inventario = new InventarioModel();
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;
        $ruta_imagen = isset($_POST['ruta_imagen']) ? $_POST['ruta_imagen'] : null;

        if (!$nombre || !$categoria || !$ruta_imagen) {
            header('Location: ?controlador=Inventario&accion=mostrarFormulario&status=invalido');
            exit;
        }

        $data['productos'] = $inventario->registrarProductos($nombre, $categoria, $ruta_imagen);
        if ($data['productos']) {
            header('Location: ?controlador=Inventario&accion=mostrar&status=success');
        } else {
            header('Location: ?controlador=Inventario&accion=mostrarFormulario&status=error');
        }
    }

    public function agregarStock()
    {
        require 'model/InventarioModel.php';
        $inventario = new InventarioModel();

        $producto_id = isset($_POST['producto_id']) ? $_POST['producto_id'] : null;
        $cantidad    = isset($_POST['cantidad'])    ? $_POST['cantidad']    : null;

        if ($producto_id && $cantidad > 0) {
            $resultado = $inventario->agregarStock($producto_id, $cantidad);
            if ($resultado) {
                header('Location: ?controlador=Inventario&accion=mostrarFormulario&status=success');
            } else {
                header('Location: ?controlador=Inventario&accion=mostrarFormulario&status=error');
            }
        } else {
            header('Location: ?controlador=Inventario&accion=mostrarFormulario&status=invalido');
        }

        exit;
    }
} // fin clase