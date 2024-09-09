<?php

namespace App\Controllers;

use App\Models\ExpenseModel;

class Expense extends BaseController
{
    public function create(){
        $data['page_title'] = 'Expense';
        $expenseModel = new ExpenseModel();
        $data['category'] = $expenseModel->getCatData();
        return view ('admin/expense/addexpense', $data);
    }

    public function addData()
    {
        $session = session();
        $category = $this->request->getPost('category');
        $date = $this->request->getPost('date');
        $p_name = $this->request->getPost('p_name');
        $amount = $this->request->getPost('amount');
        $comment = $this->request->getPost('comment');

        $rules = [
            'category' => [
                'label' => 'Category',
                'rules' => 'required'
            ],
            'date' => [
                'label' => 'Date',
                'rules' => 'required'
            ],
            'p_name' => [
                'label' => 'Party Name', 'rules' => 'required'
            ],
            'amount' => [
                'label' => 'Amount', 'rules' => 'required'
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['category'])) {
                $session->setFlashdata('cat_error', $errors['category']);
            }
            if (isset($errors['date'])) {
                $session->setFlashdata('date_error', $errors['date']);
            }
            if (isset($errors['p_name'])) {
                $session->setFlashdata('name_error', $errors['p_name']);
            }
            if (isset($errors['amount'])) {
                $session->setFlashdata('amount_error', $errors['amount']);
            }
            return redirect()->to('/expense/create/');
        }

        $user_id = $session->get('user_id');
        //print_r($user_id); die;
        $data = [
            'category_id' => $category,
            'date' => $date,
            'party_name ' => $p_name,
            'amount' => $amount,
            'comment' => $comment,
            'created_by' => $user_id,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $expenseModel = new ExpenseModel();
        $result = $expenseModel->addData($data);

        if ($result) {
            $session->setFlashdata('success', 'Expense Added Successfully');
            return redirect()->to('/expense/view');
        }
    }

    public function viewData()
    {
        $data['page_title'] = 'Expense';
        $expenseModel = new ExpenseModel();
        $data['data'] = $expenseModel->getData();
        return view('admin/expense/viewexpense', $data);
    }

    public function editData($id)
    {
        $data['page_title'] = 'Expense';
        $expenseModel = new ExpenseModel();
        $data['category'] = $expenseModel->getCatData();
        $data['data'] = $expenseModel->getDataById($id);
        return view('admin/expense/editexpense', $data);
    }

    public function updateData($id)
    {
        $session = session();
        $category = $this->request->getPost('category');
        $date = $this->request->getPost('date');
        $p_name = $this->request->getPost('p_name');
        $amount = $this->request->getPost('amount');
        $comment = $this->request->getPost('comment');

        $rules = [
            'category' => [
                'label' => 'Category',
                'rules' => 'required'
            ],
            'date' => [
                'label' => 'Date',
                'rules' => 'required'
            ],
            'p_name' => [
                'label' => 'Party Name', 'rules' => 'required'
            ],
            'amount' => [
                'label' => 'Amount', 'rules' => 'required'
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['category'])) {
                $session->setFlashdata('cat_error', $errors['category']);
            }
            if (isset($errors['date'])) {
                $session->setFlashdata('date_error', $errors['date']);
            }
            if (isset($errors['p_name'])) {
                $session->setFlashdata('name_error', $errors['p_name']);
            }
            if (isset($errors['amount'])) {
                $session->setFlashdata('amount_error', $errors['amount']);
            }
            return redirect()->to('/expense/edit/'.$id);
        }

        $user_id = $session->get('user_id');
        //print_r($user_id); die;
        $data = [
            'category_id' => $category,
            'date' => $date,
            'party_name ' => $p_name,
            'amount' => $amount,
            'comment' => $comment,
            'modified_by' => $user_id,
            'modified_at' => date('Y-m-d H:i:s')
        ];

        $expenseModel = new ExpenseModel();
        $result = $expenseModel->updateData($id, $data);

        if ($result) {
            $session->setFlashdata('success', 'Expense Updated Successfully');
            return redirect()->to('/expense/view');
        }
    }

    public function deleteData($id)
    {
        $expenseModel = new ExpenseModel();
        $result = $expenseModel->deleteData($id);
        $session = session();

        if ($result) {
            $session->setFlashdata('success', 'Expense deleted Successfully');
            return redirect()->to('expense/view');
        }
    }
}