<?php

class BusquedaController
{
    public function __construct()
    {
        $this->view = new View();
    }

    public function mostrar()
    {
        require 'model/BusquedaModel.php';
        $modelo = new BusquedaModel();

        $q = isset($_GET['q']) ? $_GET['q'] : '';
        $cat = isset($_GET['cat']) ? $_GET['cat'] : '';
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'nombre_producto';
        $dir = isset($_GET['dir']) ? $_GET['dir'] : 'ASC';

        // Obtención de datos
        $data['listado'] = $modelo->buscar($q, $cat, $sort, $dir);
        $data['categorias'] = $modelo->listarCategorias();

        $data['filtros'] = [
            'q' => $q,
            'cat' => $cat,
            'sort' => $sort,
            'dir' => $dir
        ];

        $this->view->show("busquedaFiltradaView.php", $data);
    }
}
