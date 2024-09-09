<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    public function getCustData()
    {
        $sql = "SELECT
        tbl_user.user_code,
        tbl_user.user_name,
        tbl_user.user_mobile,
        tbl_sales_screen.customer_id,
        SUM(tbl_sales_screen.total_amount) AS t_amount,
        SUM(tbl_sales_screen.paid_amount) AS p_amount,
        SUM(tbl_sales_screen.due_amount) AS d_amount,
        SUM(tbl_sales_item.quantity) AS total_qty,
        tbl_sales_screen.*
     FROM
        tbl_sales_screen
     JOIN tbl_user ON tbl_sales_screen.customer_id = tbl_user.id
     Join tbl_sales_item on tbl_sales_screen.id = tbl_sales_item.ref_id
     GROUP BY
        customer_id";
        return $this->db->query($sql)->getResult();
    }

    public function getCustDataById($customer_id)
    {
        $sql = "SELECT
        tbl_user.user_code,
        tbl_user.user_name,
        tbl_user.user_mobile,
        SUM(tbl_sales_screen.due_amount) AS t_amount,
        tbl_sales_screen.*
     FROM
        tbl_sales_screen
     JOIN tbl_user ON tbl_sales_screen.customer_id = tbl_user.id
        WHERE tbl_sales_screen.customer_id = $customer_id";
        return $this->db->query($sql)->getRow();
    }

    public function getInvoice($customer_id)
    {
        $sql = "SELECT * FROM tbl_sales_screen WHERE customer_id = $customer_id AND due_amount > 0";
        return $this->db->query($sql)->getResult();
    }

    public function getAmount($value)
    {
        return $this->db
            ->table('tbl_sales_screen')
            ->select('due_amount, paid_amount')
            ->where('id', $value)
            ->get()
            ->getRow();
    }

    public function updateSalesData($value, $due_amount, $paid_amount, $status)
    {
        return $this->db
            ->table('tbl_sales_screen')
            ->set('due_amount', $due_amount)
            ->set('paid_amount', $paid_amount)
            ->set('status',$status)
            ->where('id', $value)
            ->update();
    }

    public function addCustPayData($data)
    {
        $this->db
            ->table('tbl_customer_payment')
            ->insert($data);
        return $this->db->InsertID();
    }


    public function getPrevAmount($last_insert_id)
    {
        $sql = "SELECT amount FROM tbl_transaction WHERE ref_id = $last_insert_id ORDER BY id DESC LIMIT 1";
        $query = $this->db->query($sql);
        $result = $query->getRow();

        if ($result) {
            return $result->amount;
        }
    }

    public function getLastId()
    {
        $sql = "SELECT COUNT(id) AS total_id FROM tbl_transaction";
        $query = $this->db->query($sql);
        return $query->getRow();
    }

    public function addTransData($trans_data)
    {
        return $this->db
            ->table('tbl_transaction')
            ->insert($trans_data);
    }

    public function getCustCollectData($customer_id)
    {
        $sql = "SELECT tbl_user.user_name, tbl_user.user_code, tbl_user.user_mobile, tbl_customer_payment.*
        FROM tbl_customer_payment 
        JOIN tbl_user ON tbl_customer_payment.customer_id = tbl_user.id
        WHERE tbl_customer_payment.customer_id = $customer_id";
        return $this->db->query($sql)->getResult();
    }

    public function getInvoiceId($cust_id)
    {
        $sql = "SELECT id FROM tbl_sales_screen WHERE customer_id = $cust_id";
        return $this->db->query($sql)->getResultArray();
    }


    public function getFarmerData()
    {
        $sql = "SELECT
        tbl_user.user_code,
        tbl_user.user_name,
        SUM(tbl_milk_collection.price) AS t_amount,
        SUM(tbl_milk_collection.due_amount) AS d_amount,
        SUM(tbl_milk_collection.milk_quantity) AS total_qty,
        tbl_milk_collection.*
     FROM
       tbl_milk_collection
     JOIN tbl_user ON tbl_milk_collection.farmer_id = tbl_user.id
     GROUP BY
        farmer_id";
        return $this->db->query($sql)->getResult();
    }

    public function getFarmerDataById($farmer_id)
    {
        $sql = "SELECT
        tbl_user.user_code,
        tbl_user.user_name,
        tbl_user.user_mobile,
        SUM(tbl_milk_collection.due_amount) AS d_amount,
        tbl_milk_collection.*
     FROM
        tbl_milk_collection
     JOIN tbl_user ON tbl_milk_collection.farmer_id = tbl_user.id
        WHERE tbl_milk_collection.farmer_id = $farmer_id";
        return $this->db->query($sql)->getRow();
    }

    public function getPriceByDate($to_date, $farmer_id)
    {
        $sql = "SELECT id, due_amount, date FROM tbl_milk_collection WHERE date <= ? AND farmer_id = ? AND due_amount > 0";
        return $this->db->query($sql, [$to_date, $farmer_id])->getResult();
    }


    public function getTotalAmount($value)
    {
        return $this->db
            ->table('tbl_milk_collection')
            ->select('due_amount')
            ->where('id', $value)
            ->get()
            ->getRow();
    }

    public function getFarmerInvoiceId($farmer_id)
    {
        $sql = "SELECT id FROM tbl_milk_collection WHERE farmer_id = $farmer_id";
        return $this->db->query($sql)->getResultArray();
    }

    public function updateCollectionData($inv_id, $due_amount)
    {
        return $this->db
            ->table('tbl_milk_collection')
            ->set('due_amount', $due_amount)
            ->where('id', $inv_id)
            ->update();
    }

    public function addFarmerPayData($data)
    {
        $this->db
            ->table('tbl_farmer_payment')
            ->insert($data);
        return $this->db->InsertID();
    }

    public function getFarmerPayData($farmer_id)
    {
        $sql = "SELECT tbl_user.user_name, tbl_user.user_code, tbl_user.user_mobile, tbl_farmer_payment.*
        FROM tbl_farmer_payment 
        JOIN tbl_user ON tbl_farmer_payment.farmer_id = tbl_user.id
        WHERE tbl_farmer_payment.farmer_id = $farmer_id";
        return $this->db->query($sql)->getResult();
    }
}
