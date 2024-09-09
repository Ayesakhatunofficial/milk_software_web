<?php

namespace App\Controllers;
use App\Models\LoginModel;

class Login extends BaseController
{
    public function login()
    {
        return view('login/login');
    }


    public function LoginMatch(){

        $mobile = $this->request->getVar('user_name');
        $password = md5($this->request->getVar('password'));
        $session = \Config\Services::session();
            $rules = [
            'user_name' => [
                'label'=>'Username','rules'=>'required'],
                'password' => [
                    'label'=>'Password','rules'=>'required']    
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            if (isset($errors['user_name'])) {
              $session->setFlashdata('name_error', $errors['user_name']);
            }
            if (isset($errors['password'])) {
                $session->setFlashdata('pass_error', $errors['password']);
              }
            return redirect()->to('/');
        }

        $loginModel = new LoginModel();
        $result = $loginModel->getData($mobile, $password);
      //print_r($result);die;
        if($result){
            $s_data = [
                'user_id' => $result->id,
                'user_name' => $result->user_name,
                'email' => $result->user_email,
                'user_mobile' => $result->user_mobile,
                'user_role' => $result->user_role,
            ];
            $session->set($s_data);
            //print_r($s_data);die;
            return redirect('index');
        }else{
            $session->setFlashdata('msg', 'Invalid User');
            return redirect()->to('/');
        }
        
    }

}   