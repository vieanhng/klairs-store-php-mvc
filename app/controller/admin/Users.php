<?php

class Users extends Controller
{
    private $adminModel;

    public function __construct()
    {
        $this->adminModel = $this->model('AdminUser');
    }

    public function index()
    {
        if (Auth::adminAuth()) {
            Redirect::to('admin/dashboard');
        };
    }

    public function login()
    {
        $data['title'] = 'Đăng nhập Quản lý';
        Auth::adminGuest();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $email = $_POST['email'];
            $password = $_POST['password'];

            if (empty($email)) {
                $data['errEmail'] = 'Email Must Has Value.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['errEmail'] = 'Enter Valid Email';
            } elseif ($this->adminModel->findUserByEmail($email) == false) {
                $data['errEmail'] = 'This Email Is Not Exist';
            }

            if (empty($password)) {
                $data['errPassword'] = "Password Must Has Value.";
            }

            if (empty($data['errEmail']) && empty($data['errPassword'])) {
                $admin = $this->adminModel->login($email, $password);
                if ($admin) {
                    Session::set('admin_name', $admin->ten_user);
                    Session::set('admin_id', $admin->ma_user);
                    Redirect::to('admin/dashboard');
                } else {
                    $data['errPassword'] = "Password Not Valid OR not admin";
                    $this->view('admins.login', $data);
                }
            } else {
                Redirect::to('admin/users/login');
            }

        } else {
            $this->view('admin.login', $data);
        }
    }

    public function logout()
    {
        Auth::adminAuth();
        Session::clear('admin_name');
        Session::destroy();
        Redirect::to('admins/login');
    }
}
