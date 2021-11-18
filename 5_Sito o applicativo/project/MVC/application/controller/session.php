<?php

class Session_model extends Controller{

    function __construct(){}

    function isLogged(){
        if(isset($_SESSION['email']) && isset($_SESSION['passwordHash']) && isset($_SESSION['nomeRuolo'])){
            return true;
        }else{
            return false;
        }
    }
    
}

?>