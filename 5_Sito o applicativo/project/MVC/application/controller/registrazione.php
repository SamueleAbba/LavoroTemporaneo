<?php

class Registrazione extends Controller{

    function __construct(){
        parent::__construct();
    }
    
    function index(){
        require 'application/models/registrazione_model.php';
        $model = new Registrazione_Model();
        $this->view->render("registrazione/index");
    }

	function reRender(){
        require 'application/models/accesso_model.php';
        $model = new Accesso_Model();
        $this->view->render("accesso/index");
    }

    function test(){
		//all data for validation
		$emailError = "";
		$passwordError = "";
		$ruoloError = "";
		$email = $_POST["email"];
		$password = $_POST["password"];
		$ruolo = $_POST["ruolo"];

		//validation email
		if(!empty($email)){
			$email = $this->test_input($email);
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
			$password = $this->test_input($password);
			if(strlen($password) <= 7){
				$passwordError = "Invalid password format";
			}else{
				$passwordError = "correct";
			}
		}else{
			$passwordError = "Invalid password format";
		}

		//validation ruolo
		$ruoloError = "correct";

		//return
		if(
			strcmp($emailError,"correct") == 0 &&
			strcmp($passwordError,"correct") == 0 &&
			strcmp($ruoloError,"correct") == 0
		){
			require 'application/models/registrazione_model.php';
        	$model = new Registrazione_Model();
        	$model->insertData($email, $password, $ruolo);
		}else{
			echo "Email: $emailError<br>";
			echo "Password: $passwordError<br>";
			echo "Ruolo: $ruoloError";
		}
    }

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

}

?>