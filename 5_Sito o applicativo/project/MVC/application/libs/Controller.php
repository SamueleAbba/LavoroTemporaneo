<?php

class Controller{

	function __construct(){
		$this->view = new View();
	}

	function loadModel($name){

		$path = 'applications/models/$name_model.php';

		if(file_exists($path)){
			require $path;
			$modelName = '$name_Model';
			$this->model = new $modelName ;
		}

	}

}

?>