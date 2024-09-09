<?php

namespace App\Controllers;

use App\Models\PaymentModel;

class Payment extends BaseController
{
    public function viewCustData()
    {
        $data['page_title'] = 'Customer Payment';
        $paymentModel = new PaymentModel();
        $data['data'] = $paymentModel->getCustData();
        // echo "<pre>"; print_r($data['data']);die;
        return view('admin/payment/viewcustpay', $data);
    }

    public function CustCollect($customer_id)
    {
        $data['page_title'] = 'Customer Due Collect';
        $paymentModel = new PaymentModel();
        $data['data'] = $paymentModel->getCustDataById($customer_id);
        $data['cust_id'] = $customer_id;
        $data['invoice'] = $paymentModel->getInvoice($customer_id);
        // echo "<pre>"; print_r($data['invoice']); die;
        return view('admin/payment/custcollect', $data);
    }

    public function calculateSum()
    {
        $selectedValues = $this->request->getVar('selectedValues');
        $cust_id = $this->request->getVar('cust_id');
        //print_r($selectedValues); die;
        $s_values = json_decode($selectedValues, true);
        //print_r($s_values); die;

        $sum = 0;
        $paymentModel = new PaymentModel();

        if (!empty($s_values)) {
            foreach ($s_values as $value) {
                $amount = $paymentModel->getAmount($value);
                //echo $due_amount->due_amount;die;
                $dueAmount = $amount->due_amount;
                $sum += $dueAmount;
            }
            //echo $sum;die;
            // if (!empty($paid_amount)) {
            //     $sum = $sum - $paid_amount;
            // }
        }else{
            $data = $paymentModel->getCustDataById($cust_id);
            $total_amount = $data->t_amount;
            $sum = $sum + $total_amount;
        }
        return json_encode(['totalDue' => $sum]);
    }

    public function addCustPayData()
    {
        $session = session();
        $cust_id = $this->request->getVar('cust_id');
        $total_amount = $this->request->getVar('total_amount');
        $selectedValues = $this->request->getVar('invoice');
        $collect_amount1 = $this->request->getVar('paid_amount');
        $date = $this->request->getVar('date');

        if ($total_amount > $collect_amount1) {
            $due = (float)$total_amount - (float)$collect_amount1;
        } else {
            $due = 0;
        }


        $rules = [
            'paid_amount' => [
                'label' => 'Paid Amount',
                'rules' => 'required|greater_than[0]|less_than_equal_to[' . $total_amount . ']'
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['paid_amount'])) {
                $session->setFlashdata('amount_error', $errors['paid_amount']);
            }
            return redirect()->to('/payment/customer/collect/' . $cust_id);
        }

        $paymentModel = new PaymentModel();
        $invoice_id = $paymentModel->getInvoiceId($cust_id);
        //print_r($invoice_id);die;
        if ($selectedValues == NULL) {
            $selectedValues = $invoice_id;
            // print_r($selectedValues);die;
        }

        $collect_amount = $collect_amount1;

        foreach ($selectedValues as $value) {
            //print_r($value);die;
            if (is_array($value)) {
                $inv_id = $value['id'];
            } else {
                $inv_id = $value;
            }

            $amounts = $paymentModel->getAmount($inv_id);
            $dueAmount = $amounts->due_amount;
            $paidAmount = $amounts->paid_amount;

            $due_amount = 0;
            $paid_amount = 0;

            if ($collect_amount >= $dueAmount) {
                $due_amount = 0;
                $paid_amount = $paidAmount + $dueAmount;
                $collect_amount -= $dueAmount;
            } else {
                $due_amount = $dueAmount - $collect_amount;
                $paid_amount = $paidAmount + $collect_amount;
                $collect_amount = 0;
            }
            if($due_amount == 0){
                $status = 'paid';
            }else{
                $status = 0;
            }
            $result = $paymentModel->updateSalesData($inv_id, $due_amount, $paid_amount, $status);
        }

        $user_id = $session->get('user_id');
        $data = [
            'customer_id' => $cust_id,
            'date' => $date,
            'total_amount' => $total_amount,
            'collect_amount' => $collect_amount1,
            'due' => $due,
            'collected_at' => date('Y-m-d'),
            'collected_by' => $user_id
        ];

        $last_insert_id = $paymentModel->addCustPayData($data);
        if ($last_insert_id) {

            $prevAmount = $paymentModel->getPrevAmount($last_insert_id);

            // print_r($prevAmount);exit;
            if (!$prevAmount) {
                $prevAmount = 0;
            }

            $lastid = $paymentModel->getLastId();
            $trans_code = $lastid->total_id + 1;
            $trans_data = [
                'ref_id' => $last_insert_id,
                'trans_code' => 'TRANS' . date('Y') . '' . date('m') . 0 . $trans_code,
                'trans_type' => 'credit',
                'amount' => $collect_amount1,
                'prev_amount' => $prevAmount,
                'trans_date' => date('Y-m-d'),
                'status' => 'paid',
                'created_by' => $user_id,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $result_1 = $paymentModel->addTransData($trans_data);
            if ($result_1) {
                $session->setFlashdata('success', 'Collection Added Successfully');
                return redirect()->to('/payment/customer/viewCustCollect/' . $cust_id);
            }
        }
    }

    public function viewCustPayData($customer_id)
    {
        $data['page_title'] = 'View Customer Due Collect';
        $paymentModel = new PaymentModel();
        $data['data'] = $paymentModel->getCustCollectData($customer_id);
        return view('admin/payment/viewcustcollect', $data);
    }

    public function viewFarmerData()
    {
        $data['page_title'] = 'Farmer Payment';
        $paymentModel = new PaymentModel();
        $data['data'] = $paymentModel->getFarmerData();
        // echo "<pre>"; print_r($data['data']);die;
        return view('admin/payment/viewfarmerpay', $data);
    }

