<?php

class Index_Model extends Model{

    function __construct(){}
	
    function run(){
      require 'application/controller/connection.php';
      $sql = "SELECT * FROM lavoro WHERE archiviato='0'";
      $result = $conn->query($sql);
		  return $result;
    }

}

?>