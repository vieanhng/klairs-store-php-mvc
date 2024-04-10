<?php

abstract class Model {

    public function __construct(){
        $this->db = Database::getInstance();
    }

    public function loadModel($model){
        require_once "app/models/".$model.".php";
        return  new $model();
    }
}