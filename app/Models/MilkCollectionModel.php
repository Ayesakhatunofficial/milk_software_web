<?php

namespace App\Models;

use CodeIgniter\Model;

class MilkCollectionModel extends Model
{
    public function search($userCode)
    {
        $code = 'F0' . $userCode;
        $sql = "SELECT id, user_name, user_mobile FROM tbl_user WHERE user_code = '$code' AND user_status = 'active'";
        $query = $this->db->query($sql);
        return $query->getRow();
    }

    public function getShift()
    {
        $sql = "SELECT * FROM tbl_shift";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function getFat()
    {
        $sql = "SELECT * FROM tbl_price_chart GROUP BY fat";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function getCnf()
    {
        $sql = "SELECT * FROM tbl_price_chart GROUP BY cnf";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function getMilkType()
    {
        $sql = "SELECT * FROM tbl_sale_rate";
        $query = $this->db->query($sql);
        return $query->getResult();
    }


    public function getFatById($fat_id){
        $sql ="SELECT fat from tbl_price_chart where id = $fat_id";
        $query = $this->db->query($sql);
        $result = $query->getRow();

        if ($result) {
            return $result->fat;
        } else {
            return 0; 
        }
    }

    public function getCnfById($cnf_id){
        $sql ="SELECT cnf from tbl_price_chart where id = $cnf_id";
        $query = $this->db->query($sql);
        $result = $query->getRow();

        if ($result) {
            return $result->cnf;
        } else {
            return 0; 
        }
    }

    public function getCollectRate($fat, $cnf, $shift, $type)
    {
         $sql = "SELECT price FROM tbl_price_chart WHERE fat = $fat AND cnf = $cnf AND shift_id = $shift AND milk_type_id = $type";
        $query = $this->db->query($sql);
        //return $query->getRow();
        $result = $query->getRow();

        if ($result) {
            return $result->price;
        } else {
            return 0; 
        }
    } 



    public function addData($data)
    {
        return $this->db
            ->table('tbl_milk_collection')
            ->insert($data);
    }

    // public function getColBoyData($user_id)
    // {
    //     $sql = "SELECT id, user_name FROM tbl_user WHERE id = $user_id";
    //     return $this->db->query($sql)->getResult();
    // }

    public function getData($user_id)
    {
        $sql = "SELECT
        tbl_shift.id AS shift_id,
        tbl_shift.shift_name,
        tbl_sale_rate.id,
        tbl_sale_rate.type,
        fat_table.fat,
        cnf_table.cnf,
        farmer_table.id AS farmer_id,
        farmer_table.user_code AS farmer_code,
        farmer_table.user_name AS farmer_name,
        col_table.id AS col_id,
        col_table.user_name AS col_name,
        tbl_milk_collection.*
     FROM
        tbl_milk_collection
     JOIN tbl_shift ON tbl_milk_collection.shift_id = tbl_shift.id
     JOIN tbl_sale_rate ON tbl_milk_collection.milk_type = tbl_sale_rate.id
     JOIN tbl_price_chart AS fat_table ON tbl_milk_collection.fat_id = fat_table.id
     JOIN tbl_price_chart AS cnf_table ON tbl_milk_collection.cnf_id = cnf_table.id
     JOIN tbl_user AS farmer_table ON tbl_milk_collection.farmer_id = farmer_table.id
     JOIN tbl_user AS col_table ON tbl_milk_collection.col_boy_id = col_table.id
     WHERE tbl_milk_collection.collected_by = $user_id";
        return $this->db->query($sql)->getResult();
    }

    public function getDataById($id)
    {
        $sql = "SELECT tbl_user.id AS user_id, tbl_user.user_name, tbl_milk_collection.*
        FROM tbl_milk_collection
        JOIN tbl_user ON tbl_milk_collection.farmer_id = tbl_user.id
        WHERE tbl_milk_collection.id = $id";
        return $this->db->query($sql)->getRow();
    }

    public function updateData($id, $data)
    {
        return $this->db
            ->table('tbl_milk_collection')
            ->where('id', $id)
            ->set($data)
            ->update();
    }

    public function deleteData($id)
    {
        return $this->db
            ->table('tbl_milk_collection')
            ->where('id', $id)
            ->delete();
    }
}
