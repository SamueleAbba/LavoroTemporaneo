<?php

class Lavoratori_Model extends Model{

    function __construct(){}

    function getLavoro($id){
        require 'application/controller/connection.php';
        $sql = "SELECT * FROM lavoro WHERE id='$id'";
        $result = $conn->query($sql);
        return $result;
    }

    function getLavori(){
        require 'application/controller/connection.php';
        $sql = "SELECT * FROM lavoro";
        $result = $conn->query($sql);
        return $result;
    }

    function getLavoriNonOccupati(){
        require 'application/controller/connection.php';
        $sql = "SELECT * FROM lavoro
        WHERE occupato='0'";
        $result = $conn->query($sql);
        return $result;
    }

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

    function aggiungiLavoro($data, $id, $email, $titolo, $descrizione, $allegati){
        require 'application/controller/connection.php';
        $date = new DateTime();
        $data = $date->format('Y-m-d H:i:s');
        $sql = "INSERT INTO `lavoro_proposta`(`data`, `lavoro_id`, `lavoratore_email`, `titolo`, `descrizione`, `allegati`) 
        VALUES ('$data','$id','$email','$titolo','$descrizione','$allegati')";
        $result = $conn->query($sql);
        return $result;
    }

    function lavoroNonAncoraEsistente($id, $email){
        require 'application/controller/connection.php';
        $sql = "SELECT * FROM lavoro_proposta WHERE lavoro_id='$id' AND lavoratore_email='$email'";
        $result = $conn->query($sql);
        return $result;
    }

}

?>