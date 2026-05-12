<?php

class RetiroModel {

    private $db;

    public function __construct() {
        require_once 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    }

    public function procesarSalidaSP($id_prod, $cant, $id_ben) {

    try {

        $consulta = $this->db->prepare(
            "CALL sp_registrar_retiro_fifo(?, ?, ?)"
        );

        $consulta->execute([
            $id_prod,
            $cant,
            $id_ben
        ]);

        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        $consulta->closeCursor();

        return true;

    } catch (PDOException $e) {

        return false;

    }
    }

    public function existeBeneficiario($identificacion) {

    $consulta = $this->db->prepare("
        SELECT COUNT(*) AS total
        FROM tb_beneficiarios
        WHERE identificacion_beneficiario = ?
    ");

    $consulta->execute([$identificacion]);

    $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

    return $resultado['total'] > 0;
}

    public function listarProductosConInventario() {
        $consulta = $this->db->prepare(
            "SELECT p.ID_producto, p.nombre_producto, IFNULL(SUM(i.cantidad_disponible), 0) AS inventario " .
            "FROM tb_productos p " .
            "LEFT JOIN tb_inventario i ON p.ID_producto = i.ID_producto " .
            "GROUP BY p.ID_producto, p.nombre_producto"
        );
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $consulta->closeCursor();
        return $resultado;
    }

}?>
