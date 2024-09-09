<?php

namespace App\Controllers;

use App\Models\AdvanceModel;

class Advance extends BaseController
{
    public function Create()
    {
        $data['page_title'] = 'Advance ';
        return view('admin/advance/addadvance', $data);
    }

    public function getFarmerResult()
    {
        $userCode = $this->request->getPost('user_code');
        //echo $userCode;exit;
        $advanceModel = new AdvanceModel();
        $result = $advanceModel->search($userCode);
        //print_r($result);exit;
        if ($result) {
            $response = [
                'id' => $result->id,
                'name' => $result->user_name,
                'mobile' => $result->user_mobile,
            ];
        } else {
            $response = ['error' => 'User not found'];
        }
        echo json_encode($response);
    }

    public function addData()
    {
        $session = session();
        $f_id = $this->request->getPost('id');
        $contact = $this->request->getPost('contact');
        $date = $this->request->getPost('date');
        $amount = $this->request->getPost('amount');
        $interest_rate = $this->request->getPost('interest_rate');
        $comment = $this->request->getPost('comment');

        $rules = [
            'date' => [
                'label' => 'Date',
                'rules' => 'required'
            ],
            'amount' => [
                'label' => 'Amount',
                'rules' => 'required'
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['date'])) {
                $session->setFlashdata('date_error', $errors['date']);
            }
            if (isset($errors['amount'])) {
                $session->setFlashdata('amount_error', $errors['amount']);
            }
            return redirect()->to('/advance/create/');
        }
        $user_id = $session->get('user_id');
        $advanceModel = new AdvanceModel();

        $lastid = $advanceModel->getLastId();
        //print_r($lastid);die;
        $ref_code = $lastid->total_adv + 1;
        $refrence_code = 'ADV' . date('Y') . '' . date('m') . 0 . $ref_code;
        $data = [
            'ref_code' => $refrence_code,
            'farmer_id' => $f_id,
            'farmer_mobile' => $contact,
            'date' => $date,
            'amount' => $amount,
            'interest_rate' => $interest_rate,
            'comment' => $comment,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $user_id
        ];

        $result = $advanceModel->addData($data);
        if ($result) {
            $prevAmount = $advanceModel->getPrevAmount($refrence_code);
           // print_r($prevAmount);exit;
            if (!$prevAmount) {
                $prevAmount = 0;
            }
            $lastid = $advanceModel->getLastTransId();
            $trans_code = $lastid->total_id + 1;
            $trans_data = [
                'ref_id' => $refrence_code,
                'trans_code' => 'TRANS' . date('Y') . '' . date('m') . 0 . $trans_code,
                'trans_type' => 'debit',
                'amount' => $amount,
                'prev_amount' => $prevAmount,
                'trans_date' => date('Y-m-d'),
                'status' => 'paid',
                'purpose' => 'advance',
                'created_by' => $user_id,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $result_2 = $advanceModel->addTransData($trans_data);
            if ($result_2) {
                $session->setFlashdata('success', 'Advance Added Successfully');
                return redirect()->to('/advance/view');
            }
        }
        
    }

    public function viewData()
    {
        $data['page_title'] = 'Advance';
        $advanceModel = new AdvanceModel();
        $data['data'] = $advanceModel->getData();
        return view('admin/advance/viewadvance', ['page_title' => $data['page_title'], 'data' => $data['data']]);
    }

    public function editData($id)
    {
        $data['page_title'] = ' Advance';
        $advanceModel = new AdvanceModel();
        $data['data'] = $advanceModel->getDataById($id);
        return view('admin/advance/editadvance', $data);
    }

