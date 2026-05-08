<?php

class RetiroModel {

    private $db;

    public function __construct() {
        require_once 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    }

    public function procesarSalidaSP($id_ben, $id_prod, $cant) {

    try {

        $consulta = $this->db->prepare(
            "CALL sp_registrar_retiro_fifo(?, ?, ?)"
        );

        $consulta->execute([
            $id_ben,
            $id_prod,
            $cant
        ]);

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


    

}?>
