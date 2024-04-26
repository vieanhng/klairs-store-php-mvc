<?php

class Dashboard extends Controller
{
    const title = 'Tổng quan';

    protected Order $orderModel;

    public function __construct()
    {
        $this->orderModel = $this->model('Order');

    }
     public function index(){
        Auth::adminAuth();
        $data['title'] = self::title;
        $data['subtitle'] = 'Chi tiết tổng quan';

        $sellToday = $this->orderModel->getSellToday($_GET);
        $data['sellToday'] = $sellToday;

        $revenues = $this->orderModel->getRevenue($_GET);
        foreach ($revenues as $index => $revenue){
            $revenue->thang_nam='T'.$revenue->thang.'-'.$revenue->nam;
        }
        $data['revenues'] = $revenues;
        //$data['revenues'] = json_encode($revenues);
        //var_dump($revenues);

        $topPros = $this->orderModel->getTopPro($_GET);
        $data['topPro'] = $topPros;
    
        $this->view('admin.dashboard', $data);
            
    }

    // public function index(){
    //     Auth::adminAuth();
    //     $data['title'] = 'Tổng quan';
    //     $data['subtitle'] = 'Chi tiết tổng quan';

    //     $arrayName = explode(' ', Session::name('admin_name'));
    //     $data['admin_name'] = $arrayName[0];

    //     $order = $this->orderModel->getOrderSumarry($_GET);
    //     $data['order'] = $order;

    //     var_dump ($arrayName[0]);
    //     $this->view('admin.dashboard', $data);
        
    // }
}