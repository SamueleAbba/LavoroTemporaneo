<?php

class Registrazione_Model extends Model{

    function __construct(){}

	function insertData($email, $password, $ruolo){
		require 'application/controller/connettion.php';
		$result = $conn;

		// da ancora verificare la conferma mail
		// mail($email, "Registrazione al lavoro temporaneo", "Complimenti, la sua registrazione è avvenuta con successo") ? TRUE : FALSE;
		// nell'if && $invioEmail === TRUE
		
		$invioEmail = TRUE;
		$password = hash('sha256', $password);
		$sql = "INSERT INTO utente(email, passwordHash, nomeRuolo) VALUES('$email', '$password', '$ruolo')";

		if (strcmp($this->extractData($email, $password, $ruolo),"user not exists") == 0) { 
			$result->query($sql);
			echo "New user created successfully";
		} else {
			echo "User alredy exists or invalid";
		}
		$result->close();
	}
	
	function extractData($email, $password, $ruolo){
		require 'application/controller/connettion.php';
		$resultExtract = $conn;

		$password = hash('sha256', $password);
		$sql = "SELECT * FROM utente WHERE email='$email'";
		$resultExtractRows = $resultExtract->query($sql);

		if ($resultExtractRows->num_rows != 0) {
			return "user exists";
		} else {
			return "user not exists";
		}
		$resultExtract->close();
	}

}

?>