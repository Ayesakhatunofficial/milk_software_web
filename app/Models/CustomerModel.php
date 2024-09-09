<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    public function getLastId()
    {
        $sql = "SELECT COUNT(id) AS total_customer FROM tbl_user WHERE user_role = 'customer'";
        $query = $this->db->query($sql);
        return $query->getRow();
    }
    public function addData($data)
    {
        return $this->db
            ->table('tbl_user')
            ->insert($data);
    }

    public function getData()
    {
        $sql = "SELECT * FROM tbl_user WHERE user_status = 'active' AND user_role= 'customer'";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function getDataBYId($id)
    {
        return $this->db
            ->table('tbl_user')
            ->where('id', $id)
            ->get()
            ->getRow();
    }

    public function updateData($id, $data)
    {
        return $this->db
            ->table('tbl_user')
            ->where('id', $id)
            ->set($data)
            ->update();
    }

    public function deleteData($id)
    {
        return $this->db
            ->table('tbl_user')
            ->where('id', $id)
            ->set('user_status', 'inactive')
            ->update();
    }
}