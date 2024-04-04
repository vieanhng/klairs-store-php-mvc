<?php

class Users extends Controller
{

    private $userModel;
    private $cartModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->cartModel = $this->model('Cart');
        $this->email = $this->model('SendEmailModel');
    }

    public function index()
    {
        Auth::userAuth();
    }
    public function register()
    {
        Auth::userGuest();
        $data['title1'] = 'Register';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fullname = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $password = $_POST['password'];
                $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $password2 = $_POST['confirm_password'];

                if (empty($fullname)) {
                    $data['errName'] = 'Name Must Has Value.';
                }

                if (empty($email)) {
                    $data['errEmail'] = 'Email Must Has Value.';
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $data['errEmail'] = 'Enter Valid Email';
                } elseif ($this->userModel->findUserByEmail($email)) {
                    $data['errEmail'] = 'This Email is Already Exists';
                }

                if (strlen($password) < 1) {
                    $data['errPassword'] = "Your Password Must Contain At Least 8 Characters!";
                }


                if ($password != $password2) {
                    $data['errPassword2'] = 'Password not match';
                }
                if (empty($data['errEmail']) && empty($data['errName']) && empty($data['errPassword']) && empty($data['errPassword2'])) {
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
                $data['errName'] = 'Name Must Has Value.';
            }

            if (empty($email)) {
                $data['errEmail'] = 'Email Must Has Value.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['errEmail'] = 'Enter Valid Email';
            }elseif ($userEmail != $email && $this->userModel->findUserByEmail($email)) {
                $data['errEmail'] = 'This Email is Already Exists';
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
                $data['errEmail'] = 'Email Must Has Value.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['errEmail'] = 'Enter Valid Email';
            } elseif ($this->userModel->findUserByEmail($email) == false) {
                $data['errEmail'] = 'This Email Is Not Exist';
            }

            if (empty($password)) {
                $data['errPassword'] = "Password Must Has Value.";
            }

            if (empty($data['errEmail']) && empty($data['errPassword'])) {
                $user = $this->userModel->login($email, $password);
                if ($user) {
                        Session::set('user_id', $user->ma_kh);
//                        $cartItems = 0;
//                        $carts = $this->cartModel->getAllCart();
//                        if ($carts) {
//                            foreach ($carts as $cart) {
//                                $cartItems = $cartItems + $cart->qty;
//                            }
//                        } else {
//                            $cartItems = 0;
//                        }
                        Redirect::to('users/profile');
                } else {
                    $data['errPassword'] = "Password Not Valid";
                    $this->view('users.login', $data);
                }
            } else {
                echo "test";
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

}