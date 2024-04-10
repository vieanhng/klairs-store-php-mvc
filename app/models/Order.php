<?php 

    class Order extends Model {

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
            Model::__construct();
            $this->productModel = $this->loadModel('Product');
        }

        public function getCustomerOrderHistory($customerId){
            /**
             * Mã đơn hàng, Ngày đặt, Thành tiền, Trạng thái
             */
            $this->db->query("SELECT * from don_hang where ma_kh = :ma_kh");
            $this->db->bind(":ma_kh",$customerId);
            $orders = $this->db->resultSet();
            if($orders){
                return $orders;
            }else {
                return false;
            }
        }

        public function getOrderByOrderId($orderId){
            /**
             * Mã đơn hàng, Ngày đặt, Thành tiền, Trạng thái
             */
            $this->db->query("select dh.*, pttt.ten_pttt from don_hang dh inner join phuong_thuc_thanh_toan pttt on dh.ma_pttt = pttt.ma_pttt where dh.ma_dh = :madh");
            $this->db->bind(":madh",$orderId);
            $orders = $this->db->single();
            if($orders){
                return $orders;
            }else {
                return false;
            }
        }

        public function getOrderDetail($orderId){
            $this->db->query("select * from  ct_don_hang ctdh where ctdh.ma_dh = :madh");
            $this->db->bind(":madh",$orderId);
            return $this->db->resultSet();
        }

        public function getOrderDataCustomer($orderId){
            if($this->checkUserHasOrder($orderId)) {
                return [
                    'summary' => $this->getOrderByOrderId($orderId),
                    'detail' => $this->getOrderDetail($orderId),
                ];
            }
            return false;
        }

        private function checkUserHasOrder($orderid){
            $this->db->query("select * from  don_hang dh where dh.ma_kh = :ma_kh and dh.ma_dh = :ma_dh");
            $this->db->bind(":ma_kh",Auth::getCurrentCustomerId());
            $this->db->bind(":ma_dh",$orderid);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function createPendingOrder($data){
            $this->db->query("INSERT INTO don_hang 
                (ma_kh,ma_pttt,ngay_lap_dh,thanh_tien,trang_thai,thong_tin_nhan_hang,note) VALUES 
                (:ma_kh,:ma_pttt,:ngay_lap_dh,:thanh_tien,:trang_thai,:thong_tin_nhan_hang,:note)");
            $this->db->bind(":ma_kh",$data['ma_kh']);
            $this->db->bind(":ma_pttt",$data['ma_pttt']);
            $this->db->bind(":ngay_lap_dh",$data['ngay_lap_dh']);
            $this->db->bind(":thanh_tien",$data['thanh_tien']);
            $this->db->bind(":trang_thai",$data['trang_thai']);
            $this->db->bind(":thong_tin_nhan_hang",$data['thong_tin_nhan_hang']);
            $this->db->bind(":note",$data['note']);
            return $this->db->insertById();

        }

        public function getLastCustomerOrder($customerId){
            $this->db->query("select * from don_hang dh where dh.ma_kh = :ma_kh");
            $this->db->bind(":ma_kh",$customerId);
            $orders = $this->db->single();
            if($orders){
                return $orders;
            }else {
                return false;
            }
        }

        public function updateOrderStatus($orderId,$status){
            $this->db->query("UPDATE don_hang SET trang_thai = :trang_thai where ma_dh = :ma_dh");
            $this->db->bind(":trang_thai",$status);
            $this->db->bind(":ma_dh",$orderId);
            $this->db->execute();
        }

        public function addOrderItem($orderId,$item){

                $this->db->query("INSERT INTO ct_don_hang
    (ma_dh,ma_sp,ten_sp,so_luong,don_gia_ban,tong_tien)
    VALUES (:ma_dh,:ma_sp,:ten_sp,:so_luong,:don_gia_ban,:tong_tien)");
            $this->db->bind(":ma_dh",$orderId);
            $this->db->bind(":ma_sp",$item["ma_sp"]);
            $this->db->bind(":ten_sp",$item["ten_sp"]);
            $this->db->bind(":so_luong",$item["so_luong"]);
            $this->db->bind(":don_gia_ban",$item["don_gia_ban"]);
            $this->db->bind(":tong_tien",$item["tong_tien"]);
            $this->db->execute();
        }


        public function recollectStockProductOrder($orderId){
            $order = $this->getOrderByOrderId($orderId);
            $status = $order->trang_thai;
            if($status !== OrderStatus::CANCEL){
                $orderDetail = $this->getOrderDetail($orderId);
                foreach ($orderDetail as $item){
                    $qtyBuy = $item->so_luong;
                    $this->productModel->updateQty($item->ma_sp,"+$qtyBuy");
                }
            }
        }

        public function deductStockProductOrder($orderid){
            $orderDetail = $this->getOrderDetail($orderid);
            foreach ($orderDetail as $item){
                $qtyBuy = $item->so_luong;
                $this->productModel->updateQty($item->ma_sp,"-$qtyBuy");
            }
        }

    }