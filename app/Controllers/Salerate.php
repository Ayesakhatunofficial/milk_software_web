<?php

namespace App\Controllers;

use App\Models\SalerateModel;

class Salerate extends BaseController
{
    public function create()
    {
        $data['page_title'] = 'Sale Rate';
        return view('admin/sale_rate/addsalerate', $data);
    }

    public function addData(){
        $session = session();
        $rate = $this->request->getPost('rate');
        $quantity = $this->request->getPost('quantity');
        $type = $this->request->getPost('type');

        $rules = [
            'rate' => [
                'label' => 'Sale Rate',
                'rules' => 'required'
            ],
            'quantity' => [
                'label' => 'Quantity', 'rules' => 'required'
            ],
            'type' => [
                'label' => 'Type', 'rules' => 'required'
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['rate'])) {
                $session->setFlashdata('rate_error', $errors['rate']);
            }
            if (isset($errors['quantity'])) {
                $session->setFlashdata('quantity_error', $errors['quantity']);
            }
            if (isset($errors['type'])) {
                $session->setFlashdata('type_error', $errors['type']);
            }
            return redirect()->to('/salerate/create/');
        }
        $user_id = $session->get('user_id');
        $salerateModel = new SalerateModel();

        $data = [
            'rate' => $rate,
            'quantity' => $quantity,
            'type' => $type,
            'created_by' => $user_id,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $result = $salerateModel->addData($data);
        if ($result) {
            $session->setFlashdata('success', 'Sale Rate Added Successfully');
            return redirect()->to('/salerate/view');
        }
    }

    public function viewData(){
        $data['page_title'] = 'Sale Rate';
        $salerateModel = new SalerateModel();
        $data['data'] = $salerateModel->getData();
        return view('admin/sale_rate/viewsalerate', $data);
    }

    public function editData($id){
        $data['page_title'] = 'Sale Rate';
        $salerateModel = new SalerateModel();
        $data['data'] = $salerateModel->getDataById($id);
        return view('admin/sale_rate/editsalerate', $data);
    }

    public function updateData($id){
        $session = session();
        $rate = $this->request->getPost('rate');
        $quantity = $this->request->getPost('quantity');
        $type = $this->request->getPost('type');

        $rules = [
            'rate' => [
                'label' => 'Sale Rate',
                'rules' => 'required'
            ],
            'quantity' => [
                'label' => 'Quantity', 'rules' => 'required'
            ],
            'type' => [
                'label' => 'Type', 'rules' => 'required'
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['rate'])) {
                $session->setFlashdata('rate_error', $errors['rate']);
            }
            if (isset($errors['quantity'])) {
                $session->setFlashdata('quantity_error', $errors['quantity']);
            }
            if (isset($errors['type'])) {
                $session->setFlashdata('type_error', $errors['type']);
            }
            return redirect()->to('/salerate/edit/'.$id);
        }
        $user_id = $session->get('user_id');
        $salerateModel = new SalerateModel();

        $data = [
            'rate' => $rate,
            'quantity' => $quantity,
            'type' => $type,
            'modified_by' => $user_id,
            'modified_at' => date('Y-m-d H:i:s')
        ];

        $result = $salerateModel->updateData($id, $data);
        if ($result) {
            $session->setFlashdata('success', 'Sale Rate Updated Successfully');
            return redirect()->to('/salerate/view');
        }
    }

    public function deleteData($id){
        $salerateModel = new SalerateModel();
        $result = $salerateModel->deleteData($id);
        $session = session();

        if ($result) {
            $session->setFlashdata('success', 'Sale Rate deleted Successfully');
            return redirect()->to('salerate/view');
        }
    }

    

}