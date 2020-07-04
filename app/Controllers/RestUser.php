<?php

namespace App\Controllers;

use \Firebase\JWT\JWT;
use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class RestUser extends ResourceController
{
    protected $format       = 'json';

    public function __construct()
    {
        $this->userModel    = new UserModel();
    }

    public function index()
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

        $kode_user          = $this->request->getPost('kode_user');
        $nama_lengkap       = $this->request->getPost('nama_lengkap');
        $noHp               = $this->request->getPost('noHp');
        $alamat             = $this->request->getPost('alamat');
        $email              = $this->request->getPost('email');
        $username           = $this->request->getPost('username');
        $level              = $this->request->getPost('level');
        $password           = $this->request->getPost('password');

        if ($password != null) {
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
        } else {
            $password_hash = $password;
        }

        $data = [
            'kode_user'         => $kode_user,
            'nama_lengkap'      => $nama_lengkap,
            'noHp'              => $noHp,
            'alamat'            => $alamat,
            'email'             => $email,
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

        $kode_user          = $this->request->getPost('kode_user');
        $nama_lengkap       = $this->request->getPost('nama_lengkap');
        $noHp               = $this->request->getPost('noHp');
        $alamat             = $this->request->getPost('alamat');
        $email              = $this->request->getPost('email');
        $username           = $this->request->getPost('username');
        $level              = $this->request->getPost('level');
        $password           = $this->request->getPost('password');

        if ($password != null || $password != '') {
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
        } else {
            $password_hash = $password;
        }

        $data = [
            'nama_lengkap'      => $nama_lengkap,
            'noHp'              => $noHp,
            'alamat'            => $alamat,
            'email'             => $email,
            'username'          => $username,
            'password'          => $password_hash,
            'level'             => $level
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
            $simpan = $this->userModel->updateUser($data, $kode_user);
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

        $dell = $this->userModel->getUser($id);
        // return var_dump($dell);
        if ($dell) {
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
