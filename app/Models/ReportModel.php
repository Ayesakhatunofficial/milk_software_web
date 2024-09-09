<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model
{
   
    public function getShift()
    {
        $sql = "SELECT * FROM tbl_shift";
        $query = $this->db->query($sql);
        return $query->getResult();
    }
    public function getSaleReportData($fromDate, $toDate, $user_code, $milk_type, $shift)
    {
        $ext_sql = '';
        $params = array($fromDate, $toDate);
        if ($user_code !== "") {
            $ext_sql = ' AND tbl_user.user_code = ?';
            $params[] = $user_code;
        }

        if ($milk_type !== "") {
            $sql_2 = ' AND tbl_sales_item.milk_type = ?';
            $params[] = $milk_type;
            $ext_sql = $ext_sql . '' . $sql_2;
        }

        if ($shift !== "") {
            $sql_3 = ' AND tbl_shift.id = ?';
            $params[] = $shift;
            $ext_sql = $ext_sql . '' . $sql_3;
        }
        //print $milk_type;die;
        $sql = "SELECT
                    tbl_shift.id,
                    tbl_shift.shift_name,
                    tbl_user.id AS user_id,
                    tbl_user.user_name,
                    tbl_user.user_code,
                    tbl_sales_item.milk_type,
                    tbl_sales_item.per_price,
                    tbl_sales_item.price,
                    tbl_sales_item.quantity,
                    tbl_sales_screen.*
                FROM
                    tbl_sales_screen
                JOIN tbl_user ON tbl_sales_screen.customer_id = tbl_user.id
                JOIN tbl_shift ON tbl_sales_screen.shift_id = tbl_shift.id
                JOIN tbl_sales_item on tbl_sales_screen.id = tbl_sales_item.ref_id
                WHERE
                    tbl_sales_screen.date >= ? AND tbl_sales_screen.date <= ? AND tbl_sales_screen.sale_type = 'milk'" . $ext_sql;

        $query = $this->db->query($sql, $params);
        return $query->getResult();
    }

    public function getMilkReportData($fromDate, $toDate, $farmer_code, $milk_type, $shift)
    {
        $ext_sql = '';
        $params = array($fromDate, $toDate);

        if ($farmer_code !== "") {
            $ext_sql .= ' AND farmer_table.user_code = ?';
            $params[] = $farmer_code;
        }

        // if ($col_boy_code !== "") {
        //     $ext_sql .= ' AND col_boy_table.user_code = ?';
        //     $params[] = $col_boy_code;
        // }

        if ($milk_type !== "") {
            $sql_2 = ' AND tbl_sale_rate.type = ?';
            $params[] = $milk_type;
            $ext_sql .= $sql_2;
        }

        if ($shift !== "") {
            $sql_3 = ' AND tbl_shift.id = ?';
            $params[] = $shift;
            $ext_sql .= $sql_3;
        }

        $sql = "SELECT
                tbl_shift.id AS shift_id,
                tbl_shift.shift_name,
                tbl_sale_rate.id,
                tbl_sale_rate.type,
                fat_table.fat,
                cnf_table.cnf,
                farmer_table.id AS f_id,
                col_boy_table.id AS col_id,
                farmer_table.user_name AS farmer_name,
                farmer_table.user_mobile AS farmer_mobile,
                col_boy_table.user_name AS col_boy_name,
                farmer_table.user_code AS farmer_code,
                col_boy_table.user_code AS col_boy_code,
                tbl_milk_collection.*
            FROM
                tbl_milk_collection
                JOIN tbl_user AS farmer_table ON tbl_milk_collection.farmer_id = farmer_table.id
                JOIN tbl_user AS col_boy_table ON tbl_milk_collection.col_boy_id = col_boy_table.id
                JOIN tbl_shift ON tbl_milk_collection.shift_id = tbl_shift.id
                JOIN tbl_sale_rate ON tbl_milk_collection.milk_type = tbl_sale_rate.id
                JOIN tbl_price_chart AS fat_table ON tbl_milk_collection.fat_id = fat_table.id
                JOIN tbl_price_chart AS cnf_table ON tbl_milk_collection.cnf_id = cnf_table.id
            WHERE
                tbl_milk_collection.date >= ? AND tbl_milk_collection.date <= ? " . $ext_sql;

        $query = $this->db->query($sql, $params);
        return $query->getResult();
    }

    public function getProduct()
    {
        return $this->db
            ->table('tbl_items')
            ->get()
            ->getResult();
    }

    public function getProductReportData($fromDate, $toDate, $user_code, $product_type, $shift)
    {
        $ext_sql = '';
        $params = array($fromDate, $toDate);
        if ($user_code !== "") {
            $ext_sql = ' AND tbl_user.user_code = ?';
            $params[] = $user_code;
        }

        if ($product_type !== "") {
            $sql_2 = ' AND tbl_sales_item.product_type = ?';
            $params[] = $product_type;
            $ext_sql = $ext_sql . '' . $sql_2;
        }

        if ($shift !== "") {
            $sql_3 = ' AND tbl_shift.id = ?';
            $params[] = $shift;
            $ext_sql = $ext_sql . '' . $sql_3;
        }
        //print $milk_type;die;
        $sql = "SELECT
            tbl_shift.id,
            tbl_shift.shift_name,
            tbl_items.id,
            GROUP_CONCAT(tbl_items.name) as item_names,
            tbl_user.id AS user_id,
            tbl_user.user_name,
            tbl_user.user_code,
            tbl_sales_item.ref_id,
            sum(tbl_sales_item.quantity) as total_quantity,
            GROUP_CONCAT(tbl_sales_item.product_type SEPARATOR '\n') AS product_types,
            GROUP_CONCAT(tbl_sales_item.per_price) AS per_prices,
            GROUP_CONCAT(tbl_sales_item.price) AS prices,
            GROUP_CONCAT(tbl_sales_item.quantity) AS quantities,
            tbl_sales_screen.*
        FROM
            tbl_sales_screen
        JOIN tbl_user ON tbl_sales_screen.customer_id = tbl_user.id
        JOIN tbl_shift ON tbl_sales_screen.shift_id = tbl_shift.id
        JOIN tbl_sales_item ON tbl_sales_screen.id = tbl_sales_item.ref_id
        JOIN tbl_items ON tbl_sales_item.product_type = tbl_items.id
        WHERE
            tbl_sales_screen.date >= ? AND tbl_sales_screen.date <= ? AND tbl_sales_screen.sale_type = 'product'
            $ext_sql
        GROUP BY tbl_sales_item.ref_id";



        $query = $this->db->query($sql, $params);
        return $query->getResult();
    }
}
