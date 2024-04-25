<?php

class SendEmail extends Controller
{
    public function index(){

        $this->model('SendEmailModel')->send('babyrng2003@gmail.com','test');
    }
}