    public function updateData($id)
    {
        $session = session();
        $f_id = $this->request->getPost('id');
        $contact = $this->request->getPost('contact');
        $date = $this->request->getPost('date');
        $amount = $this->request->getPost('amount');
        $interest_rate = $this->request->getPost('interest_rate');
        $comment = $this->request->getPost('comment');

        $rules = [
            'date' => [
                'label' => 'Date',
                'rules' => 'required'
            ],
            'amount' => [
                'label' => 'Amount',
                'rules' => 'required'
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['date'])) {
                $session->setFlashdata('date_error', $errors['date']);
            }
            if (isset($errors['amount'])) {
                $session->setFlashdata('amount_error', $errors['amount']);
            }
            return redirect()->to('/advance/edit/' . $id);
        }
        $user_id = $session->get('user_id');
        $advanceModel = new AdvanceModel();
        $code = $advanceModel->getDataById($id);
        $refrence_code = $code->ref_code;
        //echo $refrence_code;die;
        $data = [
            'ref_code' => $refrence_code,
            'farmer_id' => $f_id,
            'farmer_mobile' => $contact,
            'date' => $date,
            'amount' => $amount,
            'interest_rate' => $interest_rate,
            'comment' => $comment,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $user_id
        ];

        $result = $advanceModel->updateData($id, $data);

        $prevAmount = $advanceModel->getPrevAmount($refrence_code);
        //print_r($prevAmount);
        //exit;
        if (!$prevAmount) {
            $prevAmount = 0;
        }
        $lastid = $advanceModel->getLastTransId();
        $trans_code = $lastid->total_id + 1;
        $trans_data = [
            'ref_id' => $refrence_code,
            'trans_code' => 'TRANS' . date('Y') . '' . date('m') . 0 . $trans_code,
            'trans_type' => 'debit',
            'amount' => $amount,
            'prev_amount' => $prevAmount,
            'trans_date' => date('Y-m-d'),
            'status' => 'paid',
            'purpose' => 'advance edit',
            'created_by' => $user_id,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $result_2 = $advanceModel->addTransData($trans_data);
        if ($result_2) {
            $session->setFlashdata('success', 'Advance Updated Successfully');
            return redirect()->to('/advance/view');
        }
    }

    public function deleteData($id)
    {
        $advanceModel = new AdvanceModel();
        $result = $advanceModel->deleteData($id);
        $session = session();

        if ($result) {
            $session->setFlashdata('success', 'Advance deleted Successfully');
            return redirect()->to('advance/view');
        }
    }

    public function CollectData($ref_id)
    {
        $data['page_title'] = 'Advance';
        $data['ref_id'] = $ref_id;
        return view('admin/advance/collect', $data);
    }

    public function addCollectData()
    {
        $session = session();
        $ref_id = $this->request->getPost('ref_id');
        $amount = $this->request->getPost('amount');
        $comment = $this->request->getPost('comment');

        $rules = [
            'amount' => [
                'label' => 'Amount',
                'rules' => 'required'
            ],
        ];
        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['amount'])) {
                $session->setFlashdata('amount_error', $errors['amount']);
            }
            return redirect()->to('/advance/collect/' . $ref_id);
        }
        $user_id = $session->get('user_id');
        $data = [
            'ref_id' => $ref_id,
            'amount' => $amount,
            'comment' => $comment,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $user_id
        ];

        $advanceModel = new AdvanceModel();
        $result = $advanceModel->addPaymentData($data);

        if ($result) {

            $Amount = $advanceModel->getAmountByRefCode($ref_id);
            $payment = $advanceModel->getPaymentAmount($ref_id);
            $pay_amount = $payment->total_amount;
            $new_amount = $Amount - $pay_amount;
            $data_1 = [
                'amount' => $new_amount,
            ];
            $result_2 =  $advanceModel->updateAmount($ref_id, $data_1);

            $session->setFlashdata('success', 'Payment Added Successfully');
            return redirect()->to('/advance/viewcollect/' . $ref_id);
        }
    }

    public function viewCollectData($ref_code)
    {
        $data['page_title'] = 'Advance';
        $advanceModel = new AdvanceModel();
        $ref_id = $ref_code;
        //echo $ref_id;die;
        $result = $advanceModel->getCollectData($ref_code);
        //print_r($result);die;
        return view('admin/advance/viewcollect', ['page_title' => $data['page_title'], 'result' => $result, 'ref_id' => $ref_id]);
    }

    
}
