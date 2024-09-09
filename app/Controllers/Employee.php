<?php

namespace App\Controllers;

use App\Models\EmployeeModel;

class Employee extends BaseController
{
    public function create()
    {
        $data['page_title'] = 'Employee';
        return view('admin/employee/addemployee', $data);
    }

    public function addData()
    {
        $session = session();
        $e_name = $this->request->getPost('e_name');
        $e_email = $this->request->getPost('e_email');
        $e_contact = $this->request->getPost('e_contact');
        $e_address = $this->request->getPost('e_address');
        $e_password = md5($this->request->getVar('e_password'));

        $rules = [
            'e_name' => [
                'label' => 'Name',
                'rules' => 'required'
            ],
            'e_contact' => [
                'label' => 'Contact No', 'rules' => 'required'
            ],
            'e_address' => [
                'label' => 'Address', 'rules' => 'required'
            ],
            'e_password' => [
                'label' => 'Password', 'rules' => 'required|max_length[255]|min_length[10]',
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['e_name'])) {
                $session->setFlashdata('name_error', $errors['e_name']);
            }
            if (isset($errors['e_contact'])) {
                $session->setFlashdata('contact_error', $errors['e_contact']);
            }
            if (isset($errors['e_address'])) {
                $session->setFlashdata('address_error', $errors['e_address']);
            }
            if (isset($errors['e_password'])) {
                $session->setFlashdata('password_error', $errors['e_password']);
            }
            return redirect()->to('/employee/create/');
        }

        $user_id = $session->get('user_id');
        //print_r($user_id); die;

        $employeeModel = new EmployeeModel();
        $lastid = $employeeModel->getLastId();
        // print_r($lastid);die;
        // $user_code = str_pad(($lastid->id + 1), 3, '0', STR_PAD_RIGHT);
        $user_code = $lastid->total_employee + 1;
        $data = [
            'user_code' => 'E'. 0 . $user_code,
            'user_name' => $e_name,
            'user_email' =>$e_email,
            'user_mobile' => $e_contact,
            'user_address ' => $e_address,
            'user_password' => $e_password,
            'user_role' =>  'emp',
            'created_by' => $user_id,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $result = $employeeModel->addData($data);

        if ($result) {
            $session->setFlashdata('success', 'Employee Added Successfully');
            return redirect()->to('/employee/view');
        }
    }

    public function viewData()
    {
        $data['page_title'] = 'Employee';
        $employeeModel = new EmployeeModel();
        $data['data'] = $employeeModel->getData();
        return view('admin/employee/viewemployee', $data);
    }

    public function editData($id)
    {
        $data['page_title'] = 'Employee';
        $employeeModel = new EmployeeModel();
        $data['data'] = $employeeModel->getDataById($id);
        return view('admin/employee/editemployee', $data);
    }

    public function updateData($id)
    {
        $session = session();
        $e_name = $this->request->getPost('e_name');
        $e_email = $this->request->getPost('e_email');
        $e_contact = $this->request->getPost('e_contact');
        $e_address = $this->request->getPost('e_address');
        $e_password = md5($this->request->getVar('e_password'));

        $rules = [
            'e_name' => [
                'label' => 'Name',
                'rules' => 'required'
            ],
            'e_contact' => [
                'label' => 'Contact No', 'rules' => 'required'
            ],
            'e_address' => [
                'label' => 'Address', 'rules' => 'required'
            ],
            // 'e_password' => [
            //     'label' => 'Password', 'rules' => 'required|max_length[255]|min_length[10]',
            // ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['e_name'])) {
                $session->setFlashdata('name_error', $errors['e_name']);
            }
            if (isset($errors['e_contact'])) {
                $session->setFlashdata('contact_error', $errors['e_contact']);
            }
            if (isset($errors['e_address'])) {
                $session->setFlashdata('address_error', $errors['e_address']);
            }
            // if (isset($errors['e_password'])) {
            //     $session->setFlashdata('password_error', $errors['e_password']);
            // }
            return redirect()->to('/employee/edit/' .$id);
        }

        $user_id = $session->get('user_id');
        //print_r($user_id); die;

        $employeeModel = new EmployeeModel();
        //$lastid = $employeeModel->getLastId();
        // print_r($lastid);die;
        // $user_code = str_pad(($lastid->id + 1), 3, '0', STR_PAD_RIGHT);
        
        $data = [
            'user_name' => $e_name,
            'user_mobile' => $e_contact,
            'user_email' =>$e_email,
            'user_address ' => $e_address,
            'user_password' => $e_password,
            'modified_by' => $user_id,
            'modified_at' => date('Y-m-d H:i:s')
        ];

        $result = $employeeModel->updateData($id, $data);

        if ($result) {
            $session->setFlashdata('success', 'Employee Updated Successfully');
            return redirect()->to('/employee/view');
        }
    }

    public function deleteData($id)
    {
        $employeeModel = new EmployeeModel();
        $result = $employeeModel->deleteData($id);
        $session = session();

        if ($result) {
            $session->setFlashdata('success', 'Employee deleted Successfully');
            return redirect()->to('employee/view');
        }
    }
}
