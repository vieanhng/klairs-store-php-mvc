<?php

function getUrl($path){
    return URL.$path;
}

function formatPrice($price){
    return number_format((float)$price,0,null,',').'đ';
}

function getTime(){
    return date_create('now', timezone_open('Asia/Ho_Chi_Minh'))->format('Y-m-d H:i:s');
}

function getTodayDate(){
    return date_create('now', timezone_open('Asia/Ho_Chi_Minh'))->format('Y-m-d');
}

function getProductImage($anh_sp)
{
    return URL.'public/uploads/product/'.$anh_sp;
}

function random_password( $length = 8 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}