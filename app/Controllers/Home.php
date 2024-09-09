<?php

namespace App\Controllers;

use App\Models\HomeModel;


class Home extends BaseController
{
    public function index()
    {
        $data['page_title'] = 'Dashboard';
        $homeModel = new HomeModel();
        $data['farmer'] = $homeModel->getTotalFarmer();
        $data['customer'] = $homeModel->getTotalCustomer();
        $data['col_boy'] = $homeModel->getTotalCollectionBoy();
        $data['total_sale'] = $homeModel->getTotalSale();
        $date = date('Y-m-d');
        $data['sales'] = $homeModel->getTotalSaleByDate($date);
        $data['milk_collect']= $homeModel->getMilkCollectByDate();
        $data['milk_sale']= $homeModel->getMilkSaleByDate();
        // print_r($data['milk_sale']) ;die;    
        return view('admin/index', $data);
    }
    public function Logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }


    // public function importCsvToDb()
    // {
    //     $filePath = UPLOAD_PATH .'/file.csv';
    //     // echo $filepath;
    //     if (($file = fopen($filePath, 'r')) !== FALSE) {
    //         $header = fgetcsv($file);
    //         while (($row = fgetcsv($file)) !== FALSE) {
    //             $data = array_combine($header, $row);
    //             $homeModel = new HomeModel();
    //             $result =$homeModel->addCsvData($data);
    //         }
    //         fclose($file);
    //     } else {
    //         die("Unable to open file");
    //     }
    //     echo "CSV data imported successfully!";
    // }
}
