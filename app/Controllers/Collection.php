<?php

namespace App\Controllers;

use App\Models\CollectionModel;

class Collection extends BaseController
{
    public function create(){
        $data['page_title'] = 'Collection Boy';
        $collectionModel = new CollectionModel();
        $data['branches'] = $collectionModel->getBranchData();
        return view ('admin/collection-boy/addcol-boy', $data);
    }

    public function addData()
    {
        $session = session();
        $branch = $this->request->getPost('branch');
        $c_name = $this->request->getPost('c_name');
        $c_email = $this->request->getPost('c_email');
        $c_contact = $this->request->getPost('c_contact');
        $c_address = $this->request->getPost('c_address');
        $c_password = md5($this->request->getVar('c_password'));

        $rules = [
            'branch' => [
                'label' => 'Branch',
                'rules' => 'required'
            ],
            'c_name' => [
                'label' => 'Name',
                'rules' => 'required'
            ],
            'c_contact' => [
                'label' => 'Contact No', 'rules' => 'required'
            ],
            'c_address' => [
                'label' => 'Address', 'rules' => 'required'
            ],
            'c_password' => [
                'label' => 'Password', 'rules' => 'required|max_length[255]|min_length[10]',
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['branch'])) {
                $session->setFlashdata('branch_error', $errors['branch']);
            }
            if (isset($errors['c_name'])) {
                $session->setFlashdata('name_error', $errors['c_name']);
            }
            if (isset($errors['c_contact'])) {
                $session->setFlashdata('contact_error', $errors['c_contact']);
            }
            if (isset($errors['c_address'])) {
                $session->setFlashdata('address_error', $errors['c_address']);
            }
            if (isset($errors['c_password'])) {
                $session->setFlashdata('password_error', $errors['c_password']);
            }
            return redirect()->to('/collection/create/');
        }

        $user_id = $session->get('user_id');
        //print_r($user_id); die;

        $collectionModel = new CollectionModel();
        $lastid = $collectionModel->getLastId();
        //print_r($lastid);die;

        $user_code = $lastid->total_col_boy + 1;
        $data = [
            'user_code' => 'C' . 0 . $user_code,
            'user_name' => $c_name,
            'user_email' => $c_email,
            'user_mobile' => $c_contact,
            'user_address ' => $c_address,
            'user_password' => $c_password,
            'user_role' =>  'col_boy',
            'created_by' => $user_id,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $last_insert_id = $collectionModel->addData($data);
        //echo $last_insert_id;exit;
        if ($last_insert_id) {
            $branch_data = [
                'user_id' => $last_insert_id,
                'branch_id' => $branch
            ];
            $result_1 = $collectionModel->addBranchData($branch_data);
    
            if ($result_1) {
                $session->setFlashdata('success', 'Collection Boy Added Successfully');
                return redirect()->to('/collection/view');
            } 
        }
    }

    public function viewData()
    {
        $data['page_title'] = 'Collection Boy';
        $collectionModel = new CollectionModel();
        $data['branches'] = $collectionModel->getBranchData();
        $data['data'] = $collectionModel->getData();
        return view('admin/collection-boy/viewcol-boy', $data);
    }

    public function editData($id)
    {
        $data['page_title'] = 'Collection Boy';
        $collectionModel = new CollectionModel();
        $data['branches'] = $collectionModel->getBranchData();
        $data['data'] = $collectionModel->getDataById($id);

        //echo "<pre>";print_r($data['data']); exit;
        return view('admin/collection-boy/editcol-boy',  $data);
    }

    public function updateData($id)
    {
        $session = session();
        $branch = $this->request->getPost('branch');
        $c_name = $this->request->getPost('c_name');
        $c_email = $this->request->getPost('c_email');
        $c_contact = $this->request->getPost('c_contact');
        $c_address = $this->request->getPost('c_address');
        $c_password = md5($this->request->getVar('c_password'));

        $rules = [
            'branch' => [
                'label' => 'Branch',
                'rules' => 'required'
            ],
            'c_name' => [
                'label' => 'Name',
                'rules' => 'required'
            ],
            'c_contact' => [
                'label' => 'Contact No', 'rules' => 'required'
            ],
            'c_address' => [
                'label' => 'Address', 'rules' => 'required'
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['branch'])) {
                $session->setFlashdata('branch_error', $errors['branch']);
            }
            if (isset($errors['c_name'])) {
                $session->setFlashdata('name_error', $errors['c_name']);
            }
            if (isset($errors['c_contact'])) {
                $session->setFlashdata('contact_error', $errors['c_contact']);
            }
            if (isset($errors['c_address'])) {
                $session->setFlashdata('address_error', $errors['c_address']);
            }
            return redirect()->to('/collection/edit/'. $id);
        }

        $user_id = $session->get('user_id');
        //print_r($user_id); die;

        $collectionModel = new CollectionModel();
        //print_r($lastid);die;

        //$user_code = $lastid->total_col_boy + 1;
        $data = [
            'user_name' => $c_name,
            'user_mobile' => $c_contact,
            'user_email' => $c_email,
            'user_address ' => $c_address,
            'user_password' => $c_password,
            'modified_by' => $user_id,
            'modified_at' => date('Y-m-d H:i:s')
        ];
        $result = $collectionModel->updateData($id, $data);

        //$last_insert_id = $collectionModel->addData($data);
        //echo $last_insert_id;exit;
        if ($result) {
            $branch_data = [
                'branch_id' => $branch
            ];
            $result_1 = $collectionModel->updateBranchData($id, $branch_data);
    
            if ($result_1) {
                $session->setFlashdata('success', 'Collection Boy Added Successfully');
                return redirect()->to('/collection/view');
            } 
        }
    }

    public function deleteData($id)
    {
        $collectionModel = new CollectionModel();
        $result = $collectionModel->deleteData($id);
        $session = session();

        if ($result) {
            $result_1 = $collectionModel->deleteBranchData($id);
            if ($result_1) {
                $session->setFlashdata('success', 'Collection Boy Deleted Successfully');
                return redirect()->to('/collection/view');
            } 
        }
    }
}