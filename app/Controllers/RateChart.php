<?php

namespace App\Controllers;

use App\Models\RateChartModel;


class RateChart extends BaseController
{
    public function Create()
    {
        $data['page_title'] = 'Rate Chart';
        $rateChartModel = new RateChartModel();
        $data['data'] = $rateChartModel->getShift();
        $data['milk_type'] = $rateChartModel->getMilkType();
        return view('admin/rate_chart/addchart', $data);
    }

    public function Import()
    {
        $session = session();
        $file = $this->request->getFile('file');
        $shift = $this->request->getPost('shift');
        $type = $this->request->getPost('type');
        //echo $file;die;
        $rules = [
            'file' => [
                'label' => 'File',
                'rules' => 'uploaded[file]|max_size[file,2048]|ext_in[file,csv,text],'
            ],
            'shift' => [
                'label' => 'Shift',
                'rules' => 'required'
            ],
            'type' => [
                'label' => 'Milk Type',
                'rules' => 'required'
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['file'])) {
                $session->setFlashdata('file_error', $errors['file']);
            }
            if (isset($errors['shift'])) {
                $session->setFlashdata('shift_error', $errors['shift']);
            }
            if (isset($errors['type'])) {
                $session->setFlashdata('type_error', $errors['type']);
            }
        }
        $user_id = $session->get('user_id');
        $rateChartModel = new RateChartModel();

        $data_1 = [
            'shift_id' => $shift,
            'milk_type_id' => $type,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $user_id
        ];
        $last_insert_id = $rateChartModel->addData($data_1);

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            //echo $newName;die;
            $file->move(UPLOAD_PATH, $newName);
            //echo 'error';die;
            $file_1 = fopen(UPLOAD_PATH . $newName, 'r');
            //print $file_1; die;

            if (($file_1 = fopen(UPLOAD_PATH . $newName, 'r')) !== FALSE) {
                while (($filedata = fgetcsv($file_1)) !== FALSE) {
                    $data = $filedata;
                    // echo '<pre>';
                    // print_r($data);
                    $data_2 = [
                        'ref_id' => $last_insert_id,
                        'cnf' => $data[0],
                        'fat' => $data[1],
                        'price' => $data[2],
                        'shift_id' => $shift,
                        'milk_type_id' => $type,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => $user_id
                    ];
                    $result = $rateChartModel->addCsvData($data_2);
                }
                fclose($file_1);
            }
            if ($result) {
                $session->setFlashdata('success', 'Rate Chart Added Successfully');
                return redirect()->to('/rate_chart/viewconfig');
            }
        }
    }

    public function ViewConfigData()
    {
        $data['page_title'] = 'Rate Chart';
        $rateChartModel = new RateChartModel();
        $data['data'] = $rateChartModel->getConfigData();
        return view('admin/rate_chart/viewconfig', $data);
    }

    public function viewData($ref_id)
    {
        $data['page_title'] = 'Rate Chart';
        $rateChartModel = new RateChartModel();
        $data['data'] = $rateChartModel->getData($ref_id);
        $data['name'] = $rateChartModel->getshiftData($ref_id);
        return view('admin/rate_chart/viewchart', $data);
    }

    public function editData($id)
    {
        $data['page_title'] = 'Rate Chart';
        $rateChartModel = new RateChartModel();
        $data['data'] = $rateChartModel->getShift();
        $data['milk_type'] = $rateChartModel->getMilkType();
        $data['data1'] = $rateChartModel->getDataById($id);
        return view('admin/rate_chart/editchart',  $data);
    }

    public function updateData($id)
    {
        $session = session();
        $ref_id = $this->request->getPost('ref_id');
        $fat = $this->request->getPost('fat');
        $shift = $this->request->getPost('shift');
        $type = $this->request->getPost('type');
        $cnf = $this->request->getPost('cnf');
        $price = $this->request->getPost('price');
        //echo $file;die;
        $rules = [
            'file' => [
                'label' => 'File',
                'rules' => 'uploaded[file]|max_size[file,2048]|ext_in[file,csv,text],'
            ],
            'cnf' => [
                'label' => 'CNF',
                'rules' => 'required'
            ],
            'price' => [
                'label' => 'Price',
                'rules' => 'required'
            ],
            'shift' => [
                'label' => 'Shift',
                'rules' => 'required'
            ],
            'type' => [
                'label' => 'Milk Type',
                'rules' => 'required'
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['file'])) {
                $session->setFlashdata('file_error', $errors['file']);
            }
            if (isset($errors['fat'])) {
                $session->setFlashdata('fat_error', $errors['fat']);
            }
            if (isset($errors['cnf'])) {
                $session->setFlashdata('cnf_error', $errors['cnf']);
            }
            if (isset($errors['shift'])) {
                $session->setFlashdata('shift_error', $errors['shift']);
            }
            if (isset($errors['type'])) {
                $session->setFlashdata('type_error', $errors['type']);
            }
        }
        $user_id = $session->get('user_id');
        $rateChartModel = new RateChartModel();
        $data_2 = [
            'ref_id' => $ref_id,
            'cnf' => $cnf,
            'fat' => $fat,
            'price' => $price,
            // 'shift_id' => $shift,
            // 'milk_type_id' => $type,
            'modified_at' => date('Y-m-d H:i:s'),
            'modified_by' => $user_id
        ];
        $result = $rateChartModel->updateData($id, $data_2);

        if ($result) {
            $session->setFlashdata('success', 'Rate Chart Updated Successfully');
            return redirect()->to('/rate_chart/view/' . $ref_id);
        }
    }

    public function deleteData($id)
    {
        $rateChartModel = new RateChartModel();
        $result = $rateChartModel->deleteData($id);
        $result_1 = $rateChartModel->deleteChartData($id);
        $session = session();

        if ($result_1) {
            $session->setFlashdata('success', 'Rate Chart Deleted Successfully');
            return redirect()->to('/rate_chart/viewconfig/');
        }
    }

}