    public function FarmerPay($farmer_id)
    {
        $data['page_title'] = 'Customer Due Collect';
        $paymentModel = new PaymentModel();
        $data['data'] = $paymentModel->getFarmerDataById($farmer_id);
        $data['farmer_id'] = $farmer_id;
        // $data['invoice'] = $paymentModel->getFarmerInvoice($farmer_id);
        // echo "<pre>"; print_r($data['invoice']); die;
        return view('admin/payment/farmerpay', $data);
    }

    public function getPriceByDate()
    {
        $to_date = $this->request->getVar('to_date');
        $farmer_id = $this->request->getVar('farmer_id');
        $paymentModel = new PaymentModel();
        $priceData = $paymentModel->getPriceByDate($to_date, $farmer_id);
        //print_r($priceData);die;
        $options = '';
        foreach ($priceData as $price) {
            $options .= '<option value="' . $price->id . '">'.date('d-m-y', strtotime($price->date)) . '-INV0' . $price->id . '=>' . $price->due_amount . '</option>';
        }

        $response = [
            'options' => $options,
        ];
        return json_encode($response);
    }

    public function calculateTotal()
    {
        $selectedValues = $this->request->getVar('selectedValues');
        $farmer_id = $this->request->getVar('f_id');
        $s_values = json_decode($selectedValues, true);
        //print_r($s_values); die;

        $sum = 0;
        $paymentModel = new PaymentModel();
        if (!empty($s_values)) {
            foreach ($s_values as $value) {                     
                $amount = $paymentModel->getTotalAmount($value);
                //echo $due_amount->due_amount;die;
                $totalAmount = $amount->due_amount;
                $sum += $totalAmount;
            }
            // //echo $sum;die;        
        }else{
            $data = $paymentModel->getFarmerDataById($farmer_id);
            $total_amount = $data->d_amount;
            $sum = $sum + $total_amount;
        }
        return json_encode(['totalDue' => round($sum, 2)]);
    }

    public function addFarmerPayData()
    {
        $session = session();
        $farmer_id = $this->request->getVar('farmer_id');
        $total_amount = $this->request->getVar('total_amount');
        $selectedValues = $this->request->getVar('invoice');
        $paid_amount1 = $this->request->getVar('paid_amount');
        $date = $this->request->getVar('date');
        $to_date = $this->request->getVar('to_date');

        if ($total_amount > $paid_amount1) {
            $due = (float)$total_amount - (float)$paid_amount1;
        } else {
            $due = 0;
        }


        $rules = [
            'paid_amount' => [
                'label' => 'Paid Amount',
                'rules' => 'required|greater_than[0]|less_than_equal_to[' . $total_amount . ']'
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['paid_amount'])) {
                $session->setFlashdata('amount_error', $errors['paid_amount']);
            }
            return redirect()->to('/payment/farmer/pay/' . $farmer_id);
        }

        $paymentModel = new PaymentModel();
        $invoice_id = $paymentModel->getFarmerInvoiceId($farmer_id);
        //print_r($invoice_id);die;
        if ($selectedValues == NULL) {
            $selectedValues = $invoice_id;
            
        }
        // print_r($selectedValues);die;
        $paid_amount = $paid_amount1;

        foreach ($selectedValues as $value) {
            //print_r($value);die;
            if (is_array($value)) {
                $inv_id = $value['id'];
            } else {
                $inv_id = $value;
            }
             //print_r($inv_id);die;
            $amounts = $paymentModel->getTotalAmount($inv_id);
            $dueAmount = $amounts->due_amount;

            $due_amount = 0;

            if ($paid_amount >= $dueAmount) {
                $due_amount = 0;
                $paid_amount -= $dueAmount;
               

            } else {
                $due_amount = $dueAmount - $paid_amount;
                $paid_amount = 0;
            }
            //echo $paid_amount; die;
            $result = $paymentModel->updateCollectionData($inv_id, $due_amount);
        }

        $user_id = $session->get('user_id');
        $data = [
            'farmer_id' => $farmer_id,
            'date' => $date,
            'to_date' => $to_date,
            'total_amount' => $total_amount,
            'paid_amount' => $paid_amount1,
            'due' => $due,
            'payment_at' => date('Y-m-d'),
            'payment_by' => $user_id
        ];

        $last_insert_id = $paymentModel->addFarmerPayData($data);
        if ($last_insert_id) {

            $prevAmount = $paymentModel->getPrevAmount($last_insert_id);

            // print_r($prevAmount);exit;
            if (!$prevAmount) {
                $prevAmount = 0;
            }

            $lastid = $paymentModel->getLastId();
            $trans_code = $lastid->total_id + 1;
            $trans_data = [
                'ref_id' => $last_insert_id,
                'trans_code' => 'TRANS' . date('Y') . '' . date('m') . 0 . $trans_code,
                'trans_type' => 'credit',
                'amount' => $paid_amount1,
                'prev_amount' => $prevAmount,
                'trans_date' => date('Y-m-d'),
                'status' => 'paid',
                'created_by' => $user_id,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $result_1 = $paymentModel->addTransData($trans_data);
            if ($result_1) {
                $session->setFlashdata('success', 'paid Successfully');
                return redirect()->to('/payment/farmer/viewfarmerpay/' . $farmer_id);
            }
        }
    }

    public function viewFarmerPayData($farmer_id)
    {
        $data['page_title'] = 'View Farmer Payment';
        $paymentModel = new PaymentModel();
        $data['data'] = $paymentModel->getFarmerPayData($farmer_id);
        return view('admin/payment/listfarmerpay', $data);
    }

}
