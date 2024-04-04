<?php 

    class User {

        private $db;

        public function __construct(){
            $this->db = Database::getInstance();
        }

        public function register($name,$email,$phone, $hashedPassword){
           
            $this->db->query(
                    "INSERT INTO khach_hang (ten_kh,email,dien_thoai,password)
                    VALUES (:ten_kh,:email,:dien_thoai,:password)
                    ");

            $this->db->bind(':ten_kh',$name);
            $this->db->bind(':email',$email);
            $this->db->bind(':dien_thoai',$phone);
            $this->db->bind(':password',$hashedPassword);
            $this->db->execute();
        }

        public function login($email,$password){
            $this->db->query("SELECT * FROM khach_hang WHERE email =:email");
            $this->db->bind(':email',$email);
            $user = $this->db->single();
            
            $hashedPassword = $user->password;
            if(password_verify($password,$hashedPassword)){
                return $user;
            }else{
                return false;
            }
        }

        public function show($id){
            $this->db->query("SELECT * FROM users WHERE user_id=:user_id");
            $this->db->bind(':user_id',$id);
            $user = $this->db->single();
            return $user;
        }

        public function update($id,$name,$email,$phone){
            $this->db->query("UPDATE khach_hang SET ten_kh=:full_name,dien_thoai=:phone
            ,email=:email WHERE ma_kh=:user_id");
            $this->db->bind(':full_name',$name);
            $this->db->bind(':email',$email);
            $this->db->bind(':phone',$phone);
            $this->db->bind(':user_id',$id);
            $this->db->execute();
        }

        public function updatePassword($id,$password){
            $this->db->query("UPDATE khach_hang SET password=:password WHERE ma_kh=:user_id");
            $this->db->bind(':password',$password);
            $this->db->bind(':user_id',$id);
            $this->db->execute();
        }

        public function findUserByEmail($email){
            $this->db->query("SELECT * FROM khach_hang WHERE 
            email =:email");
            $this->db->bind(':email',$email);
            $this->db->execute();
            if($this->db->rowCount() > 0){
                return true;
            }else{
                return false;
            };
        }


        public function userData($user_id){
            $this->db->query("SELECT * FROM khach_hang WHERE ma_kh=:ma_kh");
            $this->db->bind(':ma_kh',$user_id);
            $user = $this->db->single();
            if($user){
                return $user;
            }else{
                return false;
            }
        }
    }