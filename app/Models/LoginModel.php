<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    public function getData($mobile, $password)
    {
        // echo $sql = "SELECT 'id', 'user_name', 'user_email', 'user_mobile', 'user_role', 'user_password' FROM 'tbl_user' WHERE 'user_mobile' = '$mobile' AND 'user_password' = '$password'";
        // die;
        // $sql = "SELECT * FROM `tbl_user` WHERE `user_mobile` = '$mobile' AND user_password = '$password'";die;
        return $this->db->table('tbl_user')
            ->select('id, user_name, user_email, user_mobile, user_role, user_password')
            ->where('user_mobile', $mobile)
            ->where('user_password', $password)
            ->get()
            ->getRow();
        // $query = $this->db->query($sql);
        // ->getRow();return $query
    }
}
