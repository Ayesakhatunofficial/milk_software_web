<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    public function getTotalFarmer(){
        $sql = "SELECT COUNT(id) AS total_farmer FROM tbl_user WHERE user_status = 'active' AND user_role = 'farmer'";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function getTotalCustomer(){
        $sql = "SELECT COUNT(id) AS total_customer FROM tbl_user WHERE user_status = 'active' AND user_role = 'customer'";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function getTotalCollectionBoy(){
        $sql = "SELECT COUNT(id) AS total_col_boy FROM tbl_user WHERE user_status = 'active' AND user_role = 'col_boy'";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function getTotalSale(){
        $sql = "SELECT SUM(total_amount) as total_price, SUM(paid_amount) as total_paid_amount, SUM(due_amount) as total_due_amount FROM tbl_sales_screen";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function getMilkCollectByDate(){
        $today = date('Y-m-d');
        return $this->db
            ->table('tbl_milk_collection')
            ->selectSum('milk_quantity', 'total_collect_milk')
            ->where('date', $today)
            ->get()
            ->getResult();

    }

    public function getMilkSaleByDate() {
        $today = date('Y-m-d');
        
        $query = "SELECT SUM(TSI.quantity) AS total_sale_quantity
        FROM tbl_sales_item as TSI
        JOIN tbl_sales_screen as TSS ON TSI.ref_id = TSS.id
        WHERE TSS.sale_type = 'milk' AND DATE(TSS.date) = ?"; 
        return $this->db->query($query,[$today])->getResult();
    }
    

    public function getTotalSaleByDate($date){
        $builder = $this->db->table('tbl_sales_screen');
        $builder->select('SUM(total_amount) as total_price, SUM(paid_amount) as total_paid_amount, SUM(due_amount) as total_due_amount');
        $builder->where('date', $date);
    
        $query = $builder->get();
         if($query){
            return $query->getResult();
         }else{
            return 0;
         }
        
    }
}
