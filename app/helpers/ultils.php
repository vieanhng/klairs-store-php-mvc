<?php

function getUrl($path){
    return URL.$path;
}

function formatPrice($price){
    return number_format((float)$price,0,null,',').'đ';
}