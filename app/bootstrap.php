<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    require_once 'config/config.php';
    require_once 'config/rewrite_url.php';
    require_once 'helpers/session.php';
    require_once 'helpers/redirect.php';
    require_once 'helpers/auth.php';
    require_once 'helpers/Zebra_Pagination.php';

    require_once 'helpers/ultils.php';

    new Redirect;
    new Auth;

    spl_autoload_register(function($class){
        require_once 'libs/'.$class.'.php';
    });

    require_once 'vendor/autoload.php';

