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