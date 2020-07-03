<?php

namespace App\Controllers\Panel;

use CodeIgniter\Controller;
use App\Controllers\BaseController;

class Beranda extends BaseController
{
    public function index()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('gagalLogin', 'Anda Belum Login !!!');
            return redirect()->to(base_url('login'));
        }
        return view('panel/beranda');
    }
}
