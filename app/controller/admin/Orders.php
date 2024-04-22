<?php

class Orders extends Controller
{
    const title = 'Quản lý đơn hàng';

    protected Order $orderModel;

    protected PaymentMethod $paymentModel;


    public function __construct()
    {
        $this->orderAdminModel = $this->model('AdminOrder');
        $this->orderModel = $this->model('Order');
        $this->categoryModel = $this->model('Category');
        $this->paymentModel = $this->model('PaymentMethod');
        $this->model('OrderStatus');

    }

    public function index(){
        Auth::adminAuth();

        $data['title'] = self::title;
        $data['subtitle'] = 'Danh sách đơn hàng';

        $orders = $this->orderAdminModel->getOrderSummary($_GET);

        $data['orders'] = $orders;

        $this->view('admin.order.order_summary',$data);
    }

    public function create()
    {
        Auth::adminAuth();

        $data['title'] = self::title;
        $data['subtitle'] = 'Thêm mới đơn hàng';
        $cats = $this->categoryModel->getCategories();
        $data['paymentMethods'] = $this->paymentModel->getPaymentMethods();
        $data['cats'] = $cats;
        $data['customers'] = [];
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            try {
                $products = isset($_POST['products']) ? $_POST['products'] : [];
                $customerId = isset($_POST['customer']) ? $_POST['customer'] : "";
                $hoten = isset($_POST['name']) ? $_POST['name'] : "";
                $diachi = isset($_POST['address']) ? $_POST['address'] : "";
                $phone = isset($_POST['phone']) ? $_POST['phone'] : "";
                $payment = isset($_POST['payment']) ? $_POST['payment'] : "";
                $orderTotal = isset($_POST['orderTotal']) ? $_POST['orderTotal'] : "";
                if(!empty($products) && !empty($customerId) && !empty($hoten)
                    && !empty($diachi) && !empty($phone) && !empty($payment) && !empty($orderTotal)){

                    $data = [
                        "ma_kh"=>$customerId,
                        "ma_pttt"=>$payment,
                        "ngay_lap_dh"=>getTime(),
                        "thanh_tien"=>$orderTotal,
                        "trang_thai"=>OrderStatus::PENDING,
                        "thong_tin_nhan_hang"=>json_encode([
                            "ho_ten"=>$hoten,
                            "dien_thoai"=>$phone,
                            "dia_chi"=>$diachi
                        ]),
                        "note"=>"Admin created"
                    ];

                    $orderId = $this->orderModel->createPendingOrder($data);



                    foreach($products as &$product){
                        $product['so_luong'] = $product['qty'];
                        unset($product['qty']);
                        $this->orderModel->addOrderItem($orderId,$product);
                    }

                    $this->orderModel->deductStockProductOrder($orderId);

                    Session::set('addOrderSuccess',"Thêm đơn hàng thành công");
                    echo json_encode(["status"=>true]);
                    exit();
                }else{
                    echo json_encode([
                        "status"=>false,
                        "message"=>"Vui lòng chọn sản phẩm, điền thông tin đầy đủ"
                    ]);
                    exit();
                }

            }catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        $this->view('admin.order.order_form',$data);
    }

    public function edit($param)
    {
        Auth::adminAuth();
        $data['title'] = self::title;
        $data['subtitle'] = 'Cập nhật đơn hàng';
        $order = $this->orderAdminModel->getOrderData($param['id']);
        $data['order'] = $order;
        $tienhang = 0;
        foreach($order['detail'] as $item){
            $tienhang += $item->tong_tien;
        }
        $data['order']['summary']->tien_hang = $tienhang;
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            try {
                $status = isset($_POST['status']) ? $_POST['status'] : "";
                $this->orderModel->updateOrderStatus($param['id'],$status);
                Session::set('updateStatusOrderSuccess','Cập nhật trạng thái thành công');
                Redirect::back();
            }catch (Exception $e) {
                Session::set('updateStatusOrderFail',$e->getMessage());
            }
        }
        $this->view('admin.order.order_update',$data);
    }

    public function delete($param)
    {
        Auth::adminAuth();
        $id = $param['id'];
        try {
            $this->orderAdminModel->deleteOrder($id);
            Session::set('deleteOrderSuccess','Xoá đơn hàng thành công.');
            Redirect::to('admin/orders');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}