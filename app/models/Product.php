<?php 

    class Product extends Controller{
        private $db;

        public function __construct(){
            $this->db = Database::getInstance();
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


        public function search($searched){
            $this->db->query("SELECT products.*, users.full_name as creator,
            categories.cat_name,manufactures.man_name  FROM products
            INNER JOIN users ON products.user = users.user_id
            INNER JOIN categories ON products.cat = categories.cat_id
            INNER JOIN manufactures ON products.man = manufactures.man_id
            WHERE name LIKE '%$searched%'");
            // $this->db->bind(':searched',$searched);
            $results = $this->db->resultSet();
            if($results){
                return $results;
            }else {
                return false;
            }
        }

        public function getProByCat($catedgory){
            $this->db->query("SELECT products.*, users.full_name as creator,
            categories.cat_name,manufactures.man_name  FROM products
            INNER JOIN users ON products.user = users.user_id
            INNER JOIN categories ON products.cat = categories.cat_id
            INNER JOIN manufactures ON products.man = manufactures.man_id
            WHERE cat=:cat AND products.active=1
            ");
            $this->db->bind(':cat',$catedgory);
            $products = $this->db->resultSet();
           if($products){
               return $products;
           }else {
               return false;
           }
        }


        public function getProByMan($man){
            $this->db->query("SELECT products.*, users.full_name as creator,
            categories.cat_name,manufactures.man_name  FROM products
            INNER JOIN users ON products.user = users.user_id
            INNER JOIN categories ON products.cat = categories.cat_id
            INNER JOIN manufactures ON products.man = manufactures.man_id
            WHERE man=:man AND products.active=1
            ");
            $this->db->bind(':man',$man);
            $products = $this->db->resultSet();
           if($products){
               return $products;
           }else {
               return false;
           }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->     add    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function add(
            $name,$desc,$user,$cat,$man,$image,$price,$size,$color
            ){
            $this->db->query(
                "INSERT INTO products 
                (name,description,user,cat,man,active
                ,image
                ,price,size,color)
            VALUES 
            (:name,:description,:user,:cat,:man,0,
            :image,
            :price,:size,:color)
            ");
            $this->db->bind(':name',$name);
            $this->db->bind(':description',$desc);
            $this->db->bind(':user',$user);
            $this->db->bind(':cat',$cat);
            $this->db->bind(':man',$man);
            $this->db->bind(':image',$image);
            $this->db->bind(':price',$price);
            $this->db->bind(':size',$size);
            $this->db->bind(':color',$color);
            $this->db->execute();
        }

         /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   update   <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function update(
            $id,$name,$desc,$user,$img,$cat,$man,$price,$size,$color
            ){
            $this->db->query("UPDATE products SET 
            name=:name,description=:description,user=:user,cat=:cat,
            man=:man,price=:price,size=:size,color=:color,image=:image
            WHERE product_id=:product_id
            ");
            $this->db->bind(':product_id',$id);
            $this->db->bind(':name',$name);
            $this->db->bind(':description',$desc);
            $this->db->bind(':user',$user);
            $this->db->bind(':cat',$cat);
            $this->db->bind(':man',$man);
            $this->db->bind(':image',$img);
            $this->db->bind(':price',$price);
            $this->db->bind(':size',$size);
            $this->db->bind(':color',$color);
            $this->db->execute();
        }

        public function show($id){
            $this->db->query("SELECT products.*, users.full_name as creator,
            categories.cat_name as cat_name,manufactures.man_name 
            as man_name FROM products 
            INNER JOIN users ON products.user = users.user_id
            INNER JOIN categories ON products.cat = categories.cat_id
            INNER JOIN manufactures ON products.man = manufactures.man_id
            WHERE product_id=:product_id");
            $this->db->bind(':product_id',$id);
            $product = $this->db->single();
            return $product;
        }

        

        public function findProName($name,$id = ''){
            $this->db->query("SELECT product_id FROM products 
            WHERE name =:name AND product_id != :product_id");
            $this->db->bind(':name',$name);
            $this->db->bind(':product_id',$id);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function delete($id){
            $this->db->query("DELETE FROM products WHERE product_id=:id");
            $this->db->bind(':id',$id);
            return $this->db->execute();
        }

        public function activate($id){
            $this->db->query("UPDATE products SET active  = 1 WHERE product_id=:id");
            $this->db->bind(':id',$id);
            return $this->db->execute();
        }

        public function inActivate($id){
            $this->db->query("UPDATE products SET active  = 0 WHERE product_id=:id");
            $this->db->bind(':id',$id);
            return $this->db->execute();
        }

        public function addGallary($id,$img){
            $this->db->query("INSERT INTO gallary(image_name,product_id)
            VALUES(:image_name,:product_id)");
            $this->db->bind(':product_id',$id);
            $this->db->bind(':image_name',$img);
            return $this->db->execute();
        }

        public function getGallary($id){
            $this->db->query("SELECT * FROM gallary WHERE 
            product_id=:product_id ");
            $this->db->bind(':product_id',$id);
            return $this->db->resultSet();
        }

        public function deleteGallaryImage($id){
            $this->db->query("DELETE FROM gallary WHERE image_id=:image_id");
            $this->db->bind(':image_id',$id);
            return $this->db->execute();
        }

        public function deleteGallary($id){
            $this->db->query("DELETE FROM gallary WHERE product_id=:product_id");
            $this->db->bind(':product_id',$id);
            return $this->db->execute();
        }

        public function updateQty($productId, $qty){
            $this->db->query('UPDATE san_pham SET so_luong  = so_luong '.$qty." WHERE ma_sp = :ma_sp");
            $this->db->bind(':ma_sp',$productId);
            return $this->db->execute();
        }

    }