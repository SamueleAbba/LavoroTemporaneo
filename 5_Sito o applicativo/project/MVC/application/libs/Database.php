<?php

class Database extends PDO{

	function __construct(){
		parent::__construct(DB_TYPE, DB_SERVERNAME, DB_USERNAME, DB_USERPASSWORD, DB_NAME);
	}

}

?>