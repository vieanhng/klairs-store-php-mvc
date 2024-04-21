<?php
class Customers extends Controller
{

    protected Customer $customerModel;
   

    const title = 'Quản lý khách hàng';

    public function __construct()
    {
        $this->customerModel = $this->model('Customer');
        $this->orderModel = $this->model('Order');
    }
// Danh sách khách hàng
    public function index()
    {
        Auth::adminAuth();
        $data['title'] = self::title;
        $data['subtitle'] = 'Danh sách khách hàng';

        $customers = $this->customerModel->getCustomer($_GET);
        
        $data['customers'] = $customers;
       
        $this->view('admin.customers.customer_grid', $data);
    }
// Thêm mới khách hàng - chưa xong
    public function create()
    {
        Auth::adminAuth();
        $data['title'] = self::title;
        $data['subtitle'] = 'Thêm mới khách hàng';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                isset($_POST['email']) ? $email = $_POST['email'] : $email = '';

                if($this->customerModel->findCustomerByEmail($email)){
                    Session::set('addCustomerFail', 'Khách hàng đã tồn tại');
                    Redirect::back();
                    
                }
            
                isset($_POST['ten_kh']) ? $ten_kh = $_POST['ten_kh'] : $ten_kh = '';
                isset($_POST['sdt']) ? $sdt = $_POST['sdt'] : $sdt = '';
                

                $this->customerModel->addNewCustomer(
                    $ten_kh,
                    $email,
                    $sdt,
                    //$mat_khau
                );
                Session::set('addCustomerSuccess', 'Thêm khách hàng thành công');
                Redirect::to('admin/customers');

            } catch (\Exception $e) {
                Session::set('addCustomerFail', $e->getMessage());
                Redirect::to('admin/customers');
            }

        }
        $this->view('admin.customers.customer_form', $data);
    }
// xóa khách hàng
    public function delete($param)
    {
        try {
            Auth::adminAuth();
            $id = $param['id'];
            $this->customerModel->deleteCustomerById($id);
            Session::set('deleteCustomerSuccess', 'Xoá khách hàng thành công');
            Redirect::to('admin/customers');
        }catch (\Exception $e) {
            Session::set('deleteCustomerFail', $e->getMessage());
            Redirect::to('admin/customers');
        }
    }

// Cập nhật khách hàng  
public function edit($param){
    $data['title'] = self::title;
    $data['subtitle'] = 'Cập nhật khách hàng';
    $data['subtitle1'] = 'Danh sách đơn hàng';
    try {
        Auth::adminAuth();
        $id = $param['id'];
       
        $data['customer'] = $this->customerModel->getCustomerById($id);
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {

                isset($_POST['ten_kh']) ? $ten_kh = $_POST['ten_kh'] : $ten_kh = '';
                isset($_POST['sdt']) ? $sdt = $_POST['sdt'] : $sdt = '';
                isset($_POST['mat_khau']) ? $mat_khau = $_POST['mat_khau'] : $mat_khau = '';

                $this->categoryModel->updateCustomer(
                    $id,
                    $ten_kh,
                    $sdt,
                    $mat_khau
    
                );
                Session::set('updateCustomerSuccess', 'Cập nhật thành công');
                Redirect::back();

            } catch (\Exception $e) {
                Session::set('UpdateCustomerFail', $e->getMessage());
                Redirect::to('admin/customers');
            }

        }
    }catch (Exception $e){
        Session::set('editCustomerFail', $e->getMessage());
    }

    $orders = $this->orderModel->getOrderByCusId($id);    
    $data['orders'] = $orders;

 

    $this->view('admin.customers.customer_form', $data);
}  
}
?>