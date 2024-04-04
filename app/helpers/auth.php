<?php 

class Auth{

    public static function  adminAuth(){
        if(isset($_SESSION['admin_id'])){
            return true;
        }else {
            Session::set('danger', 'You are not authorized');
            Redirect::to('admin/users/login');
        }
    }

    public static function  userAuth(){
        if(isset($_SESSION['user_id'])){
            return true;
        }else {
            Session::set('danger', 'You are not authorized');
            Redirect::to('users/login');
        }
    }

    public static function  isLoggedIn(){
        return isset($_SESSION['user_id']);
    }

    public static function getCurrentCustomerId(){
        if(isset($_SESSION['user_id']))
            return $_SESSION['user_id'];
        return null;
    }


    public static function  userGuest(){
        if(!isset($_SESSION['user_id'])){
            return true;
        }else {
            Session::set('danger', 'You are already signed');
            Redirect::to('users/profile');
        }
    }


    public static function  adminGuest(){
        if(!isset($_SESSION['admin_id'])){
            return true;
        }else {
            Session::set('danger', 'You are already signed');
            Redirect::to('admins/dashboard');
        }
    }
}

