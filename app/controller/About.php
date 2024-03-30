<?php
namespace controller;

    class About extends Controller {
        public function __construct(){
            new Session;
        }

        public function index(){
            $this->view('front.about', ['title'=> 'About Page']);
        }
    }