<?php

class DatoriDiLavoro extends Controller{

    function __construct(){
        parent::__construct();
    }
    
    function index(){
        require 'application/models/datoriDiLavoro_model.php';
        $model = new DatoriDiLavoro_Model();
        $data = $model->getLavoriDatoriDiLavoro();
        $this->view->data = $data;
        $this->view->render("paginaDatoriDiLavoro/index");
    }

    function modifica($i){
        require 'application/models/datoriDiLavoro_model.php';
        $model = new DatoriDiLavoro_Model();
        $id = $_POST['id'];
        $datore_email = $_POST['datore_email'];
        $lavoratore_email = $_POST['lavoratore_email'];
        $titolo = $_POST['titolo'];
        $descrizione = $_POST['descrizione'];
        $tariffaOraria = $_POST['tariffaOraria'];
        $occupato = $_POST['occupato'];
        $scaduto = $_POST['scaduto'];
        $oreDiLavoro = $_POST['oreDiLavoro'];
        $model->modificaOffertaDiLavoro($id, $datore_email, $lavoratore_email, $titolo, $descrizione, $tariffaOraria, $occupato, $scaduto, $oreDiLavoro);
        header('Location: '.URL."DatoriDiLavoro");
    }

    function elimina($i){
        require 'application/models/datoriDiLavoro_model.php';
        $model = new DatoriDiLavoro_Model();
        $id = $_POST['id'];
        $model->eliminaOffertaDiLavoro($id);
        header('Location: '.URL."DatoriDiLavoro");
    }

function aggiungiOffertaDiLavoro(){ /*Location();*/ }
    
}

?>