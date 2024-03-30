<?php

class SendEmail extends Controller
{
    public function sendCode(){

        $this->model('SendEmailModel')->send();
    }
}