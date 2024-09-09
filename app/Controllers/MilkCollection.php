<?php

namespace App\Controllers;

use App\Models\MilkCollectionModel;

class MilkCollection extends BaseController
{
    public function Create(){
        $data['page_title'] = 'Milk Collection';
        $milkCollectionModel = new MilkCollectionModel();
        $data['data'] = $milkCollectionModel->getShift();
        $data['fat'] = $milkCollectionModel->getFat();
        $data['cnf'] = $milkCollectionModel->getCnf();
        $data['milk_type'] = $milkCollectionModel->getMilkType();
        return view('admin/milk_collection/addcollection', $data);
    }

    public function getFarmerResult(){
        $userCode= $this->request->getPost('user_code');
        //echo $userCode;exit;
        $milkCollectionModel = new MilkCollectionModel();
        $result = $milkCollectionModel->search($userCode);
        //print_r($result);exit;
        if ($result) {
            $response = [
                'id' => $result->id,
                'name' => $result->user_name,
                'mobile' => $result->user_mobile,
            ];
        } else {
            $response = ['error' => 'User not found'];
        }
        echo json_encode($response);

    }

    public function getPrice()
    {
        $shift = $this->request->getPost('shift');
        $type = $this->request->getPost('milk_type');
        $quantity = $this->request->getPost('quantity');
        //echo $quantity;die;
        $fat_id = $this->request->getPost('fat');
        $cnf_id = $this->request->getPost('cnf');
        $milkCollectionModel = new MilkCollectionModel();
        $fat = $milkCollectionModel->getFatById($fat_id);
        $cnf = $milkCollectionModel->getCnfById($cnf_id);
        //echo $cnf;die;
        $pricePerLiter = $milkCollectionModel->getCollectRate($fat, $cnf, $shift, $type);
        //echo $pricePerLiter;die;
        if($quantity == NULL){
            $quantity = 0;
        }
         $totalPrice = round(($quantity * $pricePerLiter),2);
        return json_encode(['totalPrice' => $totalPrice, 'pricePerLiter' => $pricePerLiter]);
    }

    public function addData(){
        $session = session();
        $f_id = $this->request->getPost('id');
        $contact = $this->request->getPost('contact');
        $date = $this->request->getPost('date');
        $shift = $this->request->getPost('shift');
        $milk_type = $this->request->getPost('milk_type');
        $quantity = $this->request->getPost('quantity');
        $fat = $this->request->getPost('fat');
        $cnf = $this->request->getPost('cnf');
        $per_liter_price = $this->request->getPost('per_liter_price');
        $price = $this->request->getPost('price');
        

        $rules = [
            'date' => [
                'label' => 'Date',
                'rules' => 'required'
            ],
            'shift' => [
                'label' => 'Shift',
                'rules' => 'required'
            ],
            'quantity' => [
                'label' => 'Quantity', 'rules' => 'required'
            ],
            'milk_type' => [
                'label' => 'Milk Type', 'rules' => 'required'
            ],
            'fat' => [
                'label' => 'Fat', 'rules' => 'required'
            ],
            'cnf' => [
                'label' => 'CNF ', 'rules' => 'required'
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['date'])) {
                $session->setFlashdata('date_error', $errors['date']);
            }
            if (isset($errors['quantity'])) {
                $session->setFlashdata('quantity_error', $errors['quantity']);
            }
            if (isset($errors['shift'])) {
                $session->setFlashdata('shift_error', $errors['shift']);
            }
            if (isset($errors['milk_type'])) {
                $session->setFlashdata('milk_error', $errors['milk_type']);
            }
            if (isset($errors['fat'])) {
                $session->setFlashdata('fat_error', $errors['fat']);
            }
            if (isset($errors['cnf'])) {
                $session->setFlashdata('cnf_error', $errors['cnf']);
            }
            return redirect()->to('/milk/create/');
        }
        $user_id = $session->get('user_id');
        $milkCollectionModel = new MilkCollectionModel();

        $data = [
            'farmer_id' => $f_id,
            'farmer_mobile' => $contact,
            'col_boy_id' =>$user_id,
            'date' =>$date,
            'milk_quantity' => $quantity,
            'per_liter_price' => $per_liter_price,
            'milk_type' => $milk_type,
            'fat_id'=> $fat,
            'cnf_id' => $cnf,
            'price' => $price,
            'due_amount' => $price,
            'shift_id'=> $shift,
            'collected_by' => $user_id,
            'collected_at' => date('Y-m-d H:i:s')
        ];

