<?php

class RetiroController {

    public function __construct() {}

    public function procesarRetiro() {

        // Validar datos recibidos
        if (
            !isset(
                $_POST['id_beneficiario'],
                $_POST['id_producto'],
                $_POST['cantidad']
            )
        ) {

            header("Location: index.php");
            return;
        }

        // Datos del formulario
        $id_ben  = trim($_POST['id_beneficiario']);
        $id_prod = trim($_POST['id_producto']);
        $cant    = trim($_POST['cantidad']);

        // =========================
        // VALIDACIÓN REGEX
        // =========================
        if (!preg_match('/^[0-9]{9}$/', $id_ben)) {

            echo "<script>
                alert('La identificación debe contener exactamente 9 números.');
                history.back();
            </script>";

            return;
        }

        require_once 'model/RetiroModel.php';

        $modelo = new RetiroModel();

        // =========================
        // VALIDAR BENEFICIARIO
        // =========================
        if (!$modelo->existeBeneficiario($id_ben)) {

            echo "<script>
                alert('El beneficiario no existe en el sistema.');
                history.back();
            </script>";

            return;
        }

        // =========================
        // VALIDAR CANTIDAD
        // =========================
        if ($cant <= 0) {

            echo "<script>
                alert('La cantidad debe ser mayor a 0.');
                history.back();
            </script>";

            return;
        }

        // =========================
        // PROCESAR RETIRO
        // =========================
        if ($modelo->procesarSalidaSP($id_ben, $id_prod, $cant)) {

            header(
                "Location: ?controlador=Retiro&accion=comprobante&id=" . $id_ben
            );

        } else {

            echo "<script>
                alert('No se pudo realizar el retiro. Verifique stock.');
                history.back();
            </script>";
        }
    }

    // =========================
    // COMPROBANTE
    // =========================
    public function comprobante() {

        $data['id'] =
            isset($_GET['id'])
            ? $_GET['id']
            : 'Desconocido';

        require_once 'libs/View.php';

        $view = new View();

        $view->show("comprobante_view.php", $data);
    }
    public function mostrarFormulario() {

    require 'model/ProyectoModel.php';

    $modelo = new ProyectoModel();

    $data['productos'] = $modelo->listar();

    require_once 'libs/View.php';

    $view = new View();

    $view->show("retiroView.php", $data);
}
}
?>