<?php

class AdminOrder extends Model
{
    public function __construct()
    {
        Model::__construct();
        $this->orderModel = $this->loadModel('Order');
        //$this->customerModel = $this->loadModel('Customer');
    }

    public function getOrderSummary($search)
    {
        $today = getTodayDate();

        $filter  = array(
            'ma_dh'     => $_GET['ma_dh'] ?? false,
            'from_date'     => $_GET['from_date'] ?? false,
            'to_date'   => $_GET['to_date'] ?? false,
            'status'  => $_GET['status'] ?? false
        );


        $where = array();

        if ($filter['ma_dh']){
            $where[] = "ma_dh = '{$filter['ma_dh']}'";
        }

        if ($filter['from_date']){
            $where[] = "ngay_lap_dh >= '{$filter['from_date']}'";
        }

        if ($filter['to_date']){
            $where[] = "ngay_lap_dh <= '{$filter['to_date']}'";
        }

        if ($filter['status']){
            $where[] = "trang_thai = '{$filter['status']}'";
        }

        $query = "SELECT ma_dh, ten_kh, ngay_lap_dh, trang_thai, thanh_tien
        FROM don_hang
        INNER JOIN khach_hang ON don_hang.ma_kh=khach_hang.ma_kh";
        if ($where){
            $query .= ' WHERE '.implode(' AND ', $where);
        }
        $this->db->query($query);
        $orders = $this->db->resultSet();
        if($orders){
            return $orders;
        }else {
            return false;
        }

    }

    public function deleteOrder($id)
    {
        $this->db->query("DELETE FROM don_hang WHERE ma_dh = :ma_dh");
        $this->db->bind('ma_dh', $id);
        $this->db->execute();
    }

    public function getOrderData($orderId){
            return [
                'summary' => $this->orderModel->getOrderByOrderId($orderId),
                'detail' => $this->orderModel->getOrderDetail($orderId),
                'cutomer'=>$this->customerModel->getC($orderId)
            ];
    }
}