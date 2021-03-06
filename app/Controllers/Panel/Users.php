<?php

namespace App\Controllers\Panel;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Models\UserModel;

class Users extends BaseController
{
    public function __construct()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('gagalLogin', 'Anda Belum Login !!!');
            return redirect()->to(base_url('login'));
        }
        $this->userModel = new UserModel();
    }
    public function index()
    {
        $data = $this->userModel->getKode();
        $noUrut = (int) substr($data["kode"], 3, 3);
        $noUrut++;
        $char = "MT";
        $data['kode'] = $char . sprintf("%03s", $noUrut);
        return view('panel/users/index', $data);
    }
}
