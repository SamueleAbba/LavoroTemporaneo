<body>
<header>
	<div class="header" align="center">
		<div class="topnav_center">
			<a id="Title" disabled="true"> Lavoro Temporaneo - form di registrazione</a>
		</div>
	</div>
</header>
<br>
<?php

	require 'Connection.php';
	$emailError = "";
	$passwordError = "";
	$ruoloError = "";

	if($_SERVER["REQUEST_METHOD"] == "POST"){

		$email = $_POST["email"];
		$password = $_POST["password"];
		$ruolo = $_POST["ruolo"];

		//validation email
		if(!empty($email)){
			$email = test_input($email);
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$emailError = "Invalid email format";
			}else{
				$emailError = "correct";
			}
		}else{
			$emailError = "Invalid email format";
		}

		//validation password
		if(!empty($password)){
			$password = test_input($password);
			if(strlen($password) <= 7){
				$passwordError = "Invalid password format";
			}else{
				$passwordError = "correct";
			}
		}else{
			$passwordError = "Invalid password format";
		}

		//validation ruolo
		//	-
		$ruoloError = "correct";

		//se tutti gli input sono corretti avviene l'inserimento nel database.
		if(
			strcmp($emailError,"correct") == 0 &&
			strcmp($passwordError,"correct") == 0 &&
			strcmp($ruoloError,"correct") == 0 &&
			extractData($email, $password) == "user not exists"
		){
			insertData($email, $password, $ruolo);
		}else{
			echo "impossibile registrarsi";
		}

	}

	function extractData($email, $password){
		require 'Connection.php';
		$password = hash('sha256', $password);
		$sql = "SELECT * FROM utente WHERE email='$email' AND passwordHash='$password'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			return "user exists";
		} else {
			return "user not exists";
		}
	}

	function insertData($email, $password, $ruolo){
		require 'Connection.php';
		//creazione conferma treamite mail
		$password = hash('sha256', $password);
		$sql = "INSERT INTO utente(email, passwordHash, nomeRuolo) VALUES('$email', '$password', '$ruolo')";
		if ($conn->query($sql) === TRUE) {
			echo "New user created successfully";
		} else {
			echo "User alredy exists";
		}
	}

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

?>
<br>
<main>
	<form method="POST">
		<span class="error" style="color:red">* campi obbligatori</span><br>

		<label>Email</label><br>
		<input name="email" type="email" size="50">
		<span class="error" style="color:red">* <?php echo $emailError; ?></span>
		<br>
	
		<label>Password</label><br>
		<input name="password" type="password" size="50">
		<span class="error" style="color:red">* <?php echo $passwordError; ?></span>
		<br>
		
		<label for="ruolo">Ruolo</label><br>
		<select name="ruolo" style="width:330px">
			<option value="lavoratore">Lavoratore</option>
		    <option value="datore">Datore</option>
	 	</select><span class="error" style="color:red"> * <?php echo $ruoloError; ?></span><br>

		 <br>

		<input name="conferma" type="submit" value="Conferma">
	</form>
</main>
<br>
<style>
	body {
		margin: 0;
	}
	
	a{
		text-decoration: none;
	}
	
	.topnav_center{
		display: inline-block;
		padding: 16px;
		margin: 1px;
		border: 1px solid black;
	}
	
	.header{
		border: 2px solid black;
	}
</style>