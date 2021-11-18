<?php

class Index extends Controller{

    function __construct(){
        parent::__construct();
    }
    
    function index(){
        require 'application/models/index_model.php';
        $model = new Index_Model();
        $data = $model->run();
        $this->view->data = $data;
        $this->view->render("index/index");
    }

}

?>