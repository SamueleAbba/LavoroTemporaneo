<?php

class Lavoratori extends Controller{

    function __construct(){
        parent::__construct();
    }
    
    function index(){
        require 'application/controller/session.php';
        $session = new Session_model();
        if($session->isLogged()){
            require 'application/models/lavoratori_model.php';
            $model = new Lavoratori_Model();
            $data = $model->getRischiesteLavori();
            $this->view->data = $data;
            $allData = $model->getLavoriTotali();
            $this->view->allData = $allData;
            $this->view->render("paginaLavoratori/index");
        }else{
            header('Location: '.URL."Accesso");
        }
    }

    function modifica($i){
        require 'application/models/lavoratori_model.php';
        $model = new Lavoratori_Model();
        $data = $_POST['data'];
        $lavoro_id = $_POST['lavoro_id'];
        $lavoratore_email = $_POST['lavoratore_email'];
        $titolo = $_POST['titolo'];
        $descrizione = $_POST['descrizione'];
        $allegati = $_POST['allegati'];
        $model->modificaRichiestaDiLavoro($data, $lavoro_id, $lavoratore_email, $titolo, $descrizione, $allegati);
        header('Location: '.URL."Lavoratori");
    }

    function elimina($data){
        require 'application/models/lavoratori_model.php';
        $model = new Lavoratori_Model();
        $data = $_POST['data'];
        $model->eliminaRichiestaDiLavoro($data);
        header('Location: '.URL."Lavoratori");
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

    function aggiungiRichiestaDiLavoro($id){
        $this->view->id = $id;
        $this->view->render("aggiungiRichiesta/index");
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

        if(!empty($_POST['allegati'])){
			$allegati = $this->test_input($_POST['allegati']);
		}else{
			$allegati = " ";
		}

        $offertaDiLavoro = $_POST['offertaDiLavoro'];

        $email = $_POST['email'];

        $data = date("Y-m-d-H-i-sa");

        require 'application/models/lavoratori_model.php';
        $model = new Lavoratori_Model();
        $model->aggiungiLavoro($data, $offertaDiLavoro, $email, $titolo, $descrizione, $allegati);
        header('Location: '.URL."Lavoratori");
    }

    function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
    
}

?>