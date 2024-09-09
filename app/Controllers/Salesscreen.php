<?php

namespace App\Controllers;

use App\Models\SalesscreenModel;

class Salesscreen extends BaseController
{
    public function create()
    {
        $data['page_title'] = 'Sales';
        $salesscreenModel = new SalesscreenModel();
        $data['data'] = $salesscreenModel->getShift();
        $data['types'] = $salesscreenModel->getProduct();
        return view('admin/salesscreen/addscreen', $data);
    }

    public function getCustomerResult()
    {
        $userInput = $this->request->getPost('user_input');
        //echo $userInput;exit;
        $salesscreenModel = new SalesscreenModel();
        $result = $salesscreenModel->search($userInput);
        //print_r($result);exit;
        if ($result) {
            $response = [
                'id' => $result->id,
                'user_mobile' => $result->user_mobile,
                'name' => $result->user_name,
            ];
        } else {
            $response = ['error' => 'User not found'];
        }
        echo json_encode($response);
    }

    public function getPrice()
    {
        $type = $this->request->getPost('milk_type');
        $quantity = $this->request->getPost('quantity');
        $paid_amount = $this->request->getPost('paid_amount');
        $discount = $this->request->getPost('discount');

        $salesscreenModel = new SalesscreenModel();
        $pricePerLiter = $salesscreenModel->getSaleRate($type);

        $totalPrice = $quantity * $pricePerLiter;
        if (($discount = $this->request->getPost('discount')) != Null && $totalPrice != 0) {
            $total_amount = $totalPrice - $discount;
        } else {
            $discount = 0;
            $total_amount = $totalPrice - $discount;
        }

        //$due_amount = $totalPrice;
        $totaldue = $total_amount - $paid_amount;
        return json_encode(['totalPrice' => $totalPrice, 'price' => $pricePerLiter, 'total_amount' => $total_amount, 'totaldue' => $totaldue]);
    }

    public function getPerProductPrice()
    {
        $type = $this->request->getPost('product_type');
        $quantity = $this->request->getPost('quantity');
        $salesscreenModel = new SalesscreenModel();
        $pricePerProduct = $salesscreenModel->getProductSaleRate($type);
        //echo $pricePerProduct;die;
        $totalPrice = $quantity * $pricePerProduct;
        
        return json_encode(['price' => $pricePerProduct, 'totalPrice' => $totalPrice]);
    }

    public function getProductPrice()
    {
        $quantity = $this->request->getPost('quantity');
        $per_product_price = $this->request->getPost('per_product_price');

        $totalPrice = $quantity * $per_product_price;
        return json_encode(['totalPrice' => $totalPrice]);
    }

    // public function getDueAmount()
    // {
    //     $total_amount = $this->request->getPost('total_amount');
    //     $pay_amount = $this->request->getPost('paid_amount');
    //     $id = 0;
    //     if ($this->request->getPost('id') != NULL) {
    //         $id = $this->request->getPost('id');
    //     }

    //     $salesscreenModel = new SalesscreenModel();

    //     //echo $amount;die;
    //     $totaldue = 0;
    //     if ($total_amount >= 0) {
    //         $totaldue = $total_amount - $pay_amount;
    //         if ($id) {
    //             $amount = $salesscreenModel->getSumAmount($id);
    //             if ($amount) {
    //                 $totaldue = $total_amount - $pay_amount - $amount->total_pay_amount;
    //             }
    //         }
    //     }
    //     return json_encode(['totaldue' => $totaldue]);
    // }

