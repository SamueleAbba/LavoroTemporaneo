<?php

class DatoriDiLavoro_Model extends Model{

    function __construct(){}

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

    function eliminaOffertaDiLavoro($id){
        require 'application/controller/connection.php';
        $sql = "DELETE FROM lavoro 
        WHERE id='$id'";
        $result = $conn->query($sql);
        return $result;
    }

    function aggiungiLavoro($email, $titolo, $descrizione, $tariffaOraria, $oreDiLavoro){
        require 'application/controller/connection.php';
        $id = ($this->getLavoriTotali()->num_rows) + 1;
        $sql2 = "INSERT INTO lavoro VALUES($id,'$email','samuele.abba@samtrevano.ch','$titolo','$descrizione',$tariffaOraria,0, 0,$oreDiLavoro)";
        $result2 = $conn->query($sql2);
        return $result2;
    }

}

?>