<?php

abstract class Model {

    public function loadModel($model){
        require_once "app/models/".$model.".php";
        return  new $model();
    }
}