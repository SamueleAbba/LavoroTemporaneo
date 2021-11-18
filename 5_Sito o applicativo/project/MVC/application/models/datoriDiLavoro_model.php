<?php

class DatoriDiLavoro_Model extends Model{

    function __construct(){}

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

    function eliminaOffertaDiLavoro($id){
        require 'application/controller/connection.php';
        $sql = "DELETE FROM lavoro 
        WHERE id='$id'";
        $result = $conn->query($sql);
        return $result;
    }

}

?>