<?php

namespace App\Models;

use CodeIgniter\Model;

class RateChartModel extends Model
{
    public function getShift()
    {
        $sql = "SELECT * FROM tbl_shift";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function getMilkType()
    {
        $sql = "SELECT * FROM tbl_sale_rate";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function addData($data_1)
    {
        $this->db
            ->table('tbl_price_config')
            ->insert($data_1);
        return $this->db->InsertID();
    }

    public function addCsvData($data_2)
    {
        return $this->db
            ->table('tbl_price_chart')
            ->insert($data_2);
    }

    public function getConfigData()
    {
        $sql = "SELECT
        tbl_shift.id,
        tbl_shift.shift_name,
        tbl_sale_rate.id,
        tbl_sale_rate.type,
        tbl_price_config.*
     FROM
     tbl_price_config
     JOIN tbl_shift ON tbl_price_config.shift_id = tbl_shift.id
     JOIN tbl_sale_rate ON tbl_price_config.milk_type_id = tbl_sale_rate.id";
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function getshiftData($ref_id){
        $sql = "SELECT
        tbl_shift.id,
        tbl_shift.shift_name,
        tbl_sale_rate.id,
        tbl_sale_rate.type,
        tbl_price_config.*
     FROM
     tbl_price_config
     JOIN tbl_shift ON tbl_price_config.shift_id = tbl_shift.id
     JOIN tbl_sale_rate ON tbl_price_config.milk_type_id = tbl_sale_rate.id
     WHERE tbl_price_config.id = $ref_id";
        $query = $this->db->query($sql);
        return $query->getRow();
    }

    public function getData($ref_id)
    {
            $sql = "SELECT
            tbl_shift.id,
            tbl_shift.shift_name,
            tbl_sale_rate.id,
            tbl_sale_rate.type,
            tbl_price_chart.*
         FROM
         tbl_price_chart
         JOIN tbl_shift ON tbl_price_chart.shift_id = tbl_shift.id
         JOIN tbl_sale_rate ON tbl_price_chart.milk_type_id = tbl_sale_rate.id
         WHERE tbl_price_chart.ref_id = $ref_id";
            $query = $this->db->query($sql);
            return $query->getResult();
    }


    public function getDataBYId($id)
    {
        $sql = "SELECT
        tbl_shift.id,
        tbl_shift.shift_name,
        tbl_sale_rate.id,
        tbl_sale_rate.type,
        tbl_price_chart.*
     FROM
     tbl_price_chart
     JOIN tbl_shift ON tbl_price_chart.shift_id = tbl_shift.id
     JOIN tbl_sale_rate ON tbl_price_chart.milk_type_id = tbl_sale_rate.id
     WHERE tbl_price_chart.id = $id";
        $query = $this->db->query($sql);
        return $query->getRow();
    }

    // public function updateConfigData($ref_id, $data_1)
    // {
    //     return $this->db
    //         ->table('tbl_price_config')
    //         ->where('id', $ref_id)
    //         ->set($data_1)
    //         ->update();
    // }

    public function updateData($id, $data_2)
    {
        return $this->db
            ->table('tbl_price_chart')
            ->where('id', $id)
            ->set($data_2)
            ->update();
    }

    public function deleteData($id)
    {
        return $this->db
            ->table('tbl_price_config')
            ->where('id', $id)
            ->delete();
    }

    public function deleteChartData($id)
    {
        return $this->db
            ->table('tbl_price_chart')
            ->where('ref_id', $id)
            ->delete();
    }
}
