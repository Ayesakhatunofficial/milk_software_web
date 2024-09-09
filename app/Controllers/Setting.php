<?php

namespace App\Controllers;

use App\Models\SettingModel;

class Setting extends BaseController
{
    public function create()
    {
        $data['page_title'] = 'Settings';
        $settingModel = new SettingModel();
        $data['data'] = $settingModel->getData();
        return view('admin/setting/setting', $data);
    }

    public function updateData()
    {
        $session = session();
        $name = $this->request->getVar('name');
        $contact = $this->request->getVar('contact');
        $address = $this->request->getVar('address');

        $rules = [
            'name' => [
                'label' => 'Name',
                'rules' => 'required'
            ],
            'contact' => [
                'label' => 'Contact No.', 'rules' => 'required'
            ],
            'address' => [
                'label' => 'Address', 'rules' => 'required'
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
            return redirect()->to('/setting/create/');
        }
        $user_id = $session->get('user_id');
        $settingModel = new SettingModel();
        $data = [
            'name' => $name,
            'mobile_no' => $contact,
            'address' => $address,
            'modified_at' => date('Y-m-d'),
            'modified_by' => $user_id
        ];

        $result = $settingModel->updateData($data);
        if ($result) {
            $session->setFlashdata('success', 'Data Updated Successfully');
            return redirect()->to('/setting/create');
        }
    }
}
