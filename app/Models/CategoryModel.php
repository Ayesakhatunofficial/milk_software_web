<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    public function addData($data)
    {
        return $this->db
            ->table('tbl_expense_category')
            ->insert($data);
    }
    public function getData()
    {
        $sql = "SELECT * FROM tbl_expense_category WHERE is_delete = 1";
        $query = $this->db->query($sql);
        return $query->getResult();
    }
    public function getDataBYId($id)
    {
        return $this->db
            ->table('tbl_expense_category')
            ->where('id', $id)
            ->get()
            ->getRow();
    }

    public function updateData($id, $data)
    {
        return $this->db
            ->table('tbl_expense_category')
            ->where('id', $id)
            ->set($data)
            ->update();
    }

    public function deleteData($id)
    {
        return $this->db
            ->table('tbl_expense_category')
            ->where('id', $id)
            ->set('is_delete', '0')
            ->update();
    }
}