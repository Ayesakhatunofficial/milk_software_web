<?php

namespace App\Models;

use CodeIgniter\Model;

class AdvanceModel extends Model
{
    public function search($userCode){
        $sql = "SELECT id, user_name, user_mobile FROM tbl_user WHERE user_code = '$userCode' AND user_status = 'active'"; 
        $query = $this->db->query($sql);
        return $query->getRow();
    }
    
    public function getLastId()
    {
        $sql = "SELECT COUNT(id) AS total_adv FROM tbl_advance";
        $query = $this->db->query($sql);
        return $query->getRow();
    }

    public function getLastTransId()
    {
        $sql = "SELECT COUNT(id) AS total_id FROM tbl_transaction";
        $query = $this->db->query($sql);
        return $query->getRow();
    }

    public function getPrevAmount($refrence_code)
    {
        $sql = "SELECT amount FROM tbl_transaction WHERE ref_id = '$refrence_code' ORDER BY id DESC LIMIT 1";
        $query = $this->db->query($sql);
         $result = $query->getRow();

        if ($result) {
            return $result->amount;
        }
    }

    public function addData($data){
        return $this->db
            ->table('tbl_advance')
            ->insert($data);
    }

    public function addTransData($trans_data){
        return $this->db
            ->table('tbl_transaction')
            ->insert($trans_data);
    }
    
    public function getData()
    {
        $sql = "SELECT
                    tbl_user.id AS user_id,
                    tbl_user.user_name,
                    (
                        SELECT EXISTS(
                            SELECT *
                            FROM tbl_advance_payment 
                            WHERE ref_id = tbl_advance.ref_code
                        )
                    ) as is_exists,
                    tbl_advance.*
                FROM
                    tbl_advance
                JOIN tbl_user ON tbl_advance.farmer_id = tbl_user.id";
        return $this->db->query($sql)->getResult();
    }

    public function getDataById($id)
    {
        $sql = "SELECT tbl_user.id AS user_id, tbl_user.user_name, tbl_advance.*
        FROM tbl_advance
        JOIN tbl_user ON tbl_advance.farmer_id = tbl_user.id
        WHERE tbl_advance.id = $id";
        return $this->db->query($sql)->getRow();
    }

    public function updateData($id, $data)
    {
        return $this->db
            ->table('tbl_advance')
            ->where('id', $id)
            ->set($data)
            ->update();
    }

    public function deleteData($id)
    {
        return $this->db
            ->table('tbl_advance')
            ->where('id', $id)
            ->delete();
    }

    public function getCollectData($ref_code){
        return $this->db
            ->table('tbl_advance_payment')
            ->where('ref_id',$ref_code)
            ->get()
            ->getResult();
    }

    public function addPaymentData($data){
        return $this->db
            ->table('tbl_advance_payment')
            ->insert($data);
    }

    public function getAmountByRefCode($ref_id){
        return $this->db
            ->table('tbl_advance')
            ->select('amount')
            ->where('ref_code', $ref_id)
            ->get()
            ->getRow()->amount;
    }

    public function getPaymentAmount($ref_id){
        $sql = "SELECT SUM(amount) AS total_amount FROM tbl_advance_payment WHERE ref_id = '$ref_id' ";
        $query = $this->db->query($sql);
        return $query->getRow();
    }

    public function updateAmount($ref_id, $data_1){
        return $this->db
            ->table('tbl_advance')
            ->where('ref_code', $ref_id)
            ->set($data_1)
            ->update();
    }

    
}