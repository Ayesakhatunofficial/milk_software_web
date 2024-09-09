<?php

namespace App\Models;

use CodeIgniter\Model;

class ExpenseModel extends Model
{
    public function getCatData()
    {
        $sql = "SELECT * FROM tbl_expense_category WHERE is_delete = '1' AND status ='active'";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function addData($data)
    {
        return $this->db
            ->table('tbl_expense')
            ->insert($data);
    }

    public function getData()
    {
        $sql = "SELECT tbl_expense_category.id AS cat_id, tbl_expense_category.name, tbl_expense.*
        FROM tbl_expense 
        JOIN tbl_expense_category ON tbl_expense.category_id = tbl_expense_category.id
        WHERE tbl_expense.status = 'active'";
        return $this->db->query($sql)->getResult();
    }

    public function getDataBYId($id)
    {
        return $this->db
            ->table('tbl_expense')
            ->where('id', $id)
            ->get()
            ->getRow();
    }

    public function updateData($id, $data)
    {
        return $this->db
            ->table('tbl_expense')
            ->where('id', $id)
            ->set($data)
            ->update();
    }

    public function deleteData($id)
    {
        return $this->db
            ->table('tbl_expense')
            ->where('id', $id)
            ->set('status', 'inactive')
            ->update();
    }
}