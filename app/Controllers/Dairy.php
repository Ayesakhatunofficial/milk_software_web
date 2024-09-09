<?php

namespace App\Controllers;

use App\Models\DairyModel;

class Dairy extends BaseController
{
    public function create()
    {
        $data['page_title'] = 'Branch';
        return view('admin/dairy/adddairy',$data);
    }

    public function addData()
    {
        $session = session();
        $d_name = $this->request->getPost('d_name');
        $d_contact = $this->request->getPost('d_contact');
        $d_address = $this->request->getPost('d_address');

        $rules = [
            'd_name' => [
                'label' => 'Name',
                'rules' => 'required'
            ],
            'd_contact' => [
                'label' => 'Contact No', 'rules' => 'required'
            ],
            'd_address' => [
                'label' => 'Address', 'rules' => 'required'
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['d_name'])) {
                $session->setFlashdata('name_error', $errors['d_name']);
            }
            if (isset($errors['d_contact'])) {
                $session->setFlashdata('contact_error', $errors['d_contact']);
            }
            if (isset($errors['d_address'])) {
                $session->setFlashdata('address_error', $errors['d_address']);
            }
            return redirect()->to('/dairy/create/');
        }

        $user_id = $session->get('user_id');
        //print_r($user_id); die;
        $data = [
            'dairy_name' => $d_name,
            'dairy_mobile' => $d_contact,
            'dairy_address ' => $d_address,
            'created_by' => $user_id,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $dairyModel = new DairyModel();
        $result = $dairyModel->addData($data);

        if ($result) {
            $session->setFlashdata('success', 'Dairy Details Added Successfully');
            return redirect()->to('/dairy/view');
        }
    }

    public function viewData()
    {
        $data['page_title'] = 'Branch';
        $dairyModel = new DairyModel();
        $data['data'] = $dairyModel->getData();
        return view('admin/dairy/viewdairy', $data);
    }

    public function editData($id)
    {
        $data['page_title'] = 'Branch';
        $dairyModel = new DairyModel();
        $data['data'] = $dairyModel->getDataById($id);
        return view('admin/dairy/editdairy', $data);
    }

    public function updateData($id)
    {
        $session = session();
        $d_name = $this->request->getPost('d_name');
        $d_contact = $this->request->getPost('d_contact');
        $d_address = $this->request->getPost('d_address');

        $rules = [
            'd_name' => [
                'label' => 'Name',
                'rules' => 'required'
            ],
            'd_contact' => [
                'label' => 'Contact No', 'rules' => 'required'
            ],
            'd_address' => [
                'label' => 'Address', 'rules' => 'required'
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['d_name'])) {
                $session->setFlashdata('name_error', $errors['d_name']);
            }
            if (isset($errors['d_contact'])) {
                $session->setFlashdata('contact_error', $errors['d_contact']);
            }
            if (isset($errors['d_address'])) {
                $session->setFlashdata('address_error', $errors['d_address']);
            }
            return redirect()->to('/dairy/edit/' . $id);
        }

        $user_id = $session->get('user_id');
        //print_r($user_id); die;
        $data = [
            'dairy_name' => $d_name,
            'dairy_mobile' => $d_contact,
            'dairy_address ' => $d_address,
            'modified_by' => $user_id,
            'modified_at' => date('Y-m-d H:i:s')
        ];

        $dairyModel = new DairyModel();
        $result = $dairyModel->updateData($id, $data);

        if ($result) {
            $session->setFlashdata('success', 'Dairy Details updated Successfully');
            return redirect()->to('/dairy/view');
        }
    }

    public function deleteData($id)
    {
        $dairyModel = new DairyModel();
        $result = $dairyModel->deleteData($id);
        $session = session();

        if ($result) {
            $session->setFlashdata('success', 'Dairy deleted Successfully');
            return redirect()->to('dairy/view');
        }
    }
}
