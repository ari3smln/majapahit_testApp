<?php

namespace App\Controllers\Panel;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Models\TransaksiModel;

class Transaksi extends BaseController
{
    public function __construct()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('gagalLogin', 'Anda Belum Login !!!');
            return redirect()->to(base_url('login'));
        }
        $this->TransaksiModel = new TransaksiModel();
    }
    public function index()
    {

        $data = $this->TransaksiModel->getKode();
        $noUrut = (int) substr($data["kode"], 3, 3);
        $noUrut++;

        $char = "H";
        $data['kodeHadiah'] = $char . sprintf("%03s", $noUrut);

        return view('panel/transaksi/index', $data);
    }
}
