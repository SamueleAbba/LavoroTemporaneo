<?php

class DatoriDiLavoro_Model extends Model{

    function __construct(){}

    function getLavoriDatoriDiLavoro(){
        $emailUser = $_SESSION['email'];
        require 'application/controller/connettion.php';
        $sql = "SELECT id, datore_email, lavoratore_email, titolo, descrizione, tariffaOraria, occupato, scaduto, oreDiLavoro FROM lavoro WHERE datore_email='$emailUser'";
        $result = $conn->query($sql);//dbconnect::connect()->query($sql);
        return $result;
		$result->close();
    }

    function modificaOffertaDiLavoro($id, $datore_email, $lavoratore_email, $titolo, $descrizione, $tariffaOraria, $occupato, $scaduto, $oreDiLavoro){
        require 'application/controller/connettion.php';
        $sql = "UPDATE lavoro SET titolo='$titolo',descrizione='$descrizione',tariffaOraria='$tariffaOraria',occupato='$occupato',scaduto='$scaduto',oreDiLavoro='$oreDiLavoro' 
        WHERE id='$id'";
        $result = $conn->query($sql);
        return $result;
		$result->close();
    }

    function eliminaOffertaDiLavoro($id){
        require 'application/controller/connettion.php';
        $sql = "DELETE FROM lavoro 
        WHERE id='$id'";
        $result = $conn->query($sql);
        return $result;
		$result->close();
    }

}

?>