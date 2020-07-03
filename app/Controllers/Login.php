<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LoginModel;


class Login extends BaseController
{
    protected $session;

    public function __construct()
    {

        helper('form');
        $this->session = \Config\Services::session();
        $this->session->start();
        $this->LoginModel = new LoginModel();
    }

    public function index()
    {
        if (session()->get('username') != '') {
            return redirect()->to(base_url('panel/beranda'));
        }
        echo view('v_login');
    }

    public function cek_login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // $cek = $this->LoginModel->cek_login($username, $password);
        $cek_login = $this->LoginModel->cek_login($username);


        if (password_verify($password, $cek_login['password'])) {

            // buat session
            // session()->set('username', $cek_login['username']);
            // session()->set('nama_user', $cek_login['nama_user']);
            // session()->set('level', $cek_login['level']);
            $sess_array = array(
                'nama_user' => $cek_login["nama_user"],
                'username' => $cek_login["username"],
                'level' => $cek_login["level"],
            );
            session()->set($sess_array);

            // die();
            return redirect()->to(base_url('panel/beranda'));
        } else {
            session()->setFlashdata('gagalLogin', 'Masukkan Username & Password yang benar');
            return redirect()->to(base_url('login'));
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
