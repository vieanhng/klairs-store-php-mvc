<?php 

    class Product extends Model {

        /**
         * @var mixed
         */
        private Category $categoryModel;

        public function __construct(){
            Model::__construct();
            $this->categoryModel = $this->loadModel('Category');
        }


        public function getAllPro($search = ''){
            $act = '';
            if(!empty($search)){
                $search = strtolower($search);
                $act = "WHERE sp.ten_sp LIKE '%$search%'";
            }
            $this->db->query("SELECT * from san_pham sp 
            $act 
            ");
            $products = $this->db->resultSet();
           if($products){
               return $products;
           }else {
               return false;
           }
        }

        public function getProducts($search)
        {
            $productIds = [];

            if(isset($search['cat'])){
                $categoryId = $search['cat'];
                $productIds = $this->categoryModel->getCategoryProductIds($categoryId);
            }

            if($productIds){
                foreach ($productIds as &$productId) {
                    $productId = "'$productId'";
                }
                $productIds = implode(',', $productIds);
            }

            if(!empty($productIds)){
                $where[] = "ma_sp IN ($productIds)";
            }

            if(!empty($search['ma_ten'])){
                $where[] = "sp.ma_sp LIKE '%$search[ma_ten]%' OR sp.ten_sp LIKE '%$search[ma_ten]%'";
            }
            $query = "SELECT ma_sp,anh_sp, ten_sp, don_gia_ban, (SELECT GROUP_CONCAT(dm.ten_danh_muc SEPARATOR ', ') 
     FROM dm_sp_link dsl INNER JOIN danh_muc dm ON dsl.ma_danh_muc = dm.ma_danh_muc
     WHERE dsl.ma_sp = sp.ma_sp) as danh_muc
FROM san_pham sp";
            if(!empty($where)){
                $query .= " WHERE " . implode(" AND ", $where);
            }
            $this->db->query($query);
            $products = $this->db->resultSet();
            if ($products) {
                return $products;
            } else {
                return false;
            }
        }





        public function getProductById($id){
            $this->db->query("SELECT sp.* FROM san_pham sp
            WHERE ma_sp=:ma_sp");
            $this->db->bind(':ma_sp',$id);
            $products = $this->db->single();
            if($products){
                return $products;
            }else {
                return false;
            }
        }

        public function updateQty($productId, $qty){
            $this->db->query('UPDATE san_pham SET so_luong  = so_luong '.$qty." WHERE ma_sp = :ma_sp");
            $this->db->bind(':ma_sp',$productId);
            return $this->db->execute();
        }

        public function addNewProduct($ma_sp, $ten_sp, $anh_sp,$don_gia_nhap, $don_gia_ban, $so_luong, $mo_ta, $ma_danh_muc){
            $query = 'INSERT INTO san_pham (ma_sp, ten_sp, don_gia_nhap, don_gia_ban, anh_sp, so_luong, mo_ta)
VALUES (:ma_sp, :ten_sp, :don_gia_nhap, :don_gia_ban, :anh_sp, :so_luong, :mo_ta)';
            $this->db->query($query);
            $this->db->bind(':ma_sp',$ma_sp);
            $this->db->bind(':ten_sp',$ten_sp);
            $this->db->bind(':don_gia_nhap',$don_gia_nhap);
            $this->db->bind(':don_gia_ban',$don_gia_ban);
            $this->db->bind(':anh_sp',$anh_sp);
            $this->db->bind(':so_luong',$so_luong);
            $this->db->bind(':mo_ta',$mo_ta);
            $this->db->execute();

            $this->addSpDmLink($ma_sp, $ma_danh_muc);
        }



        public function addSpDmLink($ma_sp, $ma_danh_muc){
            foreach ($ma_danh_muc as $danh_muc){
                $this->db->query('INSERT INTO dm_sp_link VALUES (:ma_sp, :danh_muc)');
                $this->db->bind(':ma_sp',$ma_sp);
                $this->db->bind(':danh_muc',$danh_muc);
                $this->db->execute();
            }
        }


        public function deleteProductById($id){
            $this->db->query('DELETE FROM san_pham WHERE ma_sp = :ma_sp');
            $this->db->bind(':ma_sp',$id);
            return $this->db->execute();
        }


        public function updateProduct($ma_sp, $ten_sp, $anh_sp,$don_gia_nhap, $don_gia_ban, $so_luong, $mo_ta, $ma_danh_muc){
            $query = 'UPDATE san_pham SET ten_sp = :ten_sp, 
                    don_gia_nhap = :don_gia_nhap, 
                    don_gia_ban= :don_gia_ban, 
                    so_luong = :so_luong , 
                    mo_ta = :mo_ta
                    ';
            $where = ' WHERE ma_sp = :ma_sp';

            if($anh_sp){
                $query .= ',anh_sp = :anh_sp';
            }

            $query = $query. $where;

            $this->db->query($query);

            $this->db->bind(':ma_sp',$ma_sp);
            $this->db->bind(':ten_sp',$ten_sp);
            $this->db->bind(':don_gia_nhap',$don_gia_nhap);
            $this->db->bind(':don_gia_ban',$don_gia_ban);
            if($anh_sp) {
                $this->db->bind(':anh_sp', $anh_sp);
            }
            $this->db->bind(':so_luong',$so_luong);
            $this->db->bind(':mo_ta',$mo_ta);
            $this->db->execute();

            if($ma_danh_muc){
                $this->deleteSpDmLink($ma_sp);
                $this->addSpDmLink($ma_sp, $ma_danh_muc);
            }
        }


        public function deleteSpDmLink($ma_sp)
        {
            $this->db->query('DELETE FROM dm_sp_link WHERE ma_sp = :ma_sp');
            $this->db->bind(':ma_sp',$ma_sp);
            return $this->db->execute();
        }

    }