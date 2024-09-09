<?php

namespace App\Models;

use CodeIgniter\Model;

class BankModel extends Model
{
    public function getFarmerData()
    {
        $sql = "SELECT * FROM tbl_user WHERE user_status = 'active' AND user_role = 'farmer'";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function StatusInactive($data)
    {
        $farmer_id = $data['farmer_id'];
        $this->db->table('tbl_farmer_bank_details')
            ->set('status', 'inactive')
            ->where('farmer_id', $farmer_id)
            ->update();
    }

    public function addData($data)
    {
        return $this->db
            ->table('tbl_farmer_bank_details')
            ->insert($data);
    }

    public function getData()
    {
        $sql = "SELECT tbl_user.id AS user_id, tbl_user.user_name, tbl_farmer_bank_details.*
        FROM tbl_farmer_bank_details
        JOIN tbl_user ON tbl_farmer_bank_details.farmer_id = tbl_user.id
        WHERE tbl_farmer_bank_details.status = 'active'";
        return $this->db->query($sql)->getResult();
    }

    public function getDataBYId($id)
    {
        return $this->db
            ->table('tbl_farmer_bank_details')
            ->where('id', $id)
            ->get()
            ->getRow();
    }

    public function updateData($id, $data)
    {
        return $this->db
            ->table('tbl_farmer_bank_details')
            ->where('id', $id)
            ->set($data)
            ->update();
    }

    public function deleteData($id)
    {
        return $this->db
            ->table('tbl_farmer_bank_details')
            ->where('id', $id)
            ->set('status', 'inactive')
            ->update();
    }
}
