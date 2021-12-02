<?php

class Registrazione_Model extends Model{

    function __construct(){}

	function insertData($email, $password, $ruolo){
		require 'application/controller/connection.php';
		$result = $conn;

		/*
		  Attenzione se si è sulla macchina 
		 virtuale mettere Scheda di rete: NAT
		*/
		$to_email = $email;
		$subject = "Registrazione al lavoro temporaneo";
		$message = "Complimenti, la sua registrazione è avvenuta con successo";
		$headers = 'From: LavoroTemporaneoSAMT@gmail.com';

		$password = hash('sha256', $password);
		$sql = "INSERT INTO utente(email, passwordHash, nomeRuolo) VALUES('$email', '$password', '$ruolo')";

		if ($this->extractData($email, $password, $ruolo) && mail($to_email, $subject, $message, $headers)) {
			$result->query($sql);
			echo "New user created successfully";
		} else {
			echo "User alredy exists or invalid";
		}
	}
	
	function extractData($email, $password, $ruolo){
		require 'application/controller/connection.php';
		$resultExtract = $conn;

		$password = hash('sha256', $password);
		$sql = "SELECT * FROM utente WHERE email='$email'";
		$resultExtractRows = $resultExtract->query($sql);

		if ($resultExtractRows->num_rows == 0) {
			return true;
		} else {
			return false;
		}
	}

}

?>