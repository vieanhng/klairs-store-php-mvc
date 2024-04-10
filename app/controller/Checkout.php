<?php


use PayOS\PayOS;

class Checkout extends Controller
{
    /**
     * @var mixed
     */
    private Order $orderModel;
    /**
     * @var mixed
     */
    private PaymentMethod $paymentModel;
    /**
     * @var mixed
     */
    private Product $productModel;

    public function __construct()
    {
        $this->cartModel = $this->model('Cart');
        $this->orderModel = $this->model('Order');
        $this->model('OrderStatus');
        $this->paymentModel = $this->model('PaymentMethod');
        $this->productModel = $this->model('Product');
    }

    /**
     * @var Cart
     */
    private Cart $cartModel;

    public function index()
    {
        $data['title'] = 'Thanh toán';
        $cart = $this->cartModel->getCurrentCarts();
        if(!$cart['detail']){
            Redirect::to('carts');
        }
        $data['cart'] = $cart;
        $data['paymentMethods'] = $this->paymentModel->getPaymentMethods();
        $this->view('front.checkout',$data);
    }

    public function placeOrder(){
        Auth::userAuth();
        var_dump($_POST);
        var_dump($this->cartModel->getCurrentCarts());
        $orderId = null;
        try {
            $hoten = !isset($_POST['name']) ?:  htmlspecialchars($_POST['name']);
            $phone = !isset($_POST['phone']) ?:  htmlspecialchars($_POST['phone']);
            $note = !isset($_POST['note']) ?:  htmlspecialchars($_POST['note']);
            $diachi = !isset($_POST['address']) ?:  htmlspecialchars($_POST['address']);
            $payment = !isset($_POST['payment']) ?:  htmlspecialchars($_POST['payment']);
            $customerId = Auth::getCurrentCustomerId();
            $cart = $this->cartModel->getCurrentCarts();

        /**
         * Tạo đơn hàng trạng thái Pending
         */
            $data = [
                "ma_kh"=>$customerId,
                "ma_pttt"=>$payment,
                "ngay_lap_dh"=>getTime(),
                "thanh_tien"=>$cart['cart']->thanh_tien + SHIPPING_COST,
                "trang_thai"=>OrderStatus::PENDING,
                "thong_tin_nhan_hang"=>json_encode([
                    "ho_ten"=>$hoten,
                    "dien_thoai"=>$phone,
                    "dia_chi"=>$diachi
                ]),
                "note"=>$note
            ];



            $orderId = $this->orderModel->createPendingOrder($data);

            /**
         * Tạo chi tiết đơn hàng
         */
            foreach ($cart['detail'] as $item){
                $sp = $this->productModel->getProductById($item->ma_sp);
                $tenSp = $sp->ten_sp;
                $items = [
                    ...(array)$item,
                    "ten_sp"=>$tenSp
                ];
                $this->orderModel->addOrderItem($orderId,$items);
            }
        /**
         * Xoá giỏ hàng
         */
        $this->cartModel->clear();
        /*
         * Trừ stock
         */
        $this->orderModel->deductStockProductOrder($orderId);
        //$this->orderModel->recollectStockProductOrder($orderId);
        /**
         * Neeus thanh otoan online  -> goi online payment
         */
        if($payment == 2){

            $data = [
                "orderCode" => (int)$orderId,            // Mã đơn hàng
                "amount" => $cart['cart']->thanh_tien + SHIPPING_COST,              // Tổng tiền đơn hàng
                "description" => "Thanh toan don hang #$orderId",          // Mô tả đơn hàng, được sử dụng làm nội dung chuyển khoản
                "returnUrl" => getUrl("checkout/success"),            // URL của trang web hoặc ứng dụng sẽ được chuyển hướng tới khi khách hàng thanh toán thành công
                "cancelUrl" => getUrl("checkout/cancel"),            // URL của trang web hoặc ứng dụng sẽ được chuyển hướng tới khi khách hàng hủy thanh toán
                "buyerName" => $hoten,       // Tên người mua
                "buyerPhone" => $phone,      // Số điện thoại người mua
                "buyerAddress" => $diachi,    // Địa chỉ người mua
                "expiredAt" => 60000,      // Thời gian hết hạn của link thanh toán
            ];

            foreach ($cart['detail'] as $item){
                $data['items'][] = [
                    "name" => $item->ten_sp,             // Tên sản phẩm
                    "quantity" => $item->so_luong,        // Số lượng sản phẩm
                    "price" => $item->don_gia_ban,           // Giá sản phẩm
                ];
            }

            $query =  http_build_query($data);
            Redirect::to("checkout/onlinePayment?$query");
        }
        

        Redirect::to("checkout/success?orderCode=$orderId");

        }catch (Exception $exception){

        }
    }

    public function onlinePayment(){
        require_once 'vendor/autoload.php';

        $payOS = new PayOS('bbd5c01c-081d-4bcb-95e4-b21affa25697',
            '994cf220-cb51-4296-a4d2-804850e3ad66',
            '940e4518963c72faa5b67c9a56148f6c83180f00c27b553752a247e24b400b80');
        $data = [
            'orderCode'=>(int)$_GET['orderCode'],
            'amount'=>(float)$_GET['amount'],
            "description" => $_GET['description'],         // Mô tả đơn hàng, được sử dụng làm nội dung chuyển khoản
            "returnUrl" => $_GET['returnUrl'],       // URL của trang web hoặc ứng dụng sẽ được chuyển hướng tới khi khách hàng thanh toán thành công
            "cancelUrl" => $_GET['cancelUrl'],
            "buyerName" => $_GET['buyerName'],
            "buyerPhone" => $_GET['buyerPhone'],
            "buyerAddress" => $_GET['buyerAddress']
        ];

        foreach ($_GET['items'] as $item){
            $data['items'][] = [
                "name" => $item['name'],             // Tên sản phẩm
                "quantity" => (int)$item['quantity'],  // Số lượng sản phẩm
                "price" => (float)$item['price']     // Giá sản phẩm
            ];
        }
        $data['items'][] = [
            "name" => "PHI VAN CHUYEN",             // Tên sản phẩm
            "quantity" => 1,  // Số lượng sản phẩm
            "price" => (float)SHIPPING_COST     // Giá sản phẩm
        ];

        try {
            $response = $payOS->createPaymentLink($data);
            $paymentURL = $response['checkoutUrl'];
            return header("Location: $paymentURL");
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function success(){
        $data['title'] = "Đặt hàng thành công";
        $this->view('orders.success',$data);
    }

    public function cancel(){
        try {
            $data['title'] = "Đặt hàng không thành công";
            $this->orderModel->recollectStockProductOrder($_GET['orderCode']);
            $this->orderModel->updateOrderStatus($_GET['orderCode'],OrderStatus::CANCEL);
            $this->view('orders.cancel',$data);
        }catch (Exception $exception){
            $exception->getMessage();
        }

    }
}