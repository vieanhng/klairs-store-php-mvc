<?php 

    class Customer extends Model {

        /**
         * @var mixed
         */
        private Customer $customerModel;

        public function __construct(){
            Model::__construct();
        }

        public function getCustomer($search = ''){
            $act = '';
            if(isset($search["email_ten"])){
             
              // $search = strtolower($search["email_ten"]); 
               $search = $search["email_ten"]; 
              
               $act = "WHERE kh.ma_kh LIKE '%$search%' OR kh.ten_kh LIKE '%$search%'  ";
            }
               
        
            
            $this->db->query(
                "SELECT
                    kh.ma_kh, kh.ten_kh, kh.email, kh.dien_thoai,
                    COUNT(CASE WHEN dh.trang_thai = 'Thành công' THEN 1 ELSE NULL END) AS so_don_hang,
                    SUM(CASE WHEN dh.trang_thai = 'Thành công' THEN dh.thanh_tien ELSE 0 END) AS tri_gia
                FROM
                    khach_hang kh
                LEFT JOIN
                    don_hang dh ON kh.ma_kh = dh.ma_kh
                $act GROUP BY
                    kh.ma_kh, kh.ten_kh, kh.email, kh.dien_thoai"
                );

            $customers = $this->db->resultSet();
            
            
           if($customers){
               return $customers;
           }else {
               return false;
           }
        }

        public function getCustomerById($id){
            $this->db->query("SELECT kh.ma_kh, kh.ten_kh, kh.email, kh.dien_thoai,
                COUNT(CASE WHEN dh.trang_thai = 'Thành công' THEN 1 ELSE NULL END) AS so_don_hang,
                SUM(CASE WHEN dh.trang_thai = 'Thành công' THEN dh.thanh_tien ELSE 0 END) AS tri_gia
            FROM
                khach_hang kh
            LEFT JOIN
                don_hang dh ON kh.ma_kh = dh.ma_kh
            WHERE kh.ma_kh=:ma_kh 
            GROUP BY
                kh.ma_kh, kh.ten_kh, kh.email, kh.dien_thoai
            ");
            $this->db->bind(':ma_kh',$id);
            $customer = $this->db->single();
            if($customer){
                return $customer;
            }else {
                return false;
            }
        }


        public function findCustomerByEmail($email){
            $this->db->query("SELECT * FROM khach_hang WHERE 
            email =:email");
            $this->db->bind(':email',$email);
         //   $this->db->execute();
            $customer = $this->db->single();
            if($customer){
                return $customer;
            }else{
                return false;
            };
        }
        
        public function deleteCustomerById($id){
            $this->db->query('DELETE FROM khach_hang WHERE ma_kh = :ma_kh');
            $this->db->bind(':ma_kh',$id);
            return $this->db->execute();
        }

    }       
?>        