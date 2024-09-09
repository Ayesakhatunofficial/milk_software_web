<?php

namespace App\Controllers;

use App\Models\ItemModel;

class Item extends BaseController
{
    public function create()
    {
        $data['page_title'] = 'Item';
        return view('admin/item/additem', $data);
    }

    public function addData()
    {
        $session = session();
        $name = $this->request->getVar('name');
       // $quantity = $this->request->getVar('quantity');
        $rate = $this->request->getVar('rate');

        $rules = [
            'name' => [
                'label' => 'Item Name',
                'rules' => 'required'
            ],
            // 'quantity' => [
            //     'label' => 'Item Quantity',
            //     'rules' => 'required'
            // ],
            'rate' => [
                'label' => 'Item Rate',
                'rules' => 'required'
            ]
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['name'])) {
                $session->setFlashdata('name_error', $errors['name']);
            }
            // if (isset($errors['quantity'])) {
            //     $session->setFlashdata('quantity_error', $errors['quantity']);
            // }
            if (isset($errors['rate'])) {
                $session->setFlashdata('rate_error', $errors['rate']);
            }
            return redirect()->to('/item/create/');
        }

        $user_id = $session->get('user_id');
        $itemModel = new ItemModel();
        $data =[
            'name' => $name,
            //'quantity' => $quantity,
            'rate' => $rate,
            'created_at' => date('Y-m-d'),
            'created_by' => $user_id
        ];
        $result = $itemModel->addData($data);

        if ($result) {
            $session->setFlashdata('success', 'Item Added Successfully');
            return redirect()->to('/item/view');
        }
    }

    public function viewData(){
        $data['page_title'] = 'Item';
        $itemModel = new ItemModel();
        $data['data'] = $itemModel->getData();
        return view('admin/item/viewitem', $data);
    }

    public function editData($id){
        $data['page_title'] = 'Item';
        $itemModel = new ItemModel();
        $data['data'] = $itemModel->getDataById($id);
        return view('admin/item/edititem', $data);
    }

    public function updateData($id)
    {
        $session = session();
        $name = $this->request->getVar('name');
        //$quantity = $this->request->getVar('quantity');
        $rate = $this->request->getVar('rate');

        $rules = [
            'name' => [
                'label' => 'Item Name',
                'rules' => 'required'
            ],
            // 'quantity' => [
            //     'label' => 'Item Quantity',
            //     'rules' => 'required'
            // ],
            'rate' => [
                'label' => 'Item Rate',
                'rules' => 'required'
            ]
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['name'])) {
                $session->setFlashdata('name_error', $errors['name']);
            }
            if (isset($errors['quantity'])) {
                $session->setFlashdata('quantity_error', $errors['quantity']);
            }
            // if (isset($errors['rate'])) {
            //     $session->setFlashdata('rate_error', $errors['rate']);
            // }
            return redirect()->to('/item/edit/'.$id);
        }

        $user_id = $session->get('user_id');
        $itemModel = new ItemModel();
        $data =[
            'name' => $name,
            //'quantity' => $quantity,
            'rate' => $rate,
            'modified_at' => date('Y-m-d'),
            'modified_by' => $user_id
        ];
        $result = $itemModel->updateData($id, $data);

        if ($result) {
            $session->setFlashdata('success', 'Item Updated Successfully');
            return redirect()->to('/item/view');
        }
    }

    public function deleteData($id){
        $session = session();
        $itemModel = new ItemModel();
        $result = $itemModel->deleteData($id);
        if ($result) {
            $session->setFlashdata('success', 'Item Deleted Successfully');
            return redirect()->to('/item/view');
        }
    }

    public function createProduct(){
        $data['page_title'] = 'Product';
        $itemModel = new ItemModel();
        $data['items'] = $itemModel->getData();
        return view('admin/item/addproduct', $data);
    }

    public function getMilk(){
        $date = $this->request->getVar('date');
        $itemModel = new ItemModel();
    
        $total_collect = $itemModel->getCollectQuantity($date);
        $total_collect_quantity = ($total_collect != null) ? $total_collect->total_quantity : 0;
    
        $total_sale = $itemModel->getSaleQuantity($date);
        $total_sale_quantity = ($total_sale != null) ? $total_sale->total_quantity : 0;

        $product_milk = $itemModel->getProductMilk($date);
        $total_product_milk = ($product_milk != null) ? $product_milk->total_quantity : 0;
    
        $milkDue = ($total_collect_quantity > 0) ? $total_collect_quantity - $total_sale_quantity - $total_product_milk : 0;
    
        return $this->response->setJSON(['milkDue' => $milkDue]);
    }

    public function addProductData(){
        $session = session();
        $item = $this->request->getVar('item');
        $date = $this->request->getVar('date');
        $milk_quantity = $this->request->getVar('milk_quantity');
        $product_quantity = $this->request->getVar('product_quantity');
        $milk = $this->request->getVar('milk');

        $rules =[
            'item' => [
                'label' => 'Item',
                'rules' => 'required'
            ],          
            'date' =>[
                'label' => 'Date',
                'rules' => 'required'
            ],
            'milk_quantity' =>[
                'label' => 'Milk Quantity',
                'rules' => 'required|greater_than[0]|less_than_equal_to[' . $milk . ']'
            ],
            'product_quantity' =>[
                'label' => 'Product Quantity',
                'rules' => 'required'
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['item'])) {
                $session->setFlashdata('item_error', $errors['item']);
            }
            if (isset($errors['date'])) {
                $session->setFlashdata('date_error', $errors['date']);
            }
            if (isset($errors['milk_quantity'])) {
                $session->setFlashdata('milk_error', $errors['milk_quantity']);
            }
            if (isset($errors['product_quantity'])) {
                $session->setFlashdata('product_error', $errors['product_quantity']);
            }
            return redirect()->to('/product/create/');
        }

        $user_id = $session->get('user_id');
        $itemModel = new ItemModel();
        $data = [
            'item_id' => $item,
            'date' => $date,
            'milk_quantity' => $milk_quantity,
            'product_quantity' => $product_quantity,
            'created_at' => date('Y-m-d'),
            'created_by' => $user_id
        ];
        $result = $itemModel->addProductData($data);

        if ($result) {
            $session->setFlashdata('success', 'Product Added Successfully');
            return redirect()->to('/product/view/'.$item);
        }
    }

    public function viewTotalProductData(){
        $data['page_title'] = 'Stock';
        $itemModel = new ItemModel();
        $data['data'] = $itemModel->getTotalProduct();
        return view('admin/item/viewtotalproduct', $data);
    }

    public function viewProductData($item_id){
        $data['page_title'] = 'Product';
        $itemModel = new ItemModel();
        $data['data'] = $itemModel->getProductData($item_id);
        return view('admin/item/viewproduct', $data);
    }

    public function editProductData($id){
        $data['page_title'] = 'Product';
        $itemModel = new ItemModel();
        $data['items'] = $itemModel->getData();
        $data['data'] = $itemModel->getProductDataById($id);
        return view('admin/item/editproduct', $data);
    }

    public function updateProductData($id){
        $session = session();
        $item = $this->request->getVar('item');
        $date = $this->request->getVar('date');
        $product_quantity = $this->request->getVar('product_quantity');
        $remarks = $this->request->getVar('remarks');

        $rules =[
            'item' => [
                'label' => 'Item',
                'rules' => 'required'
            ],          
            'date' =>[
                'label' => 'Date',
                'rules' => 'required'
            ],
            'product_quantity' =>[
                'label' => 'Product Quantity',
                'rules' => 'required'
            ],

        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['item'])) {
                $session->setFlashdata('item_error', $errors['item']);
            }
            if (isset($errors['date'])) {
                $session->setFlashdata('date_error', $errors['date']);
            }
            if (isset($errors['product_quantity'])) {
                $session->setFlashdata('product_error', $errors['product_quantity']);
            }
            return redirect()->to('/product/edit/'.$id);
        }

        $user_id = $session->get('user_id');
        $itemModel = new ItemModel();
        $data = [
            'item_id' => $item,
            'date' => $date,
            'product_quantity' => $product_quantity,
            'remarks' => $remarks,
            'modified_at' => date('Y-m-d'),
            'modified_by' => $user_id
        ];
        $result = $itemModel->updateProductData($id, $data);

        if ($result) {
            $session->setFlashdata('success', 'Product Updated Successfully');
            return redirect()->to('/product/view/'.$item);
        }
    }

    public function deleteProductData($id){
        $session = session();
        $itemModel = new ItemModel();
        $result = $itemModel->deleteProductData($id);
        if ($result) {
            $session->setFlashdata('success', 'Product Deleted Successfully');
            return redirect()->to('/product/totalview');
        }
    }


    
}
