<?php 

    class Category extends Model{
        private $db;

        public function __construct(){
            $this->db = Database::getInstance();
        }

        public function getAllCat(){
            $this->db->query("SELECT * from danh_muc");
            $catergory = $this->db->resultSet();
           if($catergory){
               return $catergory;
           }else {
               return false;
           }
        }

        public function getCategoryById($id){
            $this->db->query("SELECT dm.* FROM danh_muc dm
            WHERE ma_danh_muc=:ma_dm");
            $this->db->bind(':ma_dm',$id);
            $catergory = $this->db->single();
            if($catergory){
                return $catergory;
            }else {
                return false;
            }
        }

        public function addNewCategory($ma_dm, $ten_dm, $mo_ta){
            $query = 'INSERT INTO danh_muc (ma_danh_muc, ten_danh_muc,mo_ta)
                        VALUES (:ma_danh_muc, :ten_danh_muc, :mo_ta)';
            $this->db->query($query);
            $this->db->bind(':ma_danh_muc',$ma_dm);
            $this->db->bind(':ten_danh_muc',$ten_dm);
            $this->db->bind(':mo_ta',$mo_ta);
            $this->db->execute();
        }

        public function deleteCategory($id)
        {
            $this->db->query("DELETE FROM danh_muc WHERE ma_danh_muc = :ma_danh_muc");
            $this->db->bind(':ma_danh_muc', $id);
            $this->db->execute();
        }

        public function updateCategory($ma_dm, $ten_dm, $mo_ta){
            $query = 'UPDATE danh_muc SET ten_danh_muc = :ten_danh_muc,  
                    mo_ta = :mo_ta
                    ';
            $where = ' WHERE ma_danh_muc = :ma_danh_muc';

            $query = $query. $where;

            $this->db->query($query);

            $this->db->bind(':ma_danh_muc',$ma_dm);
            $this->db->bind(':ten_danh_muc',$ten_dm);
            $this->db->bind(':mo_ta',$mo_ta);
            $this->db->execute();


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



        public function getProductCats($ma_sp)
        {
            $this->db->query("SELECT ma_danh_muc FROM dm_sp_link WHERE ma_sp = :ma");
            $this->db->bind(":ma",$ma_sp);
            return $this->db->fetchColumn();
        }

    }