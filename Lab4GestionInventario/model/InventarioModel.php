<?php

class InventarioModel
{

    protected $db;

    public function __construct()
    {
        require 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    } // constructor

    public function listarProductos()
    {
        $consulta = $this->db->prepare('call sp_listar_productos()');
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    } // listarProductos

    public function registrarProductos($nombre, $categoria, $ruta_imagen)
    {
        try {
            $consulta = $this->db->prepare('call sp_insertar_producto(?, ?, ?)');
            $consulta->execute([$nombre, $categoria, $ruta_imagen]);
            $consulta->closeCursor();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    } // registrarProductos

    public function obtenerAlertas($categoria = null)
    {
        $consulta = $this->db->prepare('CALL sp_obtener_alertas(?)');
        $consulta->execute([$categoria]);
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $consulta->closeCursor();
        return $resultado;
    }

    public function obtenerCategorias()
    {
        $consulta = $this->db->prepare('CALL sp_buscar_categorias()');
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_COLUMN);
        $consulta->closeCursor();
        return $resultado;
    }

    public function agregarStock($producto_id, $cantidad)
    {
        try {
            $consulta = $this->db->prepare('call sp_registrar_compra(?, ?)');
            $consulta->execute([$producto_id, $cantidad]);
            $consulta->closeCursor();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    } // agregarStock

} // fin clase