<?php

class Payments extends Controller
{
    /**
     * @var mixed
     */
    private PaymentMethod $paymentMethodModel;

    public function __construct()
    {
        $this->paymentMethodModel = $this->model("PaymentMethod");
    }

    public function index(){
        $data['title'] = 'Quản lý phương thức thanh toán';
        $data['subtitle'] = 'Danh sách phương thức thanh toán';

        $data['payments'] = $this->paymentMethodModel->getPaymentMethods();

        $this->view("admin.payment.paymentMethods",$data);
    }

    public function updateStatus()
    {
        $id = $_POST['id'];
        $status = $_POST["status"] == true ? 1 : 0;

        try{
            $this->paymentMethodModel->updateStatus($id, $status);
            echo json_encode([
                'status' => true,
                'message' => "Cập nhật thành công."
            ]);
        } catch (Exception $ex) {
            echo json_encode([
                'status' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }
}