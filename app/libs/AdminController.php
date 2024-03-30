<?php

class AdminController {

    public function index(){}
    public function model($model){
        require_once "app/models/admin/".$model.".php";
        return  new $model();
    }

    public function view($view,$data=[]){
        if(file_exists('app/views/admin/'.str_replace('.','/',$view).'.php')){
            require_once "app/views/admin/".str_replace('.','/',$view).".php";
        }else {
        die('View does not exist');
        }
    }
}