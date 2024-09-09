<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customer extends BaseController
{
    public function create()
    {
        $data['page_title'] = 'Customer';
        return view('admin/customer/addcustomer', $data);
    }

    public function addData()
    {
        $session = session();
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $contact = $this->request->getPost('contact');
        $address = $this->request->getPost('address');
        $password = md5($this->request->getVar('password'));

        $rules = [
            'name' => [
                'label' => 'Name',
                'rules' => 'required'
            ],
            'contact' => [
                'label' => 'Contact No', 'rules' => 'required'
            ],
            'address' => [
                'label' => 'Address', 'rules' => 'required'
            ],
            'password' => [
                'label' => 'Password', 'rules' => 'required|max_length[255]|min_length[10]',
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['name'])) {
                $session->setFlashdata('name_error', $errors['name']);
            }
            if (isset($errors['contact'])) {
                $session->setFlashdata('contact_error', $errors['contact']);
            }
            if (isset($errors['address'])) {
                $session->setFlashdata('address_error', $errors['address']);
            }
            if (isset($errors['password'])) {
                $session->setFlashdata('password_error', $errors['password']);
            }
            return redirect()->to('/customer/create/');
        }

        $user_id = $session->get('user_id');
        //print_r($user_id); die;

        $customerModel = new CustomerModel();
        $lastid = $customerModel->getLastId();
        // print_r($lastid);die;
        // $user_code = str_pad(($lastid->id + 1), 3, '0', STR_PAD_RIGHT);
        $user_code = $lastid->total_customer + 1;
        $data = [
            'user_code' => 'CO'. 0 . $user_code,
            'user_name' => $name,
            'user_email' =>$email,
            'user_mobile' => $contact,
            'user_address ' => $address,
            'user_password' => $password,
            'user_role' =>  'customer',
            'created_by' => $user_id,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $result = $customerModel->addData($data);

        if ($result) {
            $session->setFlashdata('success', 'Customer Added Successfully');
            return redirect()->to('/customer/view');
        }
    }

    public function viewData()
    {
        $data['page_title'] = 'Customer';
        $customerModel = new CustomerModel();
        $data['data'] = $customerModel->getData();
        return view('admin/customer/viewcustomer', $data);
    }

    public function editData($id)
    {
        $data['page_title'] = 'Customer';
        $customerModel = new CustomerModel();
        $data['data'] = $customerModel->getDataById($id);
        return view('admin/customer/editcustomer', $data);
    }

    public function updateData($id)
    {
        $session = session();
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $contact = $this->request->getPost('contact');
        $address = $this->request->getPost('address');
        $password = md5($this->request->getVar('password'));

        $rules = [
            'name' => [
                'label' => 'Name',
                'rules' => 'required'
            ],
            'contact' => [
                'label' => 'Contact No', 'rules' => 'required'
            ],
            'address' => [
                'label' => 'Address', 'rules' => 'required'
            ],
            // 'password' => [
            //     'label' => 'Password', 'rules' => 'required|max_length[255]|min_length[10]',
            // ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['name'])) {
                $session->setFlashdata('namerror', $errors['name']);
            }
            if (isset($errors['contact'])) {
                $session->setFlashdata('contact_error', $errors['contact']);
            }
            if (isset($errors['address'])) {
                $session->setFlashdata('address_error', $errors['address']);
            }
            // if (isset($errors['password'])) {
            //     $session->setFlashdata('password_error', $errors['password']);
            // }
            return redirect()->to('/employee/edit/' .$id);
        }

        $user_id = $session->get('user_id');
        //print_r($user_id); die;

        $customerModel = new CustomerModel();
        //$lastid = $employeeModel->getLastId();
        // print_r($lastid);die;
        // $user_code = str_pad(($lastid->id + 1), 3, '0', STR_PAD_RIGHT);
        
        $data = [
            'user_name' => $name,
            'user_mobile' => $contact,
            'user_email' =>$email,
            'user_address ' => $address,
            'user_password' => $password,
            'modified_by' => $user_id,
            'modified_at' => date('Y-m-d H:i:s')
        ];

        $result = $customerModel->updateData($id, $data);

        if ($result) {
            $session->setFlashdata('success', 'Customer Updated Successfully');
            return redirect()->to('/customer/view');
        }
    }

    public function deleteData($id)
    {
        $customerModel = new CustomerModel();
        $result = $customerModel->deleteData($id);
        $session = session();

        if ($result) {
            $session->setFlashdata('success', 'Customer deleted Successfully');
            return redirect()->to('customer/view');
        }
    }
}
