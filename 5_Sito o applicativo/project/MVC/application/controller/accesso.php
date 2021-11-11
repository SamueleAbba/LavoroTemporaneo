<?php

class Accesso extends Controller{

    function __construct(){
        parent::__construct();
    }
    
    function index(){
		require 'application/models/accesso_model.php';
        $model = new Accesso_Model();
        $this->view->render("accesso/index");
    }

	function reRender(){
        require 'application/models/registrazione_model.php';
        $model = new Registrazione_Model();
        $this->view->render("registrazione/index");
    }

    function test(){
		//all data for validation
		$emailError = "";
		$passwordError = "";
		$email = $_POST["email"];
		$password = $_POST["password"];

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

		//return
		if(
			strcmp($emailError,"correct") == 0 &&
			strcmp($passwordError,"correct") == 0
		){
			require 'application/models/accesso_model.php';
        	$model = new Accesso_Model();
        	$model->openSession($email, $password);
		}else{
			echo "Email: $emailError<br>";
			echo "Password: $passwordError";
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