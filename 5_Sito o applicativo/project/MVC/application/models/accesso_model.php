<?php

class Accesso_model extends Model{

    function __construct(){}

	function openSession($email, $password){
		if(strcmp($this->extractData($email, $password),"user exists") == 0){
			echo "You are loggen in!";
		}else{
			echo "You are loggen out!";
		}
	}

	function extractData($email, $password){
		require 'application/controller/connettion.php';
		$resultExtract = $conn;

		$password = hash('sha256', $password);
		$sql = "SELECT * FROM utente WHERE email='$email' AND passwordHash='$password'";
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