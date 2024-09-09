<?php

namespace App\Controllers;

use App\Models\ReportModel;

class Report extends BaseController
{
    public function ViewReport()
    {
        $data['page_title'] = 'Milk Sale Report ';
        $reportModel = new ReportModel();
        $data['shift'] = $reportModel->getShift();
        return view('admin/report/milksalereport', $data);
    }

    public function getSalesReport()
    {
        $fromDate = $this->request->getPost('from_date');
        $toDate = $this->request->getPost('to_date');
        $user_code = $this->request->getPost('user_code');
        $shift = $this->request->getPost('shift');
        $milk_type = $this->request->getPost('milk_type');

        $reportModel = new ReportModel();
        $result = $reportModel->getSaleReportData($fromDate, $toDate, $user_code, $milk_type, $shift);
        foreach ($result as $item) {
            $item->date = date('d-m-Y', strtotime($item->date));
        }
        echo json_encode($result);
    }

    public function ViewCollectionReport(){
        $data['page_title'] = 'Collection Report ';
        $reportModel = new ReportModel();
        $data['shift'] = $reportModel->getShift();
        return view('admin/report/milkcollectionreport', $data);
    }

    public function getCollectionReport()
    {
        $fromDate = $this->request->getPost('from_date');
        $toDate = $this->request->getPost('to_date');
        $farmer_code = $this->request->getPost('farmer_code');
        //$col_boy_code = $this->request->getPost('col_boy_code');
        $shift = $this->request->getPost('shift');
        $milk_type = $this->request->getPost('milk_type');

        $reportModel = new ReportModel();
        $result = $reportModel->getMilkReportData($fromDate, $toDate, $farmer_code, $milk_type, $shift);
        // print_r($result);die;
        foreach ($result as $item) {
            $item->date = date('d-m-Y', strtotime($item->date));
        }
        echo json_encode($result);
    }

    public function ViewProductReport()
    {
        $data['page_title'] = 'Product Sale Report ';
        $reportModel = new ReportModel();
        $data['shift'] = $reportModel->getShift();
        $data['types'] = $reportModel->getProduct();
        return view('admin/report/productsalereport', $data);
    }

    public function getProductReport()
    {
        $fromDate = $this->request->getPost('from_date');
        $toDate = $this->request->getPost('to_date');
        $user_code = $this->request->getPost('user_code');
        $shift = $this->request->getPost('shift');
        $product_type = $this->request->getPost('product_type');

        $reportModel = new ReportModel();
        $result = $reportModel->getProductReportData($fromDate, $toDate, $user_code, $product_type, $shift);
        // echo "<pre>";
        // print_r($result);die;
        foreach ($result as $item) {
            $item->date = date('d-m-Y', strtotime($item->date));
            // $item->quantity;die;
        }
        echo json_encode($result);
    }
}
