<?php

class Lavoratori_Model extends Model{

    function __construct(){}

    function getRischiesteLavori(){
        $emailUser = $_SESSION['email'];
        require 'application/controller/connection.php';
        $sql = "SELECT * FROM lavoro_proposta WHERE lavoratore_email='$emailUser'";
        $result = $conn->query($sql);
        return $result;
    }

    function modificaRichiestaDiLavoro($data, $lavoro_id, $lavoratore_email, $titolo, $descrizione, $allegati){
        require 'application/controller/connection.php';
        $sql = "UPDATE lavoro_proposta SET lavoro_id='$lavoro_id',lavoratore_email='$lavoratore_email',titolo='$titolo',descrizione='$descrizione',allegati='$allegati'
        WHERE data='$data'";
        $result = $conn->query($sql);
        return $result;
    }

    function eliminaRichiestaDiLavoro($data){
        require 'application/controller/connection.php';
        $sql = "DELETE FROM lavoro_proposta 
        WHERE data='$data'";
        $result = $conn->query($sql);
        return $result;
    }

}

?>