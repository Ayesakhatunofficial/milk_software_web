<?php

namespace App\Models;

use CodeIgniter\Model;

class ShiftModel extends Model
{
    public function addData($data){
        return $this->db
            ->table('tbl_shift')
            ->insert($data);
    }
    public function getData()
    {
        $sql = "SELECT * FROM tbl_shift";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function getDataBYId($id)
    {
        return $this->db
            ->table('tbl_shift')
            ->where('id', $id)
            ->get()
            ->getRow();
    }

    public function updateData($id, $data)
    {
        return $this->db
            ->table('tbl_shift')
            ->where('id', $id)
            ->set($data)
            ->update();
    }

    public function deleteData($id)
    {
        return $this->db
            ->table('tbl_shift')
            ->where('id', $id)
            ->delete();
    }


}