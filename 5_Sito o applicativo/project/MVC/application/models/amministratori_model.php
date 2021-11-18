<?php

class Amministratori_Model extends Model{

    function __construct(){}

    function getLavori(){
        require 'application/controller/connection.php';
        $sql = "SELECT * FROM lavoro";
        $result = $conn->query($sql);
        return $result;
    }

    function getLavoriOccupati(){
        require 'application/controller/connection.php';
        $sql = "SELECT * FROM lavoro
        WHERE occupato='1'";
        $result = $conn->query($sql);
        return $result;
    }

    function getLavoriScaduti(){
        require 'application/controller/connection.php';
        $sql = "SELECT * FROM lavoro
        WHERE scaduto='1'";
        $result = $conn->query($sql);
        return $result;
    }

    function modificaLavoro($id, $datore_email, $lavoratore_email, $titolo, $descrizione, $tariffaOraria, $occupato, $scaduto, $oreDiLavoro){
        require 'application/controller/connection.php';
        $sql = "UPDATE lavoro SET datore_email='$datore_email',lavoratore_email='$lavoratore_email',titolo='$titolo',descrizione='$descrizione',tariffaOraria='$tariffaOraria',occupato='$occupato',scaduto='$scaduto',oreDiLavoro='$oreDiLavoro' 
        WHERE id='$id'";
        $result = $conn->query($sql);
        return $result;
    }

    function eliminaLavoro($id){
        require 'application/controller/connection.php';
        $sql = "DELETE FROM lavoro 
        WHERE id='$id'";
        $result = $conn->query($sql);
        return $result;
    }

}

?>