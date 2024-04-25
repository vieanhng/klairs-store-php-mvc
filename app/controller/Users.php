<?php

class Users extends Controller
{

    private $userModel;
    private $cartModel;

    private Order $orderModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->cartModel = $this->model('Cart');
        $this->orderModel = $this->model("Order");
        $this->email = $this->model('SendEmailModel');
    }

    public function index()
    {
        Auth::userAuth();
    }
    public function register()
    {
        Auth::userGuest();
        $data['title'] = 'Đăng ký';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fullname = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $password = $_POST['password'];
                $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $password2 = $_POST['confirm_password'];

                if (empty($fullname)) {
                    $data['errName'] = 'Họ tên là bắt buộc';
                }

                if (empty($email)) {
                    $data['errEmail'] = 'Email là bắt buộc';
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $data['errEmail'] = 'Nhập đúng định dạng email';
                } elseif ($this->userModel->findUserByEmail($email)) {
                    $data['errEmail'] = 'Email đã tồn tại';
                }

                if ($password != $password2) {
                    $data['errPassword'] = 'Xác nhận mật khẩu không khớp';
                }
                if (empty($data['errEmail']) && empty($data['errName']) && empty($data['errPassword'])) {
                    $this->userModel->register($fullname,$email,$phone, $hashedPassword);
                    Session::set('success', 'Đăng kí tài khoản thành công.');
                    Redirect::to('users/login');
                    exit();
                } else {
                    $this->view('users.register', $data);
                }
        } else {

            $this->view('users.register', $data);
        }

    }

    public function update()
    {
        Auth::userAuth();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userId = Auth::getCurrentCustomerId();
            $userData = $this->userModel->userData($userId);
            $userEmail = $userData->email;
            $fullname = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = $_POST['password'];
            $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $password2 = $_POST['confirm_password'];



            if (empty($fullname)) {
                $data['errName'] = 'Họ tên là bắt buộc';
            }

            if (empty($email)) {
                $data['errEmail'] = 'Email là bắt buộc';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['errEmail'] = 'Nhập đúng định dạng email';
            }elseif ($userEmail != $email && $this->userModel->findUserByEmail($email)) {
                $data['errEmail'] = 'Email đã tồn tại';
            }

            if (empty($data['errEmail']) && empty($data['errName'])) {
                try {

                    $this->userModel->update($userId,$fullname,$email,$phone,$hashedPassword);
                    if ($password == $password2 && !empty($password) && !empty($password2)) {
                        $this->userModel->updatePassword($userId,$hashedPassword);
                    }
                }catch (Exception $exception){
                    Session::set('danger', 'Đã xảy ra lỗi.');
                }
            }
            Redirect::to('users/profile');
        }
        Redirect::to('users/profile');
    }

    public function login()
    {
        Auth::userGuest();
        $data['title'] = 'Login';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (empty($email)) {
                $data['errEmail'] = 'Email là bắt buộc';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['errEmail'] = 'Enter Valid Email';
            } elseif ($this->userModel->findUserByEmail($email) == false) {
                $data['errEmail'] = 'Email hoặc mật khẩu không đúng';
            }

            if (empty($password)) {
                $data['errPassword'] = "Password Must Has Value.";
            }

            if (empty($data['errEmail']) && empty($data['errPassword'])) {
                $user = $this->userModel->login($email, $password);
                if ($user) {
                    Session::set('user_id', $user->ma_kh);
                    $data['cart'] = $this->cartModel->getCurrentCarts();
                    $cartItems = 0;
                    foreach ($data['cart']['detail'] as $cart) {
                        $cartItems = $cartItems + $cart->so_luong;
                    }
                    Session::set('user_cart', $cartItems);
                    Redirect::to('users/profile');
                } else {
                    $data['errEmail'] = 'Email hoặc mật khẩu không đúng';
                    $this->view('users.login', $data);
                }
            } else {
                $this->view('users.login', $data);
            }
        } else {
            $this->view('users.login', $data);
        }
    }

    public function logout()
    {
        Auth::userAuth();
        Session::clear('user_name');
        Session::clear('user_id');
        Session::destroy();
        Redirect::to('users/login');
    }


    public function profile()
    {
        Auth::userAuth();
        $data['title'] = 'Thông tinn tài khoản';
        $user_id = Session::name('user_id');
        $user = $this->userModel->userData($user_id);
        $data['user'] = $user;
        $this->view('users.profile', $data);

    }

    public function orderHistory($params){
        Auth::userAuth();
        $data['title'] = 'Lịch sử mua hàng';
        $orderId = isset($params['orderId']) ? $params['orderId'] : '';
        $userId = Auth::getCurrentCustomerId();

        if($orderId && $this->orderModel->getOrderDataCustomer($orderId)){
            $order = $this->orderModel->getOrderDataCustomer($orderId);
            $data['title'] = "Đơn hàng #$orderId";
            $data['order'] = $order;
            $this->view('front.orderDetail',$data);
        }else{
            $orderList = $this->orderModel->getCustomerOrderHistory($userId);
            $data['orderList'] = $orderList;
            $this->view('front.orderHistory',$data);
        }
    }

    public function resetPassword(){
        try {
            Auth::userGuest();
            $email = $_POST['email'];
            $password = random_password();
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $this->sendEmail->resetPass($email,$password);
            $this->userModel->resetPass($email,$hashedPassword);
            echo json_encode([
                'status'=>true,
                'message'=>'Reset password thành công'
            ]);
        }catch (Exception $exception){
            Session::set('editCustomerFail', $exception->getMessage());
        }
    }

}