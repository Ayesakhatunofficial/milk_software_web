<?php

namespace App\Controllers;

use App\Models\ShiftModel;

class Shift extends BaseController
{
    public function create()
    {
        $data['page_title'] = 'Shift';
        return view('admin/shift/addshift', $data);
    }

    public function addData(){
        $session = session();
        $s_name = $this->request->getPost('s_name');
        $start_time = $this->request->getPost('start_time');
        $end_time = $this->request->getPost('end_time');

        $rules = [
            's_name' => [
                'label' => 'Shift Name',
                'rules' => 'required'
            ],
            'start_time' => [
                'label' => 'Start Time', 'rules' => 'required'
            ],
            'end_time' => [
                'label' => 'End Time', 'rules' => 'required'
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['s_name'])) {
                $session->setFlashdata('name_error', $errors['s_name']);
            }
            if (isset($errors['start_time'])) {
                $session->setFlashdata('start_error', $errors['start_time']);
            }
            if (isset($errors['end_time'])) {
                $session->setFlashdata('end_error', $errors['end_time']);
            }
            return redirect()->to('/shift/create/');
        }
        $user_id = $session->get('user_id');
        $shiftModel = new ShiftModel();

        $data = [
            'shift_name' => $s_name,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'created_by' => $user_id,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $result = $shiftModel->addData($data);
        if ($result) {
            $session->setFlashdata('success', 'Shift Added Successfully');
            return redirect()->to('/shift/view');
        }
    }

    public function viewData(){
        $data['page_title'] = 'Shift';
        $shiftModel = new ShiftModel();
        $data['data'] = $shiftModel->getData();
        return view('admin/shift/viewshift', $data);
    }

    public function editData($id){
        $data['page_title'] = 'Shift';
        $shiftModel = new ShiftModel();
        $data['data'] = $shiftModel->getDataById($id);
        return view('admin/shift/editshift', $data);
    }

    public function updateData($id){
        $session = session();
        $s_name = $this->request->getPost('s_name');
        $start_time = $this->request->getPost('start_time');
        $end_time = $this->request->getPost('end_time');

        $rules = [
            's_name' => [
                'label' => 'Shift Name',
                'rules' => 'required'
            ],
            'start_time' => [
                'label' => 'Start Time', 'rules' => 'required'
            ],
            'end_time' => [
                'label' => 'End Time', 'rules' => 'required'
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['s_name'])) {
                $session->setFlashdata('name_error', $errors['s_name']);
            }
            if (isset($errors['start_time'])) {
                $session->setFlashdata('start_error', $errors['start_time']);
            }
            if (isset($errors['end_time'])) {
                $session->setFlashdata('end_error', $errors['end_time']);
            }
            return redirect()->to('/shift/edit/' .$id);
        }
        $user_id = $session->get('user_id');
        $shiftModel = new ShiftModel();

        $data = [
            'shift_name' => $s_name,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'modified_by' => $user_id,
            'modified_at' => date('Y-m-d H:i:s')
        ];

        $result = $shiftModel->updateData($id, $data);
        if ($result) {
            $session->setFlashdata('success', 'Shift Updated Successfully');
            return redirect()->to('/shift/view');
        }
    }

    public function deleteData($id){
        $session = session();
        $shiftModel = new ShiftModel();
        $result = $shiftModel->deleteData($id);
        if ($result) {
            $session->setFlashdata('success', 'Shift Deleted Successfully');
            return redirect()->to('/shift/view');
        }
    }

}