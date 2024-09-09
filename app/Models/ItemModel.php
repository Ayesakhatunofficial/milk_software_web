<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    public function addData($data)
    {
        return $this->db
            ->table('tbl_items')
            ->insert($data);
    }

    public function getData()
    {
        return $this->db
            ->table('tbl_items')
            ->get()
            ->getResult();
    }

    public function getDataById($id)
    {
        return $this->db
            ->table('tbl_items')
            ->where('id', $id)
            ->get()
            ->getRow();
    }

    public function updateData($id, $data)
    {
        return $this->db
            ->table('tbl_items')
            ->where('id', $id)
            ->set($data)
            ->update();
    }

    public function deleteData($id)
    {
        return $this->db
            ->table('tbl_items')
            ->where('id', $id)
            ->delete();
    }

    public function getCollectQuantity($date)
    {
        return $this->db
            ->table('tbl_milk_collection')
            ->selectSum('milk_quantity', 'total_quantity')
            ->where('date', $date)
            ->get()
            ->getRow();
    }


    public function getSaleQuantity($date)
    {
        return $this->db
            ->table('tbl_sales_screen')
            ->selectSum('quantity', 'total_quantity')
            ->where('date', $date)
            ->get()
            ->getRow();
    }

    public function getProductMilk($date)
    {
        return $this->db
            ->table('tbl_stock')
            ->selectSum('milk_quantity', 'total_quantity')
            ->where('date', $date)
            ->get()
            ->getRow();
    }

    public function addProductData($data)
    {
        return $this->db
            ->table('tbl_stock')
            ->insert($data);
    }

    public function getTotalProduct()
    {
        $sql = "SELECT tbl_items.id as item_id, tbl_items.name , SUM(product_quantity) as total_product, tbl_stock.*
        FROM tbl_stock
        JOIN tbl_items on  tbl_stock.item_id = tbl_items.id
        GROUP BY tbl_stock.item_id";
        return $this->db->query($sql)->getResult();
    }

    public function getProductData($item_id)
    {
        $sql = "SELECT tbl_items.id, tbl_items.name, tbl_stock.*
        FROM tbl_stock
        JOIN tbl_items on  tbl_stock.item_id = tbl_items.id
        WHERE tbl_stock.item_id = $item_id";
        return $this->db->query($sql)->getResult();
    }

    public function getProductDataById($id){
        $sql = "SELECT tbl_items.id, tbl_items.name, tbl_stock.*
        FROM tbl_stock
        JOIN tbl_items on  tbl_stock.item_id = tbl_items.id
        WHERE tbl_stock.id = $id";
        return $this->db->query($sql)->getRow();
    }

    public function updateProductData($id, $data){
        return $this->db
            ->table('tbl_stock')
            ->where('id', $id)
            ->set($data)
            ->update();
    }

    public function deleteProductData($id){
        return $this->db
            ->table('tbl_stock')
            ->where('id',$id)
            ->delete();
    }
}
