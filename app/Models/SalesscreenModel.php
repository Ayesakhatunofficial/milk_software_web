<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesscreenModel extends Model
{
    public function __construct()
    {
        $db = \Config\Database::connect();
        parent::__construct();
        $this->table = 'tbl_sales_item';
    }

    public function search($userInput){
        $user_code = 'CO0'.$userInput;
        $sql = "SELECT id, user_role, user_name, user_mobile FROM tbl_user WHERE user_code = '$user_code' OR user_mobile = '$userInput' AND user_status = 'active'"; 
        $query = $this->db->query($sql);
        return $query->getRow();
    }

    public function getSaleRate($type)
    {
        $sql = "SELECT rate FROM tbl_sale_rate WHERE type = '$type'";
        $query = $this->db->query($sql);
        //return $query->getRow();
        $result = $query->getRow();

        if ($result) {
            return $result->rate;
        } else {
            return 0;
        }
    }

    public function getProductSaleRate($type)
    {
        $sql = "SELECT rate FROM tbl_items WHERE id = '$type'";
        $query = $this->db->query($sql);
        //return $query->getRow();
        $result = $query->getRow();

        if ($result) {
            return $result->rate;
        } else {
            return 0;
        }
    }

    public function getShift()
    {
        $sql = "SELECT * FROM tbl_shift";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function getProduct(){
        return $this->db
            ->table('tbl_items')
            ->get()
            ->getResult();
    }

    public function getMilkType(){
        $sql = "SELECT id, type FROM tbl_sale_rate";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function getLastId()
    {
        $sql = "SELECT COUNT(id) AS total_id FROM tbl_transaction";
        $query = $this->db->query($sql);
        return $query->getRow();
    }

    public function getCustLastId()
    {
        $sql = "SELECT COUNT(id) AS total_customer FROM tbl_user WHERE user_role = 'customer'";
        $query = $this->db->query($sql);
        return $query->getRow();
    }

    public function getLastFarmerId()
    {
        $sql = "SELECT COUNT(id) AS total_farmer FROM tbl_user WHERE user_role = 'farmer'";
        $query = $this->db->query($sql);
        return $query->getRow();
    }

    public function getPrevAmount($last_insert_id)
    {
        $sql = "SELECT amount FROM tbl_transaction WHERE ref_id = $last_insert_id ORDER BY id DESC LIMIT 1";
        $query = $this->db->query($sql);
        $result = $query->getRow();

        if ($result) {
            return $result->amount;
        }
    }

    public function addData($data)
    {
        $this->db
            ->table('tbl_sales_screen')
            ->insert($data);
        return $this->db->InsertID();
    }

    public function addItemData($data1){
        return $this->db
            ->table('tbl_sales_item')
            ->insert($data1);
    }

    public function addTransData($trans_data)
    {
        return $this->db
            ->table('tbl_transaction')
            ->insert($trans_data);
    }

    public function addCustData($data)
    {
        return $this->db
            ->table('tbl_user')
            ->insert($data);
    }

    public function getData()
    {
        $sql = "SELECT
        tbl_user.id AS user_id,
        tbl_user.user_name,
        tbl_user.user_code,
        tbl_user.user_email,
        tbl_shift.id,
        tbl_shift.shift_name,
        
        tbl_sales_screen.*
     FROM
        tbl_sales_screen
     JOIN tbl_user ON tbl_sales_screen.customer_id = tbl_user.id
     JOIN tbl_shift ON tbl_sales_screen.shift_id = tbl_shift.id";
        return $this->db->query($sql)->getResult();
    }



    public function getDataById($id)
    {
        $sql = "SELECT
        tbl_user.id AS user_id,
        tbl_user.user_name,
        tbl_user.user_mobile,
        tbl_user.user_email,
        tbl_user.user_address,
        tbl_sales_screen.*
     FROM
        tbl_sales_screen
     JOIN tbl_user ON tbl_sales_screen.customer_id = tbl_user.id
     WHERE
        tbl_sales_screen.id = $id";
        return $this->db->query($sql)->getRow();
    }

    public function getItemData($id){
        $sql = "SELECT * FROM tbl_sales_item where ref_id = $id";
        return $this->db->query($sql)->getResult();
    }

    public function getItemDataById($id){
        return $this->db->table('tbl_sales_item')
        ->where('ref_id',$id)
        ->get()
        ->getResult();
    }

    public function getSumAmount($id){
         $sql = "SELECT SUM(amount) AS total_pay_amount FROM tbl_transaction WHERE ref_id = $id";
        $query = $this->db->query($sql);
        return $query->getRow();
    }

    public function getPaidAmount($id){
        $sql = "SELECT paid_amount FROM tbl_sales_screen WHERE id = $id";
        $query = $this->db->query($sql);
        return $query->getRow();
    }

    public function updateData($id, $data)
    {
        return $this->db
            ->table('tbl_sales_screen')
            ->where('id', $id)
            ->set($data)
            ->update();
    }

    public function deleteItem($id_1)
    {
        return $this->db
            ->table('tbl_sales_item')
            ->where('ref_id', $id_1)
            ->delete();
    }

    public function getItemId($id){
        return $this->db
            ->table('tbl_sales_item')
            ->select('id')
            ->where('ref_id',$id)
            ->get()
            ->getResult();
    }

    public function deleteData($id)
    {
        return $this->db
            ->table('tbl_sales_screen')
            ->where('id', $id)
            ->delete();
    }

    public function getSettings(){
        return $this->db
        ->table('tbl_settings')
        ->get()
        ->getRow();
    }
}
