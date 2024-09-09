<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class Category extends BaseController
{
    public function create()
    {
        $data['page_title'] = 'Expense Category';
        return view('admin/ex_category/addcategory',$data);
    }

    public function addData()
    {
        $session = session();
        $name = $this->request->getPost('cat_name');
        $status = $this->request->getPost('status');

        $rules = [
            'cat_name' => [
                'label' => 'Category Name',
                'rules' => 'required'
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['cat_name'])) {
                $session->setFlashdata('name_error', $errors['cat_name']);
            }
            return redirect()->to('/category/create/');
        }

        $user_id = $session->get('user_id');
        //print_r($user_id); die;
        $data = [
            'name' => $name,
            'status' => $status,
            'created_by' => $user_id,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $categoryModel = new CategoryModel();
        $result = $categoryModel->addData($data);

        if ($result) {
            $session->setFlashdata('success', 'Category Added Successfully');
            return redirect()->to('/category/view');
        }
    }

    public function viewData()
    {
        $data['page_title'] = 'Expense Category';
        $categoryModel = new CategoryModel();
        $data['data'] = $categoryModel->getData();
        return view('admin/ex_category/viewcategory', $data);
    }

    public function editData($id)
    {
        $data['page_title'] = 'Expense Category';
        $categoryModel = new CategoryModel();
        $data['data'] = $categoryModel->getDataById($id);
        return view('admin/ex_category/editcategory', $data);
    }

    public function updateData($id)
    {
        $session = session();
        $name = $this->request->getPost('cat_name');
        $status = $this->request->getPost('status');

        $rules = [
            'cat_name' => [
                'label' => 'Category Name',
                'rules' => 'required'
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['cat_name'])) {
                $session->setFlashdata('name_error', $errors['cat_name']);
            }
            return redirect()->to('/category/edit/'.$id);
        }

        $user_id = $session->get('user_id');
        //print_r($user_id); die;
        $data = [
            'name' => $name,
            'status' => $status,
            'modified_by' => $user_id,
            'modified_at' => date('Y-m-d H:i:s')
        ];

        $categoryModel = new CategoryModel();
        $result = $categoryModel->updateData($id, $data);

        if ($result) {
            $session->setFlashdata('success', 'Category Updated Successfully');
            return redirect()->to('/category/view');
        }
    }

    public function deleteData($id)
    {
        $categoryModel = new CategoryModel();
        $result = $categoryModel->deleteData($id);
        $session = session();

        if ($result) {
            $session->setFlashdata('success', 'Category deleted Successfully');
            return redirect()->to('category/view');
        }
    }
}