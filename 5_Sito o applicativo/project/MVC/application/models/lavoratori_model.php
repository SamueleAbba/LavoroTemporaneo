<?php

class Lavoratori_Model extends Model{

    function __construct(){}

    function getRischiesteLavori(){
        $emailUser = $_SESSION['email'];
        require 'application/controller/connection.php';
        $sql = "SELECT * FROM lavoro_proposta WHERE lavoratore_email='$emailUser' AND archiviato='0'";
        $result = $conn->query($sql);
        return $result;
    }

    function getLavoriNonOccupati(){
        require 'application/controller/connection.php';
        $sql = "SELECT * FROM lavoro
        WHERE occupato='0' AND archiviato='0'";
        $result = $conn->query($sql);
        return $result;
    }

    function modificaRichiestaDiLavoro($data,$lavoro_id,$lavoratore_email,$titolo,$descrizione,$allegati,$archiviato){
        require 'application/controller/connection.php';
        $sql = "UPDATE lavoro_proposta SET lavoro_id='$lavoro_id',lavoratore_email='$lavoratore_email',titolo='$titolo',descrizione='$descrizione',allegati='$allegati',archiviato='$archiviato'
        WHERE data='$data'";
        $result = $conn->query($sql);
        return $result;
    }

    function getTitolo($id){
        require 'application/controller/connection.php';
        $sql = "SELECT * FROM lavoro WHERE id='$id' LIMIT 1";
        $result = $conn->query($sql);
        return $result;
    }

    function lavoroNonAncoraEsistente($id, $email, $archiviato){
        require 'application/controller/connection.php';
        $sql = "SELECT * FROM lavoro_proposta WHERE lavoro_id='$id' AND lavoratore_email='$email' AND archiviato='$archiviato'";
        $result = $conn->query($sql);
        return $result;
    }

    function aggiungiLavoro($data,$id,$email,$titolo,$descrizione,$allegati,$archiviato){
        require 'application/controller/connection.php';
        $date = new DateTime();
        $data = $date->format('Y-m-d H:i:s');
        $sql = "INSERT INTO `lavoro_proposta`(`data`, `lavoro_id`, `lavoratore_email`, `titolo`, `descrizione`, `allegati`, `archiviato`) 
        VALUES ('$data','$id','$email','$titolo','$descrizione','$allegati', '$archiviato')";
        $result = $conn->query($sql);
        return $result;
    }

    function getLavoro($id){
        require 'application/controller/connection.php';
        $sql = "SELECT * FROM lavoro WHERE id='$id'";
        $result = $conn->query($sql);
        return $result;
    }

    function inviaEmailDiConferma($email, $titolo){
        /*
		  Attenzione se si è sulla macchina 
		 virtuale mettere Scheda di rete: NAT
		*/
		$to_email = $email;
		$subject = "Proposta al lavoro $titolo";
		$message = "Complimenti, la sua proposta al lavoro $titolo è avvenuta con successo";
		$headers = 'From: LavoroTemporaneoSAMT@gmail.com';
        mail($to_email, $subject, $message, $headers);
    }

}

?>