<?php

class DatoriDiLavoro_Model extends Model{

    function __construct(){}

    function getOfferteDiLavoro(){
        require 'application/controller/connection.php';
        $sql = "SELECT * FROM lavoro_proposta WHERE archiviato='0' AND
        lavoro_id IN (SELECT id from lavoro WHERE datore_email='$_SESSION[email]')";
        $result = $conn->query($sql);
        return $result;
    }

    function getLavoriTotali(){
        require 'application/controller/connection.php';
        $sql = "SELECT * FROM lavoro";
        $result = $conn->query($sql);
        return $result;
    }

    function getLavoriDatoriDiLavoro(){
        $emailUser = $_SESSION['email'];
        require 'application/controller/connection.php';
        $sql = "SELECT * FROM lavoro WHERE datore_email='$emailUser'";
        $result = $conn->query($sql);
        return $result;
    }

    function modificaOffertaDiLavoro($id, $datore_email, $lavoratore_email, $titolo, $descrizione, $tariffaOraria, $occupato, $scaduto, $oreDiLavoro){
        require 'application/controller/connection.php';
        $sql = "UPDATE lavoro SET titolo='$titolo',descrizione='$descrizione',tariffaOraria='$tariffaOraria',occupato='$occupato',scaduto='$scaduto',oreDiLavoro='$oreDiLavoro' 
        WHERE id='$id'";
        $result = $conn->query($sql);
        return $result;
    }

    function archiviaOffertaDiLavoro($id){
        require 'application/controller/connection.php';
        $sql = "UPDATE lavoro SET scaduto='1'
        WHERE id='$id'";
        $result = $conn->query($sql);
        return $result;
    }

    function accettaRichiestaDiLavoro($id, $email, $data){
        require 'application/controller/connection.php';
        $sql = "UPDATE lavoro SET lavoratore_email='$email', occupato='1'
        WHERE id='$id'";
        $result = $conn->query($sql);
        $this->rifiutaRichiestaDiLavoro($id, $data, $email);
        return $result;
    }

    function rifiutaRichiestaDiLavoro($id, $data, $email){
        require 'application/controller/connection.php';
        $data = substr($data,0, 10)." ".substr($data,10, 8);
        $sql = "DELETE FROM `lavoro_proposta` 
        WHERE data='$data'";
        $result = $conn->query($sql);
        return $result;
    }

    function aggiungiLavoro($email, $titolo, $descrizione, $tariffaOraria, $oreDiLavoro){
        require 'application/controller/connection.php';
        $sql2 = "INSERT INTO lavoro(datore_email, lavoratore_email, titolo, descrizione, tariffaOraria, occupato, scaduto, oreDiLavoro)
        VALUES('$email','samuele.abba@samtrevano.ch','$titolo','$descrizione',$tariffaOraria,0, 0,$oreDiLavoro)";
        $result2 = $conn->query($sql2);
        return $result2;
    }

    function lavoroNonAncoraEsistente($email, $titolo){
        require 'application/controller/connection.php';
        $sql = "SELECT * FROM lavoro WHERE datore_email='$email' AND titolo='$titolo'";
        $result = $conn->query($sql);
        return $result;
    }

}

?>