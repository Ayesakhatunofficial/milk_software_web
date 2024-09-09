<?php

namespace App\Models;

use CodeIgniter\Model;

class CollectionModel extends Model
{
    public function getBranchData()
    {
        $sql = "SELECT * FROM tbl_dairy WHERE status= 'active'";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function getLastId()
    {
        $sql = "SELECT COUNT(id) AS total_col_boy FROM tbl_user WHERE user_role = 'col_boy'";
        $query = $this->db->query($sql);
        return $query->getRow();
    }
    public function addData($data)
    {
        $this->db
            ->table('tbl_user')
            ->insert($data);

        return $this->db->InsertID();
    }
    public function addBranchData($branch_data)
    {
        return $this->db
            ->table('tbl_collection_boy_assigned_branch')
            ->insert($branch_data);
    }

    public function getData()
    {
        //$sql = "SELECT * FROM tbl_user WHERE user_status = 'active' AND user_role= 'col_boy'";
        $sql = "SELECT
        tbl_dairy.id,
        tbl_dairy.dairy_name,
        tbl_collection_boy_assigned_branch.branch_id,
        tbl_collection_boy_assigned_branch.id,
        tbl_user.*
     FROM
        tbl_user
     JOIN tbl_collection_boy_assigned_branch ON tbl_user.id = tbl_collection_boy_assigned_branch.user_id
     JOIN tbl_dairy ON tbl_collection_boy_assigned_branch.branch_id = tbl_dairy.id
     WHERE tbl_user.user_status = 'active' AND user_role = 'col_boy'";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function getDataBYId($id)
    {
        $sql = "SELECT col.branch_id, us.* FROM tbl_user as us, `tbl_collection_boy_assigned_branch` as col WHERE col.user_id = us.id AND us.id = $id";
        $query = $this->db->query($sql);
        return $query->getRow();
    }

    public function updateData($id, $data)
    {
        return $this->db
            ->table('tbl_user')
            ->where('id', $id)
            ->set($data)
            ->update();
    }

    public function updateBranchData($id, $branch_data)
    {
        return $this->db
            ->table('tbl_collection_boy_assigned_branch')
            ->where('user_id', $id)
            ->set($branch_data)
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
    public function deleteBranchData($id)
    {
        return $this->db
            ->table('tbl_collection_boy_assigned_branch')
            ->where('user_id', $id)
            ->set('status', 'inactive')
            ->update();
    }
}
