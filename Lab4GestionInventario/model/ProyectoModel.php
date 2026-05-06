<?php

class ProyectoModel
{

    protected $db;

    public function __construct()
    {
        require 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    } // constructor

    public function listar()
    {
        $consulta = $this->db->prepare('call sp_listar_mercancia()');
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    } // listar

    public function mostrarregistro($nombre, $cantidad)
    {
        try {
        $consulta = $this->db->prepare("call sp_sumar_existencias(?, ?)");
        $consulta->execute([$nombre, $cantidad]);
        $filasAfectadas = $consulta->rowCount() > 0;
        $consulta->closeCursor();
        return $filasAfectadas;
    } catch (PDOException $e) {
        return false;
    }
    }

} // fin clase
