<?php

    class About extends Controller {
        public function __construct(){
        }

        public function index(){
            $this->view('front.about', ['title'=> 'About Page']);
        }
    }