<?php

namespace App\Controllers\Panel;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Models\HadiahModel;

class Hadiah extends BaseController
{
    public function __construct()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('gagalLogin', 'Anda Belum Login !!!');
            return redirect()->to(base_url('login'));
        }
        $this->HadiahModel = new HadiahModel();
    }
    public function index()
    {

        $data = $this->HadiahModel->getKode();
        $noUrut = (int) substr($data["kode"], 3, 3);
        $noUrut++;

        $char = "H";
        $data['kodeHadiah'] = $char . sprintf("%03s", $noUrut);

        return view('panel/hadiah/index', $data);
    }
}
