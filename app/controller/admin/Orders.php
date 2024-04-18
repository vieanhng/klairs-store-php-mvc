<?php

class Orders extends Controller
{
    const title = 'Quản lý đơn hàng';

    public function __construct()
    {
        $this->orderModel = $this->model('AdminOrder');
        $this->categoryModel = $this->model('Category');

    }

    public function index(){
        $data['title'] = self::title;
        $data['subtitle'] = 'Danh sách đơn hàng';

        $orders = $this->orderModel->getOrderSummary($_GET);

        $data['orders'] = $orders;

        $this->view('admin.order.order_summary',$data);
    }

    public function create()
    {
        $data['title'] = self::title;
        $data['subtitle'] = 'Thêm mới đơn hàng';
        $cats = $this->categoryModel->getCategories();
        $data['cats'] = $cats;
        $this->view('admin.order.order_form',$data);
    }

    public function edit($param)
    {
        var_dump($param);
        echo "sua don hang";
    }

    public function delete($param)
    {
        $id = $param['id'];
        try {
            $this->orderModel->deleteOrder($id);
            Session::set('deleteOrderSuccess','Xoá đơn hàng thành công.');
            Redirect::back();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}