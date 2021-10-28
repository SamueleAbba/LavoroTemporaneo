<body>
<header>
	<div class="header" align="center">
		<div class="topnav_center">
			<a id="Title" disabled="true"> Lavoro Temporaneo - form di accesso</a>
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

		//se tutti gli input sono corretti viene autenticato l'utente nel database.
		if(
			strcmp($emailError,"correct") == 0 &&
			strcmp($passwordError,"correct") == 0 &&
			extractData($email, $password) == "user exists"
		){
			openSession($email, $password);
		}else{
			echo "impossibile accedere";
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

	function openSession($email, $password){
		require 'Connection.php';
		//creazione sessione
		if(true){
			echo "User On";
		}else{
			echo "User Off";
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