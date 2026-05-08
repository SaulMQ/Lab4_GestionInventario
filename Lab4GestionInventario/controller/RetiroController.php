<?php

class RetiroController {
    
    public function __construct() {}

    public function procesarRetiro() {
        if (!isset($_POST['id_beneficiario'], $_POST['id_producto'], $_POST['cantidad'])) {
            header("Location: index.php");
            return;
        }

        $id_ben  = $_POST['id_beneficiario'];
        $id_prod = $_POST['id_producto'];
        $cant    = $_POST['cantidad'];

        // Validación flexible para IDs cortos como '123'
        if (!preg_match('/^[0-9]{9}$/', trim($id_ben))) {

    echo "<script>
        alert('El ID del beneficiario no tiene un formato válido.');
        history.back();
    </script>";

    return;
}

        // ¡OJO AQUÍ! Revisa que la carpeta sea 'model'
        require_once 'model/RetiroModel.php'; 
        
        $modelo = new RetiroModel();

        if (!$modelo->existeBeneficiario($id_ben)) {

    echo "<script>
        alert('El beneficiario no existe en el sistema.');
        history.back();
    </script>";

    return;
}

        if ($modelo->procesarSalidaSP($id_ben, $id_prod, $cant)) {
            header("Location: ?controlador=Retiro&accion=comprobante&id=" . $id_ben);
        } else {
            echo "<script>alert('No se pudo realizar el retiro. Verifique stock.'); history.back();</script>";
        }
    }

    public function comprobante() {
        $data['id'] = isset($_GET['id']) ? $_GET['id'] : 'Desconocido';
        require_once 'libs/View.php';
        $view = new View();
        $view->show("comprobante_view.php", $data);
    }
}