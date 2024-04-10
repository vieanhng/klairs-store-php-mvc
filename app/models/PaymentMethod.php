<?php

class PaymentMethod extends Model
{
    public function getPaymentMethods(){
        $this->db->query('SELECT * FROM phuong_thuc_thanh_toan');
        $payments = $this->db->resultSet();
        if($payments){
            return $payments;
        }else {
            return false;
        }
    }

    public function getPaymentById($ma){
        $this->db->query('SELECT * FROM phuong_thuc_thanh_toan WHERE ma_pttt = :ma_pttt');
        $this->db->bind(':ma_pttt',$ma);
        $payments = $this->db->single();
        if($payments){
            return $payments;
        }else {
            return false;
        }
    }
}