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
        $categoria = isset($_GET['categoria']) && $_GET['categoria'] !== '' ? $_GET['categoria'] : null;
        $data['alertas'] = $inventario->obtenerAlertas($categoria);
        $data['categorias'] = $inventario->obtenerCategorias();
        $data['totalAlertas'] = count($data['alertas']);
        $data['categoriaSeleccionada'] = $categoria;
        $this->view->show("productosRiesgo.php", $data);
    }

    public function mostrarFormulario()
    {
        require 'model/InventarioModel.php';
        $inventario = new InventarioModel();
        $data['productos'] = $inventario->listarProductos();
        $this->view->show("registrarProductosView.php", $data);
    }

    public function mostrarFormularioLote()
    {
        require 'model/InventarioModel.php';
        $inventario = new InventarioModel();
        $data['productos'] = $inventario->listarProductos();
        $data['lotes']     = $inventario->listarLotes();
        $this->view->show("ingresoView.php", $data);
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


    public function registrarLote()
    {
        require 'model/InventarioModel.php';
        $inventario = new InventarioModel();

        $codigo_lote        = isset($_POST['codigo_lote'])       ? trim($_POST['codigo_lote'])       : '';
        $id_lote_existente  = isset($_POST['id_lote_existente']) ? trim($_POST['id_lote_existente']) : '';
        $ids_producto       = isset($_POST['id_producto'])       ? $_POST['id_producto']             : [];
        $cantidades         = isset($_POST['cantidad'])          ? $_POST['cantidad']                : [];
        $fechas_vencimiento = isset($_POST['fecha_vencimiento']) ? $_POST['fecha_vencimiento']       : [];

        if (empty($ids_producto)) {
            header('Location: ?controlador=Inventario&accion=mostrarFormularioLote&status=invalido');
            exit;
        }

        $hoy = date('Y-m-d');
        foreach ($ids_producto as $i => $id_prod) {
            if (empty($id_prod) || empty($cantidades[$i]) || empty($fechas_vencimiento[$i])) {
                header('Location: ?controlador=Inventario&accion=mostrarFormularioLote&status=invalido');
                exit;
            }
            if ($fechas_vencimiento[$i] < $hoy) {
                header('Location: ?controlador=Inventario&accion=mostrarFormularioLote&status=fecha_error');
                exit;
            }
        }

        // Usar lote existente o crear uno nuevo
        if (!empty($id_lote_existente)) {
            $id_lote = $id_lote_existente;
        } else {
            if (empty($codigo_lote)) {
                $codigo_lote = 'LOT-' . date('YmdHis');
            }
            $id_lote = $inventario->crearLote($codigo_lote);

            if (!$id_lote) {
                header('Location: ?controlador=Inventario&accion=mostrarFormularioLote&status=error');
                exit;
            }
        }

        // Insertar cada producto
        foreach ($ids_producto as $i => $id_prod) {
            $resultado = $inventario->registrarInventario(
                $id_prod,
                $id_lote,
                $cantidades[$i],
                $fechas_vencimiento[$i]
            );

            if (!$resultado) {
                header('Location: ?controlador=Inventario&accion=mostrarFormularioLote&status=error');
                exit;
            }
        }

        header('Location: ?controlador=Inventario&accion=mostrarFormularioLote&status=success');
        exit;
    }
} // fin clase