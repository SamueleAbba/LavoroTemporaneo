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

    function aggiungiRichiestaDiLavoro(){ /*Location();*/ }
    
}

?>