    public function addData()
    {
        $session = session();
        $cust_id = $this->request->getPost('id');
        $date = $this->request->getPost('date');
        $shift = $this->request->getPost('shift');
        $sale_type = $this->request->getPost('sale_type');
        if ($sale_type == 'milk') {
            $sub_total = $this->request->getPost('milk_price');
            $discount = $this->request->getPost('milk_discount');
            $total_amount =  $this->request->getPost('milk_total_amount');
            $paid_amount = $this->request->getPost('milk_paid_amount');
            $due_amount = $this->request->getPost('milk_due_amount');
        } else {
            $sub_total = $this->request->getPost('sub_total');
            $discount = $this->request->getPost('discount');
            $total_amount =  $this->request->getPost('total_amount');
            $paid_amount = $this->request->getPost('paid_amount');
            $due_amount = $this->request->getPost('due_amount');
        }

        //  echo $discount;echo $total_amount;echo $paid_amount;die;

        $rules = [
            'shift' => [
                'label' => 'Shift',
                'rules' => 'required'
            ],
            'sale_type' => [
                'label' => 'Sale Type',
                'rules' => 'required'
            ],
        ];

        $milk_type = $this->request->getPost('milk_type');
        $milk_quantity = $this->request->getPost('milk_quantity');
        $price_per_liter = $this->request->getPost('price_per_liter');
        $milk_price = $this->request->getPost('milk_price');
        if ($sale_type == 'milk') {
            $rules['milk_type'] = [
                'label' => 'Milk Type',
                'rules' => 'required'
            ];
            $rules['milk_quantity'] = [
                'label' => 'Quantity',
                'rules' => 'required'
            ];
        }

        $product_types = $this->request->getPost('product_type');

        $quantity = $this->request->getPost('quantity');
        $price_per = $this->request->getPost('single_price');
        $price = $this->request->getPost('price');
        if ($sale_type == 'product') {
            $rules['product_type.*'] = [
                'label' => 'Product Type',
                'rules' => 'required'
            ];
            $rules['quantity.*'] = [
                'label' => 'Quantity',
                'rules' => 'required'
            ];
        }

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['shift'])) {
                $session->setFlashdata('shift_error', $errors['shift']);
            }
            if (isset($errors['sale_type'])) {
                $session->setFlashdata('sale_error', $errors['sale_type']);
            }

            if (isset($errors['milk_type'])) {
                $session->setFlashdata('milk_error', $errors['milk_type']);
            }
            if (isset($errors['milk_quantity'])) {
                $session->setFlashdata('milk_quantity_error', $errors['milk_quantity']);
            }

            if (isset($errors['product_type.*'])) {
                $session->setFlashdata('product_error', $errors['product_type.*']);
            }
            if (isset($errors['quantity.*'])) {
                $session->setFlashdata('quantity_error', $errors['quantity.*']);
            }

            return redirect()->to('/screen/create/');
        }
        //print_r($product_types);die;
        $user_id = $session->get('user_id');
        $salesscreenModel = new SalesscreenModel();


        $data = [
            'customer_id' => $cust_id,
            'date' => $date,
            'shift_id' => $shift,
            'sale_type' => $sale_type,
            'subtotal' => $sub_total,
            'discount' => $discount,
            'total_amount' => $total_amount,
            'paid_amount' => $paid_amount,
            'due_amount' => $due_amount,
            'status' => $due_amount == 0 ? 'paid' : 'due',
            'created_by' => $user_id,
            'created_at' => date('Y-m-d H:i:s')
        ];

        // print_r($data);die;
        $last_insert_id = $salesscreenModel->addData($data);
        if ($sale_type == 'milk') {
            $data1 = [
                'ref_id' => $last_insert_id,
                'milk_type' => $milk_type,
                'quantity' => $milk_quantity,
                'per_price' => $price_per_liter,
                'price' => $milk_price,
                'created_by' => $user_id,
                'created_at' => date('Y-m-d H:i:s')
            ];
            //print_r($data1);die;
            $result = $salesscreenModel->addItemData($data1);
        }

        if ($sale_type == 'product') {
            foreach ($product_types as $index => $product_type) {
                $p_quantity = $quantity[$index];
                $p_price_per = $price_per[$index];
                $p_price = $price[$index];
                $data1 = [
                    'ref_id' => $last_insert_id,
                    'product_type' => $product_type,
                    'quantity' => $p_quantity,
                    'per_price' => $p_price_per,
                    'price' => $p_price,
                    'created_by' => $user_id,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                // print_r($data2);die;
                $result = $salesscreenModel->addItemData($data1);
            }
        }
        if ($last_insert_id) {

            $prevAmount = $salesscreenModel->getPrevAmount($last_insert_id);

            // print_r($prevAmount);exit;
            if (!$prevAmount) {
                $prevAmount = 0;
            }

            $lastid = $salesscreenModel->getLastId();
            $trans_code = $lastid->total_id + 1;
            $trans_data = [
                'ref_id' => $last_insert_id,
                'trans_code' => 'TRANS' . date('Y') . '' . date('m') . 0 . $trans_code,
                'trans_type' => 'credit',
                'amount' => $paid_amount,
                'prev_amount' => $prevAmount,
                'trans_date' => date('Y-m-d'),
                'status' => 'paid',
                'created_by' => $user_id,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $result_1 = $salesscreenModel->addTransData($trans_data);
            if ($result_1) {
                $session->setFlashdata('success', 'Sale Screen Added Successfully');
                return redirect()->to('/screen/view');
            }
        }
    }

    public function addCustData()
    {
        $session = session();
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $contact = $this->request->getPost('contact');
        $address = $this->request->getPost('address');
        $password = md5($this->request->getVar('password'));

        $user_id = $session->get('user_id');
        //print_r($user_id); die;

        $salesscreenModel = new SalesscreenModel();
        $lastid = $salesscreenModel->getCustLastId();
        // print_r($lastid);die;
        // $user_code = str_pad(($lastid->id + 1), 3, '0', STR_PAD_RIGHT);
        $user_code = $lastid->total_customer + 1;
        $data = [
            'user_code' => 'CO' . 0 . $user_code,
            'user_name' => $name,
            'user_email' => $email,
            'user_mobile' => $contact,
            'user_address ' => $address,
            'user_password' => $password,
            'user_role' =>  'customer',
            'created_by' => $user_id,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $result = $salesscreenModel->addCustData($data);

        if ($result) {
            $session->setFlashdata('success', 'Customer Added Successfully');
            return redirect()->to('/screen/create');
        }
    }

    public function viewData()
    {
        $data['page_title'] = 'Sales';
        $salesscreenModel = new SalesscreenModel();
        $data['data'] = $salesscreenModel->getData();
        return view('admin/salesscreen/viewscreen', $data);
    }

    public function editData($id)
    {
        $data['page_title'] = 'Sales';
        $salesscreenModel = new SalesscreenModel();
        $data['result'] = $salesscreenModel->getDataById($id);
        $data['items'] = $salesscreenModel->getItemData($id);
        $data['data'] = $salesscreenModel->getShift();
        $data['types'] = $salesscreenModel->getProduct();
        return view('admin/salesscreen/editscreen', $data);
    }

    public function updateData($id)
    {
        $session = session();
        $cust_id = $this->request->getPost('id');
        $date = $this->request->getPost('date');
        $shift = $this->request->getPost('shift');
        $sale_type = $this->request->getPost('sale_type');
        if ($sale_type == 'milk') {
            $sub_total = $this->request->getPost('milk_price');
            $discount = $this->request->getPost('milk_discount');
            $total_amount =  $this->request->getPost('milk_total_amount');
            $paid_amount = $this->request->getPost('milk_paid_amount');
            $due_amount = $this->request->getPost('milk_due_amount');
        } else {
            $sub_total = $this->request->getPost('sub_total');
            $discount = $this->request->getPost('discount');
            $total_amount =  $this->request->getPost('total_amount');
            $paid_amount = $this->request->getPost('paid_amount');
            $due_amount = $this->request->getPost('due_amount');
        }

        //  echo $discount;echo $total_amount;echo $paid_amount;die;

        $rules = [
            'shift' => [
                'label' => 'Shift',
                'rules' => 'required'
            ],
            'sale_type' => [
                'label' => 'Sale Type',
                'rules' => 'required'
            ],
        ];

        $milk_type = $this->request->getPost('milk_type');
        $milk_quantity = $this->request->getPost('milk_quantity');
        $price_per_liter = $this->request->getPost('price_per_liter');
        $milk_price = $this->request->getPost('milk_price');
        if ($sale_type == 'milk') {
            $rules['milk_type'] = [
                'label' => 'Milk Type',
                'rules' => 'required'
            ];
            $rules['milk_quantity'] = [
                'label' => 'Quantity',
                'rules' => 'required'
            ];
        }

        $product_types = $this->request->getPost('product_type');

        $quantity = $this->request->getPost('quantity');
        $price_per = $this->request->getPost('single_price');
        $price = $this->request->getPost('price');
        if ($sale_type == 'product') {
            $rules['product_type.*'] = [
                'label' => 'Product Type',
                'rules' => 'required'
            ];
            $rules['quantity.*'] = [
                'label' => 'Quantity',
                'rules' => 'required'
            ];
        }

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['shift'])) {
                $session->setFlashdata('shift_error', $errors['shift']);
            }
            if (isset($errors['sale_type'])) {
                $session->setFlashdata('sale_error', $errors['sale_type']);
            }

            if (isset($errors['milk_type'])) {
                $session->setFlashdata('milk_error', $errors['milk_type']);
            }
            if (isset($errors['milk_quantity'])) {
                $session->setFlashdata('milk_quantity_error', $errors['milk_quantity']);
            }

            if (isset($errors['product_type.*'])) {
                $session->setFlashdata('product_error', $errors['product_type.*']);
            }
            if (isset($errors['quantity.*'])) {
                $session->setFlashdata('quantity_error', $errors['quantity.*']);
            }

            return redirect()->to('/screen/edit/' . $id);
        }
        //print_r($product_types);die;
        $user_id = $session->get('user_id');
        $salesscreenModel = new SalesscreenModel();


        $data = [
            'customer_id' => $cust_id,
            'date' => $date,
            'shift_id' => $shift,
            'sale_type' => $sale_type,
            'subtotal' => $sub_total,
            'discount' => $discount,
            'total_amount' => $total_amount,
            'paid_amount' => $paid_amount,
            'due_amount' => $due_amount,
            'status' => $due_amount == 0 ? 'paid' : 'due',
            'modified_by' => $user_id,
            'modified_at' => date('Y-m-d H:i:s')
        ];

        // print_r($data);die;
        $result = $salesscreenModel->updateData($id, $data);
        if ($sale_type == 'milk') {
            $data1 = [
                'milk_type' => $milk_type,
                'quantity' => $milk_quantity,
                'per_price' => $price_per_liter,
                'price' => $milk_price,
                'modified_by' => $user_id,
                'modified_at' => date('Y-m-d H:i:s')
            ];
            //print_r($data1);die;
            $result = $salesscreenModel->updateItemData($id, $data1);
        }

        if ($sale_type == 'product') {
            $salesscreenModel->deleteItem($id);
            foreach ($product_types as $index => $product_type) {
                $p_quantity = $quantity[$index];
                $p_price_per = $price_per[$index];
                $p_price = $price[$index];
                $data1 = [
                    'ref_id' => $id,
                    'product_type' => $product_type,
                    'quantity' => $p_quantity,
                    'per_price' => $p_price_per,
                    'price' => $p_price,
                    'modified_by' => $user_id,
                    'modified_at' => date('Y-m-d H:i:s')
                ];
                $result = $salesscreenModel->addItemData($data1);
            }
        }

        if ($result) {
            $session->setFlashdata('success', 'Sale Screen updated Successfully');
            return redirect()->to('/screen/view');
        }
    }

    public function Invoice($id)
    {
        $data['page_title'] = 'Invoice';
        $salesscreenModel = new SalesscreenModel();
        $data['types'] = $salesscreenModel->getProduct();
        $data['setting'] = $salesscreenModel->getSettings();
        $data['result'] = $salesscreenModel->getDataById($id);
        $data['datas'] = $salesscreenModel->getItemDataById($id);
        // print_r($data['datas']);die;
        return view('admin/salesscreen/invoice', $data);
    }

    public function InvoicePrint($id)
    {
        $salesscreenModel = new SalesscreenModel();
        $data['types'] = $salesscreenModel->getProduct();
        $data['setting'] = $salesscreenModel->getSettings();
        $data['result'] = $salesscreenModel->getDataById($id);
        $data['datas'] = $salesscreenModel->getItemDataById($id);
        return view('admin/salesscreen/invoiceprint', $data);
    }

    public function deleteData($id)
    {
        $salesscreenModel = new SalesscreenModel();
        $result = $salesscreenModel->deleteData($id);
        $session = session();

        if ($result) {
            $session->setFlashdata('success', 'Sale Screen deleted Successfully');
            return redirect()->to('screen/view');
        }
    }
}
