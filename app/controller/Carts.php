<?php

class Carts extends Controller
{
    private Cart $cartModel;
    private $orderModel;
    /**
     * @var Product
     */
    private Product $productModel;

    public function __construct()
    {
        Auth::userAuth();
        $this->cartModel = $this->model('Cart');
        $this->orderModel = $this->model('Order');
        $this->productModel = $this->model('Product');
    }


    public function index()
    {
        $data['title'] = 'Giỏ hàng';
        $cartItems = 0;
        try {
            if ($this->cartModel->getCurrentCarts()) {
                $cart = $this->cartModel->getCurrentCarts();
                $cartId = $cart['cart']->ma_gio_hang;
                $this->cartModel->collectCartTotal($cartId);
                $data['cart'] = $this->cartModel->getCurrentCarts();
                foreach ($data['cart']['detail'] as $cart) {
                    $cartItems = $cartItems + $cart->so_luong;
                }
            } else {
                $cartItems = 0;
            }
        }catch (Exception $exception){

        }
        Session::set('user_cart', $cartItems);

        $this->view('front.cart', $data['cart']);
    }


    public function thank()
    {
        Auth::userAuth();
        $data['title1'] = 'Thank You';
        $data['title2'] = 'Transaction Done';
        $this->view('front.thank', $data);
    }

    public function orders()
    {
        Auth::userAuth();
        $data['title1'] = 'Orders';
        $data['orderDetails'] = $this->orderModel->getUserOrderDetalails(Session::name('user_id'));
        $this->view('front.orders', $data);
    }


    public function add()
    {
        Auth::userAuth();

        try {
            if(isset($_POST['productId']))
                $productId = $_POST['productId'];
            if(isset($_POST['qty']))
                $qty = $_POST['qty'];

            if(!empty($productId) && !empty($qty)){
                if($this->cartModel->addToCart($productId,$qty)){
                    Session::set('successAddToCart','Thêm sản phẩm thành công.');
                    Redirect::to('carts');
                }else{
                    Session::set('addToCartFail','Số lượng không có sẵn.');
                    Redirect::back();
                }
            }

        }catch (Exception $e){
            Session::set('addToCartFail','Có lỗi xảy ra.');
        }
    }

    public function updateCart()
    {
        Auth::userAuth();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $request = $_POST;
                $cartId = $request['cartId'];
                $items = $request['items'];

                foreach ($items as $item) {
                    $product = $this->productModel->getProductById($item['id']);

                    if ($item['qty'] > 0) {
                        if ($item['qty'] <= $product->so_luong) {
                            $this->cartModel->updateQty($cartId, $item['id'], $item['qty']);
                        } else {
                            http_response_code(400);
                            Session::set('errorUpdateCart', 'Số lượng sản phẩm không đủ');
                            exit();
                        }
                    }
                }
                Session::set('successUpdateCart', 'Cập nhật thành công.');
            } catch (Exception $e) {
                http_response_code(400);
                Session::set('errorUpdateCart', 'Đã xảy ra lỗi.');
                exit();
            }
        }
    }

    public function deleteItem($id)
    {
        Auth::userAuth();

    }

    public function clear()
    {
        Auth::userAuth();
        Session::set('success', 'All Item has been deleted');
        $delete = $this->cartModel->clear();
        if ($delete) {
            Redirect::to('carts');
        }
    }

    public function checkout()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            require_once('../vendor/autoload.php');
            \Stripe\Stripe::setApiKey('sk_test_dRGPlCrOt3QXSuOxSwhvT5cZ00xTVDsc19');

            $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
            $name = $_POST['name'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $total = $_POST['total'];
            $qty = $_POST['qty'];


            if (empty($_POST['payment_method'])) {
                $data['errMethod'] = 'You must choose payment method';
            }
            if (strlen($name) < 4) {
                $data['errName'] = 'Name must not be less than 4 characters';
            }
            if (empty($email)) {
                $data['errEmail'] = 'Email Must Has Value.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['errEmail'] = 'Enter Valid Email';
            }

            if (strlen($mobile) < 11) {
                $data['errMobile'] = 'Name must not be less than 11 characters';
            }

            if (empty($address)) {
                $data['errAddress'] = 'Address Must Has Value.';
            }
            if (empty($city)) {
                $data['errCity'] = 'City Must Has Value.';
            }

            if (empty($data['errName']) && empty($data['errEmail'])
                && empty($data['errMobile']) && empty($data['errAddress'])
                && empty($data['errCity']) && empty($data['errMethod'])) {

                if ($_POST['payment_method'] == 'stripe') {
                    $token = $_POST['stripeToken'];
                    $customer = \Stripe\Customer::create(array(
                        'email' => $email,
                        'source' => $token
                    ));

                    $charge = \Stripe\Charge::create([
                        'amount' => $qty * 100,
                        'currency' => 'usd',
                        'description' => 'Transaction from market website',
                        'customer' => $customer->id
                    ]);

                }

                $shipping_id = $this->orderModel->addToShipping($name, $email, $mobile, $address, $city);
                Session::set('shipping_id', $shipping_id);

                //complete order
                $payment_id = $this->orderModel->addToPayment($_POST['payment_method'], $shipping_id);

                $order_id = $this->orderModel->addToOrder(
                    Session::name('user_id'), $shipping_id, $payment_id
                    , $total
                );

                $data['cart'] = $this->cartModel->getAllCart();
                foreach ($data['cart'] as $cart) {
                    $this->orderModel->addToOrderDetails(
                        $order_id, $cart->product, $cart->pro_name,
                        $cart->price, $cart->qty, Session::name('user_id')
                    );
                }

                $this->cartModel->clear();
                Session::set('user_cart', '0');
                Redirect::to("carts/thank");

            } else {
                $data['cart'] = $this->cartModel->getAllCart();
                $this->view('front.cart', $data);
            }
        } else {
            Redirect::to('carts');
        }
    }
}