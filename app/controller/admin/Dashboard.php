<?php

class Dashboard extends Controller
{
    public function index(){
        Auth::adminAuth();
        $data['title'] = 'Tổng quan';
        $data['subtitle'] = 'Chi tiết tổng quan';
        $arrayName = explode(' ', Session::name('admin_name'));
        $data['admin_name'] = $arrayName[0];
        $this->view('admin.dashboard', $data);
    }
}