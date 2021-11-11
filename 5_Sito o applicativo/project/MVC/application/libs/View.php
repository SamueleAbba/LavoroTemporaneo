<?php

class View{

    function __construct(){
        //$this->render("nome", true/false);
    }

    public function render($name, $noInclude = false){
        require 'application/views/' . $name . '.php';
    }

}

?>