<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    public function updateData($data){
        return $this->db
            ->table('tbl_settings')
            ->set($data)
            ->update();
    }

    public function getData(){
        $sql = "SELECT * FROM tbl_settings";
        $query = $this->db->query($sql);
        return $query->getRow();
    }
}