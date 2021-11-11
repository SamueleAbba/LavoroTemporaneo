<?php

class Index extends Controller{

    function __construct(){
        parent::__construct();
    }
    
    function index(){
        require 'application/models/index_model.php';
        $model = new Index_Model();
        $this->view->render("index/index");
        $model->run();
    }

}

?>