        $result = $milkCollectionModel->addData($data);
        if ($result) {
            $session->setFlashdata('success', 'Collection Added Successfully');
            return redirect()->to('/milk/view');
        }
    }

    public function viewData()
    {
        $session = session();
        $user_id = $session->get('user_id');
        $data['page_title'] = 'Milk Collection';
        $milkCollectionModel = new MilkCollectionModel();
        $data['data'] = $milkCollectionModel->getData($user_id);
        return view('admin/milk_collection/viewcollection', $data);
    }

    public function editData($id)
    {
        $data['page_title'] = 'Milk Collection';
        $milkCollectionModel = new MilkCollectionModel();
        $data['data'] = $milkCollectionModel->getShift();
        $data['fat'] = $milkCollectionModel->getFat();
        $data['cnf'] = $milkCollectionModel->getCnf();
        $data['milk_type'] = $milkCollectionModel->getMilkType();
        $data['result'] = $milkCollectionModel->getDataById($id);
        $data['code'] = $id;
        return view('admin/milk_collection/editcollection', $data);
    }

    public function updateData($id){
        $session = session();
        $f_id = $this->request->getPost('id');
        $contact = $this->request->getPost('contact');
        $date = $this->request->getPost('date');
        $shift = $this->request->getPost('shift');
        $milk_type = $this->request->getPost('milk_type');
        $quantity = $this->request->getPost('quantity');
        $fat = $this->request->getPost('fat');
        $cnf = $this->request->getPost('cnf');
        $per_liter_price = $this->request->getPost('per_liter_price');
        $price = $this->request->getPost('price');

        $rules = [
            'date' => [
                'label' => 'Date',
                'rules' => 'required'
            ],
            'shift' => [
                'label' => 'Shift',
                'rules' => 'required'
            ],
            'quantity' => [
                'label' => 'Quantity', 'rules' => 'required'
            ],
            'milk_type' => [
                'label' => 'Milk Type', 'rules' => 'required'
            ],
            'fat' => [
                'label' => 'Fat', 'rules' => 'required'
            ],
            'cnf' => [
                'label' => 'CNF ', 'rules' => 'required'
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['date'])) {
                $session->setFlashdata('date_error', $errors['date']);
            }
            if (isset($errors['quantity'])) {
                $session->setFlashdata('quantity_error', $errors['quantity']);
            }
            if (isset($errors['shift'])) {
                $session->setFlashdata('shift_error', $errors['shift']);
            }
            if (isset($errors['milk_type'])) {
                $session->setFlashdata('milk_error', $errors['milk_type']);
            }
            if (isset($errors['fat'])) {
                $session->setFlashdata('fat_error', $errors['fat']);
            }
            if (isset($errors['cnf'])) {
                $session->setFlashdata('cnf_error', $errors['cnf']);
            }
            return redirect()->to('/milk/edit/'.$id);
        }
        $user_id = $session->get('user_id');
        $milkCollectionModel = new MilkCollectionModel();

        $data = [
            'farmer_id' => $f_id,
            'farmer_mobile' => $contact,
            'col_boy_id' =>$user_id,
            'date' =>$date,
            'milk_quantity' => $quantity,
            'per_liter_price' => $per_liter_price,
            'milk_type' => $milk_type,
            'fat_id'=> $fat,
            'cnf_id' => $cnf,
            'price' => $price,
            'due_amount' => $price,
            'shift_id'=> $shift,
            'modified_by' => $user_id,
            'modified_at' => date('Y-m-d H:i:s')
        ];

        $result = $milkCollectionModel->updateData($id, $data);
        if ($result) {
            $session->setFlashdata('success', 'Collection Updated Successfully');
            return redirect()->to('/milk/view');
        }
    }

    public function deleteData($id)
    {
        $milkCollectionModel = new MilkCollectionModel();
        $result = $milkCollectionModel->deleteData($id);
        $session = session();

        if ($result) {
            $session->setFlashdata('success', 'Collection deleted Successfully');
            return redirect()->to('milk/view');
        }
    }
}