<?php

class BusquedaModel
{
    protected $db;

    public function __construct()
    {
        require 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    }

    /**
     * Busca productos uniendo tb_productos, tb_inventario y tb_lotes
     */
    public function buscar($termino, $categoria, $columna, $direccion)
    {
        // Limpieza de parámetros para el SP
        $termino = !empty($termino) ? $termino : null;
        $categoria = !empty($categoria) ? $categoria : null;

        $consulta = $this->db->prepare('call sp_buscar_productos_avanzado(?, ?, ?, ?)');
        $consulta->execute([$termino, $categoria, $columna, $direccion]);

        $resultado = $consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    /**
     * Obtiene las categorías únicas registradas en tb_productos para el select
     */
    public function listarCategorias()
    {
        $consulta = $this->db->prepare('SELECT DISTINCT categoria_producto FROM tb_productos');
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }
}
