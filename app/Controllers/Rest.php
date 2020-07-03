<?php

namespace App\Controllers;

use \Firebase\JWT\JWT;
use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;


class Rest extends ResourceController
{
    protected $format       = 'json';

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function users()
    {
        $data = [
            "status"    => 200,
            "data"      => $this->userModel->getUser()
        ];
        return $this->respond($data, 200);
    }

    public function userCreate()
    {
        $validation         =  \Config\Services::validation();

        $nama_user          = $this->request->getPost('nama_user');
        $username           = $this->request->getPost('username');
        $level              = $this->request->getPost('level');
        $password           = $this->request->getPost('password');

        if ($password != null) {
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
        } else {
            $password_hash = $password;
        }

        $data = [
            'nama_user'         => $nama_user,
            'username'          => $username,
            'password'          => $password_hash,
            'level'             => $level
        ];
        // return json_encode($validation->run($data, 'user'));
        if ($validation->run($data, 'user') == FALSE) {
            $code = 500;
            $response = [
                'status'    => 500,
                'error'     => true,
                'data'      => $validation->getErrors(),
            ];
        } else {
            $code = 200;
            $simpan = $this->userModel->insertUser($data);
            if ($simpan) {
                $msg = ['message' => 'Created User successfully'];
                $response = [
                    'status'    => $code,
                    'error'     => false,
                    'data'      => $msg,
                ];
            }
        }
        echo json_encode($response, $code);
    }
    public function userUpdate($id = NULL)
    {

        $validation =  \Config\Services::validation();

        $nama_user          = $this->request->getPost('nama_user');
        $username           = $this->request->getPost('username');
        $level              = $this->request->getPost('level');
        $password           = $this->request->getPost('password');

        if ($password != null || $password != '') {
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
        } else {
            $password_hash = $password;
        }

        $data = [
            'nama_user' => $nama_user,
            'username'  => $username,
            'level'     => $level,
            'password'  => $password_hash,
        ];

        // $data   = $this->request->getRawInput();

        if ($validation->run($data, 'user') == FALSE) {
            $code = 500;
            $response = [
                'status' => $code,
                'error' => true,
                'data' => $validation->getErrors(),
            ];
        } else {
            $simpan = $this->userModel->updateUser($data, $id);
            $code = 200;
            $msg = ['message' => 'Updated User successfully'];
            $response = [
                'status' => 200,
                'error' => false,
                'data' => $msg,
            ];
        }
        // echo json_encode($response, $code);

        return $this->respond($response, $code);
    }

    public function userDell($id = NULL)
    {
        $simpan = $this->userModel->getUser($id);

        if ($simpan) {
            $hapus = $this->userModel->deleteUser($id);
            $code = 200;
            $msg = ['message' => 'Deleted User successfully'];
            $response = [
                'status' => $code,
                'error' => false,
                'data' => $msg,
            ];
        } else {
            $code = 401;
            $msg = ['message' => 'Data Not Found'];
            $response = [
                'status' => $code,
                'error' => true,
                'data' => $msg,
            ];
        }
        return $this->respond($response, $code);
        // echo json_encode($response, $code);
    }
}
