<?php

class Amministratori extends Controller{

    function __construct(){
        parent::__construct();
    }
    
    function index(){
        require 'application/controller/session.php';
        $session = new Session_model();
        if($session->isLogged()){
            $this->visualizzaLavoriConFiltro();
        }else{
            header('Location: '.URL."Accesso");
        }
    }

    function modifica($i){
        require 'application/models/amministratori_model.php';
        $model = new Amministratori_Model();
        $id = $_POST['id'];
        $datore_email = $_POST['datore_email'];
        $lavoratore_email = $_POST['lavoratore_email'];
        $titolo = $_POST['titolo'];
        $descrizione = $_POST['descrizione'];
        $tariffaOraria = $_POST['tariffaOraria'];
        $occupato = $_POST['occupato'];
        $scaduto = $_POST['scaduto'];
        $oreDiLavoro = $_POST['oreDiLavoro'];
        $model->modificaLavoro($id, $datore_email, $lavoratore_email, $titolo, $descrizione, $tariffaOraria, $occupato, $scaduto, $oreDiLavoro);
        header('Location: '.URL."Amministratori");
    }

    function elimina($i){
        require 'application/models/amministratori_model.php';
        $model = new Amministratori_Model();
        $id = $_POST['id'];
        $model->eliminaLavoro($id);
        header('Location: '.URL."Amministratori");
    }

    function esegui($i){
        if(isset($_POST['M'])){
            $this->modifica($i);
        }elseif(isset($_POST['E'])){
            $this->elimina($i);
        }
    }

    function esci(){
        session_destroy();
        header('Location: '.URL."Accesso");
    }

    function creaFattura(){
        require 'application/models/amministratori_model.php';
        $model = new Amministratori_Model();
        $data = $model->getLavoriScaduti();
        $this->view->data = $data;
        $allData = $model->getFatture();
        $this->view->allData = $allData;
        $this->view->render("aggiungiFattura/index");
    }

    function calcolaFattura($id, $datore_email, $lavoratore_email){
        $totale = 0;
        require 'application/models/amministratori_model.php';
        $model = new Amministratori_Model();
        $result = $model->calcolaFattura($id);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $totale = $row["oreDiLavoro"]*$row["tariffaOraria"];
            }
        } else {
            $totale = 0;
        }
        $totale = $totale + (($totale*10)/100);
        $data = date("Y-m-d H-i-sa");
        $model->creaFattura($data, $datore_email, $lavoratore_email, $totale);
        $model->eliminaLavoro($id);
        header('Location: '.URL."Amministratori/creaFattura");
    }

    function VisualizzaTutteLeFatture(){

        //header('Location: '.URL."Amministratori");
    }

    function visualizzaLavoriConFiltro(){
        require 'application/models/amministratori_model.php';
        $model = new Amministratori_Model();
        $data = null;
        if(isset($_POST['filtroLavoriOccupati'])){
            $data = $model->getLavoriOccupati();
        }else if(isset($_POST['filtroLavoriScaduti'])){
            $data = $model->getLavoriScaduti();
        }else{
            $data = $model->getLavori();
        }
        $this->view->data = $data;
        $this->view->render("paginaAmministratori/index");
    }
    
}

?>