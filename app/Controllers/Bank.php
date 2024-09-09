<?php

namespace App\Controllers;

use App\Models\BankModel;

class Bank extends BaseController
{
    public function create()
    {
        $data['page_title'] = 'Bank';
        $bankModel = new BankModel();
        $data['farmers'] = $bankModel->getFarmerData();
        return view('admin/bank/addbank', $data);
    }

    public function addData()
    {
        $session = session();
        $farmer = $this->request->getPost('farmer');
        $bank_name = $this->request->getPost('bank_name');
        $b_ifsc = $this->request->getPost('b_ifsc');
        $b_account = $this->request->getPost('b_account');

        $rules = [
            'farmer' => [
                'label' => 'Farmer',
                'rules' => 'required'
            ],
            'bank_name' => [
                'label' => 'Bank Name', 'rules' => 'required'
            ],
            'b_ifsc' => [
                'label' => 'Bank IFSC Code', 'rules' => 'required'
            ],
            'b_account' => [
                'label' => 'Bank Account No', 'rules' => 'required',
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['farmer'])) {
                $session->setFlashdata('farmer_error', $errors['farmer']);
            }
            if (isset($errors['bank_name'])) {
                $session->setFlashdata('name_error', $errors['bank_name']);
            }
            if (isset($errors['b_ifsc'])) {
                $session->setFlashdata('ifsc_error', $errors['b_ifsc']);
            }
            if (isset($errors['b_account'])) {
                $session->setFlashdata('account_error', $errors['b_account']);
            }
            return redirect()->to('/bank/create/');
        }

        $user_id = $session->get('user_id');
        //print_r($user_id); die;

        $data = [
            'farmer_id' => $farmer,
            'bank_name' => $bank_name,
            'ifsc_code' => $b_ifsc,
            'ac_number ' => $b_account,
            'created_by' => $user_id,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $bankModel = new BankModel();
        $status = $bankModel->StatusInactive($data);
        // if ($status) {
            $result = $bankModel->addData($data);

            if ($result) {
                $session->setFlashdata('success', 'Bank Added Successfully');
                return redirect()->to('/bank/view');
            }
       // }
    }

    public function viewData()
    {
        $data['page_title'] = 'Bank';
        $bankModel = new BankModel();
        $data['data'] = $bankModel->getData();
        return view('admin/bank/viewbank', $data);
    }

    public function editData($id)
    {
        $data['page_title'] = 'Bank';
        $bankModel = new BankModel();
        $data['data'] = $bankModel->getDataById($id);
        return view('admin/bank/editbank', $data);
    }

    public function updateData($id){
        $session = session();
        $bank_name = $this->request->getPost('bank_name');
        $b_ifsc = $this->request->getPost('b_ifsc');
        $b_account = $this->request->getPost('b_account');

        $rules = [
            'bank_name' => [
                'label' => 'Bank Name', 'rules' => 'required'
            ],
            'b_ifsc' => [
                'label' => 'Bank IFSC Code', 'rules' => 'required'
            ],
            'b_account' => [
                'label' => 'Bank Account No', 'rules' => 'required',
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['bank_name'])) {
                $session->setFlashdata('name_error', $errors['bank_name']);
            }
            if (isset($errors['b_ifsc'])) {
                $session->setFlashdata('ifsc_error', $errors['b_ifsc']);
            }
            if (isset($errors['b_account'])) {
                $session->setFlashdata('account_error', $errors['b_account']);
            }
            return redirect()->to('/bank/edit/' .$id);
        }

        $user_id = $session->get('user_id');

        $data = [
            'bank_name' => $bank_name,
            'ifsc_code' => $b_ifsc,
            'ac_number ' => $b_account,
            'modified_by' => $user_id,
            'modified_at' => date('Y-m-d H:i:s')
        ];

        $bankModel = new BankModel();
        $result = $bankModel->updateData($id, $data);
        if ($result) {
            $session->setFlashdata('success', 'Bank updated Successfully');
            return redirect()->to('/bank/view');
        }
    }

    public function deleteData($id)
    {
        $bankModel = new BankModel();
        $result = $bankModel->deleteData($id);
        $session = session();

        if ($result) {
            $session->setFlashdata('success', 'Bank deleted Successfully');
            return redirect()->to('bank/view');
        }
    }
}
