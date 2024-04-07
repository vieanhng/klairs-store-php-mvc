<?php

class Carts extends Controller
{
    private Cart $cartModel;
    private Order $orderModel;

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

        $this->view('front.cart', $data);
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

    public function deleteItem($params)
    {
        Auth::userAuth();
        $productId = $params['id'];
        $currentCart = $this->cartModel->getCurrentCarts();
        $cartId = $currentCart['cart']->ma_gio_hang;
        try {
            $this->cartModel->deleteItem($productId,$cartId);
            Session::set('successUpdateCart', 'Đã xoá sản phẩm khỏi giỏ hàng.');
            Redirect::back();
        }catch (Exception $e){
            Session::set('errorUpdateCart', 'Đã xảy ra lỗi.');
        }

    }

    public function clear()
    {
        Auth::userAuth();
        try {
            $this->cartModel->clear();
            Session::set('successUpdateCart', 'Đã xoá giỏ hảng.');
            Redirect::to('carts');
        }catch (Exception $exception){
            Session::set('errorUpdateCart', 'Đã xảy ra lỗi.');
        }
    }

    public function checkout()
    {

    }
}