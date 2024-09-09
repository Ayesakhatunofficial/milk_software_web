<?php

namespace App\Models;

use CodeIgniter\Model;

class SalerateModel extends Model
{
    public function addData($data){
        return $this->db
            ->table('tbl_sale_rate')
            ->insert($data);
    }
    public function getData()
    {
        $sql = "SELECT * FROM tbl_sale_rate";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function getDataBYId($id)
    {
        return $this->db
            ->table('tbl_sale_rate')
            ->where('id', $id)
            ->get()
            ->getRow();
    }

    public function updateData($id, $data)
    {
        return $this->db
            ->table('tbl_sale_rate')
            ->where('id', $id)
            ->set($data)
            ->update();
    }

    public function deleteData($id)
    {
        return $this->db
            ->table('tbl_sale_rate')
            ->where('id', $id)
            ->delete();
    }


}