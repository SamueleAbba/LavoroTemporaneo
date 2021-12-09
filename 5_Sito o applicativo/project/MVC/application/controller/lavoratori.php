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
            $allData = $model->getLavoriNonOccupati();
            $this->view->allData = $allData;
            $this->view->render("paginaLavoratori/index");
        }else{
            header('Location: '.URL."Accesso");
        }
    }

    function modifica($i){
        require 'application/models/lavoratori_model.php';
        $model = new Lavoratori_Model();
        $data = date('Y-m-d H:i:s',strtotime($_POST['data']));
        $lavoro_id = $_POST['lavoro_id'];
        $lavoratore_email = $_POST['lavoratore_email'];
        $titolo = $_POST['titolo'];
        $descrizione = $_POST['descrizione'];
        $allegati = $_POST['allegati'];
        $archiviato = $_POST['archiviato'];
        $model->modificaRichiestaDiLavoro($data,$lavoro_id,$lavoratore_email,
        $titolo,$descrizione,$allegati,$archiviato);
        header('Location: '.URL."Lavoratori");
    }

    function elimina($data){
        require 'application/models/lavoratori_model.php';
        $model = new Lavoratori_Model();
        $data = date('Y-m-d H:i:s',strtotime($_POST['data']));
        $lavoro_id = $_POST['lavoro_id'];
        $lavoratore_email = $_POST['lavoratore_email'];
        $titolo = $_POST['titolo'];
        $descrizione = $_POST['descrizione'];
        $allegati = $_POST['allegati'];
        $archiviato = "1";
        $model->modificaRichiestaDiLavoro($data,$lavoro_id,$lavoratore_email,
        $titolo,$descrizione,$allegati,$archiviato);
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
        require 'application/controller/session.php';
        $session = new Session_model();
        if($session->isLogged()){
            $this->view->id = $id;
            require 'application/models/lavoratori_model.php';
            $model = new Lavoratori_Model();
            $titolo = $model->getTitolo($id);
            $titolo = $titolo->fetch_assoc();
            $this->view->titolo = $titolo['titolo'];
            $this->view->render("aggiungiRichiesta/index");
        }else{
            header('Location: '.URL."Accesso");
        }
    }

    function aggiungi(){
        if(!empty($_POST['titolo'])){
			$titolo = $this->test_input($_POST['titolo']);
		}else{
			$titolo = "Richiesta per il lavoro";
		}
        if(!empty($_POST['descrizione'])){
			$descrizione = $this->test_input($_POST['descrizione']);
		}else{
			$descrizione = "Descrizione della richiesta per il lavoro";
		}
        if(!empty($_POST['allegati'])){
			$allegati = $this->test_input($_POST['allegati']);
		}else{
			$allegati = " ";
		}

        $id = $_POST['id'];
        $email = $_POST['email'];
        $data = null;
        $archiviato = 0;

        require 'application/models/lavoratori_model.php';
        $model = new Lavoratori_Model();
        $result = $model->lavoroNonAncoraEsistente($id, $email, $archiviato);
        if($result->num_rows == 0){
            $model->aggiungiLavoro($data,$id,$email,$titolo,$descrizione,$allegati,$archiviato);
            $titoloLavoro = $model->getLavoro($id);
            $row = $titoloLavoro->fetch_assoc();
            $titolo = $row['titolo'];
            $model->inviaEmailDiConferma($email, $titolo);
        }else{
            echo "richiesta già effettuata";
        }
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