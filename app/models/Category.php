<?php 

    class Category extends Controller{
        private $db;


        public function __construct(){
            $this->db = Database::getInstance();
        }

        public function getCategoryProductCollection($ma_danh_muc){

            $this->db->query("SELECT san_pham.ma_sp, ten_sp, don_gia_nhap, don_gia_ban, anh_sp, so_luong, san_pham.mo_ta, danh_muc.ma_danh_muc, ten_danh_muc
FROM san_pham
INNER JOIN dm_sp_link ON san_pham.ma_sp = dm_sp_link.ma_sp
INNER JOIN danh_muc ON danh_muc.ma_danh_muc = dm_sp_link.ma_danh_muc
WHERE danh_muc.ma_danh_muc = :ma_danh_muc");
            $this->db->bind(":ma_danh_muc",$ma_danh_muc);
            $categories = $this->db->resultSet();
            if($categories){
                return $categories;
            }else {
                return false;
            }
        }

        public function getCategoryProductIds($ma_danh_muc){

            $this->db->query("SELECT san_pham.ma_sp
FROM san_pham
INNER JOIN dm_sp_link ON san_pham.ma_sp = dm_sp_link.ma_sp
INNER JOIN danh_muc ON danh_muc.ma_danh_muc = dm_sp_link.ma_danh_muc
WHERE danh_muc.ma_danh_muc = :ma_danh_muc");
            $this->db->bind(":ma_danh_muc",$ma_danh_muc);
            $categories = $this->db->fetchColumn();
            if($categories){
                return $categories;
            }else {
                return false;
            }
        }

        public function getCategories(){
            $this->db->query("SELECT * FROM danh_muc");
            $result = $this->db->resultSet();
            return $result;
        }

        public function getCategoryById($ma){
            $this->db->query("SELECT * FROM danh_muc WHERE ma_danh_muc = :ma");
            $this->db->bind(":ma",$ma);
            $result = $this->db->single();
            return $result;
        }

        public function getProductCats($ma_sp)
        {
            $this->db->query("SELECT ma_danh_muc FROM dm_sp_link WHERE ma_sp = :ma");
            $this->db->bind(":ma",$ma_sp);
            return $this->db->fetchColumn();
        }

    }