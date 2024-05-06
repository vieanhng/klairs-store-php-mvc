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

        public function getOrderByCusId($cusId){
            $this->db->query("SELECT dh.ma_dh, dh.ngay_lap_dh, dh.trang_thai, dh.thanh_tien
                                FROM don_hang dh
                                WHERE dh.ma_kh = :ma_kh");
            $this->db->bind(":ma_kh",$cusId);
            $orders = $this->db->resultSet();
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

        public function getSellToday(){
            $this->db->query(" SELECT COUNT(dh.ma_dh) AS so_luong_dh, 
            SUM(ctdh.so_luong) AS so_sp_ban, 
            SUM(thanh_tien) AS doanh_thu, 
            SUM(thanh_tien - ctdh.so_luong * don_gia_nhap) AS loi_nhuan
            FROM don_hang dh
            INNER JOIN ct_don_hang ctdh ON dh.ma_dh = ctdh.ma_dh
            INNER JOIN san_pham sp ON sp.ma_sp=ctdh.ma_sp
            WHERE DATE(ngay_cap_nhat) = CURRENT_DATE()  AND trang_thai = 'Thành công'");
            $sellToday = $this->db->single();
            if($sellToday){
                return $sellToday;
            }else {
                return false;
            }
        }

        public function getRevenue(){
            $this->db->query(" SELECT SUM(thanh_tien) AS doanh_thu,
            MONTH(ngay_cap_nhat) AS thang, YEAR(ngay_cap_nhat) AS nam
            FROM don_hang
            WHERE trang_thai='Thành công'
            GROUP BY MONTH(ngay_cap_nhat), YEAR(ngay_cap_nhat)
            ORDER BY YEAR(ngay_cap_nhat) DESC
            LIMIT 6");
            $result = $this->db->resultSet();
            if($result){
                return $result;
            }else {
                return false;
            }
        }

        public function getTopPro(){
            $this->db->query("SELECT anh_sp, sp.ten_sp, SUM(ctdh.so_luong) AS so_sp_ban, sum(thanh_tien) AS doanh_thu
            FROM don_hang dh
            INNER JOIN ct_don_hang ctdh ON dh.ma_dh = ctdh.ma_dh
            INNER JOIN san_pham sp ON sp.ma_sp=ctdh.ma_sp
            WHERE MONTH(ngay_cap_nhat) = MONTH (CURRENT_DATE()) AND trang_thai = 'Thành công'
            GROUP BY anh_sp, sp.ten_sp
            LIMIT 10");
            $topPro = $this->db->resultSet();
            if($topPro){
                return $topPro;
            }else {
                return false;
            }
            
        }

        public function getSellSummary($search){
            $today = getTodayDate();

            $filter  = array(
                'from_date'     => $_GET['from_date'] ?? false,
                'to_date'   => $_GET['to_date'] ?? false,
                //'order'  => $_GET['status'] ?? false
            );

            $orderBy = $_GET['order'] ?? 'DESC';

            $where = array();
            
            if ($filter['from_date']){
                $where[] = "ngay_lap_dh >= '{$filter['from_date']}'";
            }

            if ($filter['to_date']){
                $where[] = "ngay_lap_dh <= '{$filter['to_date']}'";
            }
        
            $query = " SELECT COUNT(dh.ma_dh) AS so_luong_dh, 
                                SUM(ctdh.so_luong) AS so_sp_ban, 
                                SUM(thanh_tien) AS doanh_thu, 
                                SUM(thanh_tien - ctdh.so_luong * don_gia_nhap) AS loi_nhuan
                        FROM don_hang dh
                        INNER JOIN ct_don_hang ctdh ON dh.ma_dh = ctdh.ma_dh
                        INNER JOIN san_pham sp ON sp.ma_sp=ctdh.ma_sp";
            if ($where){
                $query .= ' WHERE '.implode(' AND ', $where);
            }
                else {
                $query .= ' WHERE DATE(ngay_lap_dh) = '."'$today'";   
                }
            if ($orderBy){
                $query .= ' ORDER BY so_sp_ban '.$orderBy;
            }

            $this->db->query($query);
            $sellSummary = $this->db->single();
            if($sellSummary){
                return $sellSummary;
            }else {
                return false;
            }
        }

        

        public function getReportPros($search){
            $today = getTodayDate();

            $filter  = array(
                'from_date'     => $_GET['from_date'] ?? false,
                'to_date'   => $_GET['to_date'] ?? false,
            );

            $orderBy = $_GET['order'] ?? 'DESC';

            $where = array();
            
            if ($filter['from_date']){
                $where[] = "ngay_lap_dh >= '{$filter['from_date']}'";
            }

            if ($filter['to_date']){
                $where[] = "ngay_lap_dh <= '{$filter['to_date']}'";
            }

            $query = " SELECT san_pham.ma_sp, san_pham.ten_sp, 
                            SUM(ct_don_hang.so_luong) AS so_sp_ban, sum(thanh_tien) AS doanh_thu, 
                            SUM(thanh_tien - ct_don_hang.so_luong * don_gia_nhap) AS loi_nhuan
                        FROM don_hang 
                        INNER JOIN ct_don_hang ON don_hang.ma_dh = ct_don_hang.ma_dh
                        INNER JOIN san_pham ON san_pham.ma_sp=ct_don_hang.ma_sp";
                        
            if ($where){
                $query .= ' WHERE '.implode(' AND ', $where);
            }
                else {
                $query .= ' WHERE DATE(ngay_lap_dh) = '."'$today'";   
                }
            $query = $query.' GROUP BY san_pham.ma_sp, san_pham.ten_sp';
            if ($orderBy){
                $query .= ' ORDER BY so_sp_ban '.$orderBy;
            }

            $this->db->query($query);
            $reportPros = $this->db->resultSet();
            if($reportPros){
                return $reportPros;
            }else {
                return false;
            }
        }

        

        public function getReportCats($search){
            $today = getTodayDate();

            $filter  = array(
                'from_date'     => $_GET['from_date'] ?? false,
                'to_date'   => $_GET['to_date'] ?? false,
            );

            $orderBy = $_GET['order'] ?? 'DESC';

            $where = array();
            
            if ($filter['from_date']){
                $where[] = "ngay_lap_dh >= '{$filter['from_date']}'";
            }

            if ($filter['to_date']){
                $where[] = "ngay_lap_dh <= '{$filter['to_date']}'";
            }

            $query = " SELECT danh_muc.ma_danh_muc, danh_muc.ten_danh_muc, 
                            SUM(ct_don_hang.so_luong) AS so_luong_ban,
                            SUM(thanh_tien) AS doanh_thu, 
                            SUM(thanh_tien - ct_don_hang.so_luong * don_gia_nhap) AS loi_nhuan
                        FROM don_hang 
                        INNER JOIN ct_don_hang ON don_hang.ma_dh = ct_don_hang.ma_dh
                        INNER JOIN san_pham ON san_pham.ma_sp=ct_don_hang.ma_sp
                        INNER JOIN dm_sp_link ON san_pham.ma_sp = dm_sp_link.ma_sp
                        INNER JOIN danh_muc ON danh_muc.ma_danh_muc = dm_sp_link.ma_danh_muc";
                        
            if ($where){
                $query .= ' WHERE '.implode(' AND ', $where);
            }
                else {
                $query .= ' WHERE DATE(ngay_lap_dh) = '."'$today'";   
                }
            $query = $query.' GROUP BY danh_muc.ma_danh_muc, danh_muc.ten_danh_muc';
            if ($orderBy){
                $query .= ' ORDER BY so_luong_ban '.$orderBy;
            }

            $this->db->query($query);
            $reportCats = $this->db->resultSet();
            if($reportCats){
                return $reportCats;
            }else {
                return false;
            }
        }

       

        public function getReportRes($search){
            $today = getTodayDate();

            $filter  = array(
                'from_date'     => $_GET['from_date'] ?? false,
                'to_date'   => $_GET['to_date'] ?? false,
            );

            $orderBy = $_GET['order'] ?? 'DESC';

            $where = array();
            
            if ($filter['from_date']){
                $where[] = "ngay_lap_dh >= '{$filter['from_date']}'";
            }

            if ($filter['to_date']){
                $where[] = "ngay_lap_dh <= '{$filter['to_date']}'";
            }

            $query = " SELECT date(ngay_lap_dh) AS ngay ,
                            COUNT(don_hang.ma_dh) AS so_luong_dh, 
                            SUM(ct_don_hang.so_luong) AS so_sp_ban, 
                            SUM(thanh_tien) AS doanh_thu, 
                            SUM(thanh_tien - ct_don_hang.so_luong * don_gia_nhap) AS loi_nhuan
                        FROM don_hang 
                        INNER JOIN ct_don_hang ON don_hang.ma_dh = ct_don_hang.ma_dh
                        INNER JOIN san_pham ON san_pham.ma_sp=ct_don_hang.ma_sp";
                        
            if ($where){
                $query .= ' WHERE '.implode(' AND ', $where);
            }
                else {
                $query .= ' WHERE DATE(ngay_lap_dh) = '."'$today'";   
                }
            $query = $query.' GROUP BY date(ngay_lap_dh)';
            if ($orderBy){
                $query .= ' ORDER BY so_sp_ban '.$orderBy;
            }

            $this->db->query($query);
            $reportRes = $this->db->resultSet();
            if($reportRes){
                return $reportRes;
            }else {
                return false;
            }
        }




    }    
?>        