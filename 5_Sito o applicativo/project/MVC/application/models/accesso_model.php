<?php

class Accesso_model extends Model{

	private $email = "";
	private $passwordHash = "";
	private $nomeRuolo = "";

    function __construct(){}

	function openSession($email, $password){
		if ($this->extractData($email, $password)) {
			echo "You are loggen in!";
			$_SESSION['email'] = $this->email;
			$_SESSION['passwordHash'] = $this->passwordHash;
			$_SESSION['nomeRuolo'] = $this->nomeRuolo;
		} else {
			echo "You are loggen out!";
			//session_unset($_SESSION['email']);
			//session_unset($_SESSION['password']);
			//session_unset($_SESSION['ruolo']);
		}
	}

	function extractData($email, $password){
		require 'application/controller/connection.php';
		$resultExtract = $conn;

		$password = hash('sha256', $password);
		$sql = "SELECT * FROM utente WHERE email='$email' AND passwordHash='$password'";
		$resultExtractRows = $resultExtract->query($sql);

		if ($resultExtractRows->num_rows != 0) {
			$this->email = $email;
			$this->passwordHash = $password;

			$ruoloSql = "SELECT nomeRuolo FROM utente WHERE email='$email' AND passwordHash='$password'";
			$resultRuoloSql = $resultExtract->query($ruoloSql);
			$row = $resultRuoloSql->fetch_assoc();
			$this->nomeRuolo = $row['nomeRuolo'];
			
			return true;
		} else {
			return false;
		}
	}

}

?>