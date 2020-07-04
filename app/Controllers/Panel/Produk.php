<?php

namespace App\Controllers\Panel;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Models\ProdukModel;

class Produk extends BaseController
{
    public function __construct()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('gagalLogin', 'Anda Belum Login !!!');
            return redirect()->to(base_url('login'));
        }
        $this->produkModel = new ProdukModel();
    }
    public function index()
    {
        $data = $this->produkModel->getKode();
        $noUrut = (int) substr($data["kode"], 3, 3);
        $noUrut++;
        $char = "P";
        $data['kode'] = $char . sprintf("%03s", $noUrut);
        return view('panel/produk/index', $data);
    }
}
