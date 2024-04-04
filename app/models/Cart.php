<?php 

    class Cart extends Model {

        private $db;
        /**
         * @var Product
         */
        private Product $productModel;

        /**
         * @var mixed
         */

        public function __construct(){
            $this->db = Database::getInstance();
            $this->productModel = $this->loadModel('Product');
        }

        public function getCartItems($cartId){
            $this->db->query("select sp.ma_sp,sp.anh_sp as image,ten_sp, ct_gio_hang.so_luong,ct_gio_hang.don_gia_ban,tong_tien 
from ct_gio_hang 
    inner join san_pham sp on sp.ma_sp = ct_gio_hang.ma_sp 
where ma_gio_hang=:cartId");
            $this->db->bind(':cartId', $cartId);
            $carts = $this->db->resultSet();
            return $carts;
        }

        public function getCurrentCarts(){
            $userId = Auth::getCurrentCustomerId();
            $this->db->query("select * from gio_hang where ma_kh = :user_id");
            $this->db->bind(':user_id', $userId);
            $cart = $this->db->single();
            if($cart){
                $cartDetail = $this->getCartItems($cart->ma_gio_hang);
                return [
                    'cart'=>$cart,
                    'detail'=>$cartDetail
                    ];
            }else{
                $this->db->query("INSERT INTO gio_hang (ma_kh,thanh_tien) VALUES (:ma_kh,:tong_tien)");
                $this->db->bind(':ma_kh',$userId);
                $this->db->bind(':tong_tien',0);
                $this->db->execute();
                return $this->getCurrentCarts();
            }
        }

        public function addToCart($productId,$qty){
            $currentCart = $this->getCurrentCarts();
            $maGioHang = $currentCart['cart']->ma_gio_hang;
            $sp = $this->productModel->getProductById($productId);
            $available = $sp->so_luong;
            $donGia = $sp->don_gia_ban;
            $tongTien = $qty * $donGia;
            foreach ($currentCart['detail'] as $item) {
                if ($item->ma_sp == $productId) {

                    if($available > $item->so_luong + $qty){
                        $this->updateQty($maGioHang,$productId,$item->so_luong + $qty);
                    } else{
                        return false;
                    }
                }else {
                    if($available > $qty){
                        $this->addNewItem($maGioHang,$productId,$qty,$donGia,$tongTien);
                    }else{
                        return false;
                    }
                }
            }
            return true;
        }

        private function addNewItem($maGioHang,$productId,$qty,$donGia,$tongTien){
            $this->db->query('INSERT INTO 
            ct_gio_hang (ma_gio_hang,ma_sp,so_luong,don_gia_ban,tong_tien)
            VALUES (:ma_gio_hang,:ma_sp,:so_luong,:don_gia_ban,:tong_tien)');
            $this->db->bind(':ma_gio_hang', $maGioHang);
            $this->db->bind(':ma_sp', $productId);
            $this->db->bind(':so_luong', $qty);
            $this->db->bind(':don_gia_ban', $donGia);
            $this->db->bind(':tong_tien', $tongTien);
            $this->db->execute();
            return true;
        }

        public function updateQty($cartId, $productId, $qty) {

            $this->db->query("UPDATE ct_gio_hang cg
                      SET cg.so_luong = :qty,
                          cg.tong_tien = ".$qty." * cg.don_gia_ban ".
                      "WHERE cg.ma_gio_hang = :cart_id
                      AND cg.ma_sp = :product_id");
            $this->db->bind(':qty', $qty);
            $this->db->bind(':cart_id', $cartId);
            $this->db->bind(':product_id', $productId);
            $this->db->execute();
        }

        public function getItemCart($cartId,$productId){
            $userId = Auth::getCurrentCustomerId();
            $this->db->query("select * from gio_hang where ma_kh = :user_id");
            $this->db->bind(':user_id', $userId);
            $cart = $this->db->single();
            if($cart){
                $cartDetail = $this->getCartItems($cart->ma_gio_hang);
                return [
                    'cart'=>$cart,
                    'detail'=>$cartDetail
                ];
            }else{
                return false;
            }
        }

        public function collectCartTotal($maGiohang){
            $this->db->query("UPDATE gio_hang gh
                JOIN (
                    SELECT ma_gio_hang, 
                           SUM(tong_tien) AS total_tong_tien
                    FROM ct_gio_hang
                    WHERE ma_gio_hang = $maGiohang 
                    GROUP BY ma_gio_hang
                ) t ON gh.ma_gio_hang = t.ma_gio_hang
                SET gh.thanh_tien = t.total_tong_tien
                WHERE gh.ma_gio_hang = $maGiohang");
            $this->db->execute();
        }

        public function addOne($pro_id){
            $this->db->query("UPDATE cart SET qty=qty + 1
            WHERE product = :pro_id AND user = :user");
            $this->db->bind(':pro_id',$pro_id);
            $this->db->bind(':user',Session::name('user_id'));
            $this->db->execute();
        }

        public function addnew($pro_id,$user_id,$price){
            $this->db->query("INSERT INTO 
            cart (product,user,qty,price)
            VALUES (:product,:user_id,1,:price)");
            $this->db->bind(':product',$pro_id);
            $this->db->bind(':user_id',$user_id);
            $this->db->bind(':price',$price);
            $this->db->execute();
        }





        public function findCartByUser($user_id){
            $this->db->query("SELECT  FROM cart 
            WHERE product =:product_id AND user=:user");
            $this->db->bind(':user',$user_id);
            $this->db->bind(':product_id',$pro_id);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function delete($id){
            $this->db->query("DELETE FROM cart WHERE cart_id=:id");
            $this->db->bind(':id',$id);
            return $this->db->execute();
        }

        public function clear(){
            $this->db->query("DELETE FROM cart WHERE user=:user");
            $this->db->bind(':user',Session::name('user_id'));
            return $this->db->execute();
        }

    }