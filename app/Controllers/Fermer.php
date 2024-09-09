<?php

namespace App\Controllers;

use App\Models\FermerModel;

class Fermer extends BaseController
{
    public function create(){
        $data['page_title'] = 'Farmer';
        return view ('admin/fermers/addfermer', $data);
    }

    public function addData()
    {
        $session = session();
        $f_name = $this->request->getPost('f_name');
        $f_email = $this->request->getPost('f_email');
        $f_contact = $this->request->getPost('f_contact');
        $f_address = $this->request->getPost('f_address');
        $f_adhar = $this->request->getPost('f_adhar');
        $f_password = md5($this->request->getVar('f_contact'));

        $rules = [
            'f_name' => [
                'label' => 'Name',
                'rules' => 'required'
            ],
            'f_contact' => [
                'label' => 'Contact No', 'rules' => 'required'
            ],
            'f_address' => [
                'label' => 'Address', 'rules' => 'required'
            ],
            // 'f_adhar' => [
            //     'label' => 'Aadhar No', 'rules' => 'required'
            // ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['f_name'])) {
                $session->setFlashdata('name_error', $errors['f_name']);
            }
            if (isset($errors['f_contact'])) {
                $session->setFlashdata('contact_error', $errors['f_contact']);
            }
            if (isset($errors['f_address'])) {
                $session->setFlashdata('address_error', $errors['f_address']);
            }
            // if (isset($errors['f_adhar'])) {
            //     $session->setFlashdata('adhar_error', $errors['f_adhar']);
            // }
            return redirect()->to('/fermer/create/');
        }

        $user_id = $session->get('user_id');
        //print_r($user_id); die;

        $fermerModel = new FermerModel();
        $lastid = $fermerModel->getLastId();
        // print_r($lastid);die;
        // $user_code = str_pad(($lastid->id + 1), 3, '0', STR_PAD_RIGHT);
        $user_code = $lastid->total_farmer + 1;
        $data = [
            'user_code' => 'F'. 0 . $user_code,
            'user_name' => $f_name,
            'user_email' => $f_email,
            'user_mobile' => $f_contact,
            'user_address ' => $f_address,
            'user_aadhar' => $f_adhar,
            'user_password' => $f_password,
            'user_role' =>  'farmer',
            'created_by' => $user_id,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $result = $fermerModel->addData($data);

        if ($result) {
            $session->setFlashdata('success', 'Employee Added Successfully');
            return redirect()->to('/fermer/view');
        }
    }

    public function viewData()
    {
        $data['page_title'] = 'Farmer';
        $fermerModel = new FermerModel();
        $data['data'] = $fermerModel->getData();
        return view('admin/fermers/viewfermer', $data);
    }

    public function editData($id)
    {
        $data['page_title'] = 'Farmer';
        $fermerModel = new FermerModel();
        $data['data'] = $fermerModel->getDataById($id);
        return view('admin/fermers/editfermer', $data);
    }

    public function updateData($id)
    {
        $session = session();
        $f_name = $this->request->getPost('f_name');
        $f_email = $this->request->getPost('f_email');
        $f_contact = $this->request->getPost('f_contact');
        $f_address = $this->request->getPost('f_address');
        $f_adhar = $this->request->getPost('f_adhar');

        $rules = [
            'f_name' => [
                'label' => 'Name',
                'rules' => 'required'
            ],
            'f_contact' => [
                'label' => 'Contact No', 'rules' => 'required'
            ],
            'f_address' => [
                'label' => 'Address', 'rules' => 'required'
            ],
            // 'f_adhar' => [
            //     'label' => 'Aadhar No', 'rules' => 'required'
            // ],
            
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['f_name'])) {
                $session->setFlashdata('name_error', $errors['f_name']);
            }
            if (isset($errors['f_contact'])) {
                $session->setFlashdata('contact_error', $errors['f_contact']);
            }
            if (isset($errors['f_address'])) {
                $session->setFlashdata('address_error', $errors['f_address']);
            }
            // if (isset($errors['f_adhar'])) {
            //     $session->setFlashdata('adhar_error', $errors['f_adhar']);
            // }
            
            return redirect()->to('/fermer/edit/' .$id);
        }

        $user_id = $session->get('user_id');
        //print_r($user_id); die;

        $fermerModel = new FermerModel();
               
        $data = [
            'user_name' => $f_name,
            'user_email' => $f_email,
            'user_mobile' => $f_contact,
            'user_address ' => $f_address,
            'user_aadhar' => $f_adhar,
            'modified_by' => $user_id,
            'modified_at' => date('Y-m-d H:i:s')
        ];

        $result = $fermerModel->updateData($id, $data);

        if ($result) {
            $session->setFlashdata('success', 'Farmer Updated Successfully');
            return redirect()->to('/fermer/view');
        }
    }

    public function deleteData($id)
    {
        $fermerModel = new FermerModel();
        $result = $fermerModel->deleteData($id);
        $session = session();

        if ($result) {
            $session->setFlashdata('success', 'Farmer deleted Successfully');
            return redirect()->to('fermer/view');
        }
    }

    public function viewBank($id)
    {
        $data['page_title'] = 'Farmer';
        $fermerModel = new FermerModel();
        $data['data'] = $fermerModel->getBankData($id);
        return view('admin/fermers/viewbank', $data);
    }
}