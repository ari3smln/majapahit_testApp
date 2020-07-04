<?php

namespace App\Controllers\Panel;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Models\DashboardModel;

class Beranda extends BaseController
{
    public function __construct()
    {
        $this->DashboardModel = new DashboardModel();
    }
    public function index()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('gagalLogin', 'Anda Belum Login !!!');
            return redirect()->to(base_url('login'));
        }
        $data = array(
            'userData'  => $this->DashboardModel->count_data("users"),
            'prodData'  => $this->DashboardModel->count_data("produk"),
            'transData'  => $this->DashboardModel->count_data("transaksi"),
            'hadData'  => $this->DashboardModel->count_data("hadiah")
        );
        return view('panel/beranda', $data);
    }
}
