<?php

class DatoriDiLavoro extends Controller{

    function __construct(){
        parent::__construct();
    }
    
    function index(){
        require 'application/controller/session.php';
        $session = new Session_model();
        if($session->isLogged()){
            require 'application/models/datoriDiLavoro_model.php';
            $model = new DatoriDiLavoro_Model();
            $data = $model->getLavoriDatoriDiLavoro();
            $this->view->data = $data;
            $allData = $model->getOfferteDiLavoro();
            $this->view->allData = $allData;
            $this->view->render("paginaDatoriDiLavoro/index");
        }else{
            header('Location: '.URL."Accesso");
        }
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
        $model->modificaOffertaDiLavoro($id, $datore_email, $lavoratore_email, $titolo, 
        $descrizione, $tariffaOraria, $occupato, $scaduto, $oreDiLavoro);
        header('Location: '.URL."DatoriDiLavoro");
    }

    function elimina($i){
        require 'application/models/datoriDiLavoro_model.php';
        $model = new DatoriDiLavoro_Model();
        $id = $_POST['id'];
        $model->eliminaOffertaDiLavoro($id);
        header('Location: '.URL."DatoriDiLavoro");
    }

    function esegui($i){
        if(isset($_POST['M'])){
            $this->modifica($i);
        }elseif(isset($_POST['E'])){
            $this->elimina($i);
        }
    }

    function accettaRichiesta($id, $data, $email){
        require 'application/models/datoriDiLavoro_model.php';
        $model = new DatoriDiLavoro_Model();
        $model->accettaRichiestaDiLavoro($id, $email, $data);
        header('Location: '.URL."DatoriDiLavoro");
    }

    function rifiutaRichiesta($id, $data, $email){
        require 'application/models/datoriDiLavoro_model.php';
        $model = new DatoriDiLavoro_Model();
        $model->rifiutaRichiestaDiLavoro($id, $data, $email);
        header('Location: '.URL."DatoriDiLavoro");
    }

    function accettaORifiutaRichiestaDiLavoro($id, $data, $email){
        if(isset($_POST['A'])){
            $this->accettaRichiesta($id, $data, $email);
        }elseif(isset($_POST['R'])){
            $this->rifiutaRichiesta($id, $data, $email);
        }
    }

    function esci(){
        session_destroy();
        header('Location: '.URL."Accesso");
    }

    function aggiungiOffertaDiLavoro(){ 
        $this->view->render("aggiungiOfferta/index");
    }

    function aggiungi(){
		if(!empty($_POST['titolo'])){
			$titolo = $this->test_input($_POST['titolo']);
		}else{
			$titolo = "Titolo di default";
		}

        if(!empty($_POST['descrizione'])){
			$descrizione = $this->test_input($_POST['descrizione']);
		}else{
			$descrizione = "Descrizione di default";
		}

        if(is_numeric($_POST['tariffaOraria']) && $_POST['tariffaOraria'] > 0 && 
           $_POST['tariffaOraria'] == round($_POST['tariffaOraria'], 0))
        {
            $tariffaOraria = $_POST['tariffaOraria'];
        }else{
            $tariffaOraria = 0;
        }

        if(is_numeric($_POST['oreDiLavoro']) && $_POST['oreDiLavoro'] > 0 && 
           $_POST['oreDiLavoro'] == round($_POST['oreDiLavoro'], 0))
        {
            $oreDiLavoro = $_POST['oreDiLavoro'];
        }else{
            $oreDiLavoro = 0;
        }

        $email = $_POST['email'];

        require 'application/models/datoriDiLavoro_model.php';
        $model = new DatoriDiLavoro_Model();
        $result = $model->lavoroNonAncoraEsistente($email, $titolo);
        if($result->num_rows == 0){
            $model->aggiungiLavoro($email, $titolo, $descrizione, $tariffaOraria, $oreDiLavoro);
        }else{
            echo "lavoro già effettuato";
        }
        header('Location: '.URL."DatoriDiLavoro");
    }

    function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
    
}

?>