<?php

class Dashboard extends Controller
{
    protected Order $orderModel;

    public function __construct()
    {
        $this->orderModel = $this->model('Order');
    }

    public function index(){
        Auth::adminAuth();
        $data['title'] = 'Tổng quan';
        $data['subtitle'] = 'Chi tiết tổng quan';

        $this->view('admin.dashboard', $data);
    }
}