<?php


use PayOS\PayOS;

class Checkout extends Controller
{
    public function __construct()
    {
        $this->cartModel = $this->model('Cart');
    }

    /**
     * @var Cart
     */
    private Cart $cartModel;

    public function index()
    {
        $data['title'] = 'Thanh toán';
        $cart = $this->cartModel->getCurrentCarts();
        $data['cart'] = $cart;

        $this->view('front.checkout',$data);
    }

    public function placeOrder(){
        Auth::userAuth();
        var_dump($_POST);
        var_dump($this->cartModel->getCurrentCarts());
        try {
//            $hoten = isset($_POST['name']) ?:  htmlspecialchars($_POST['name']);
//            $phone = isset($_POST['phone']) ?:  htmlspecialchars($_POST['phone']);
//            $note = isset($_POST['note']) ?:  htmlspecialchars($_POST['note']);
//            $diachi = isset($_POST['address']) ?:  htmlspecialchars($_POST['address']);
//            $payment =
//            $customerId = Auth::getCurrentCustomerId();
//            $cart = $this->$this->cartModel->getCurrentCarts();

        /**
         * Tạo đơn hàng trạng thái Pending
         */

        /**
         * Tạo chi tiết đơn hàng
         */

        /**
         * Xoá giỏ hàng
         */
        

        /**
         * Cập nhật đơn hàng
         */



        }catch (Exception $exception){

        }
    }

    public function onlinePayment(){
        require_once 'vendor/autoload.php';

        $payOS = new PayOS('bbd5c01c-081d-4bcb-95e4-b21affa25697',
            '994cf220-cb51-4296-a4d2-804850e3ad66',
            '940e4518963c72faa5b67c9a56148f6c83180f00c27b553752a247e24b400b80');

        $data = [
            "orderCode" => intval(substr(strval(microtime(true) * 10000), -6)),
            "amount" => 2000,
            "description" => "Create payment link",
            "items" => [
                [
                    "name" => "Mỳ tôm Hảo Hảo ly",
                    "quantity" => 1,
                    "price" => 2000
                ]
            ],
            "returnUrl" => getUrl('checkout/success'),
            "cancelUrl" => getUrl('checkout/cancel')
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
        echo "sucess payment";
    }

    public function cancel(){
        echo "cancel payment";
    }
}