<?php

namespace App\Controllers;

use \Firebase\JWT\JWT;
use CodeIgniter\RESTful\ResourceController;
use App\Models\ProdukModel;


class RestProduk extends ResourceController
{
    protected $format       = 'json';
    public function __construct()
    {
        $this->ProdukModel  = new ProdukModel();
    }
    public function index()
    {
        $data = [
            "status"    => 200,
            "data"      => $this->ProdukModel->getproduk()
        ];
        return $this->respond($data, 200);
    }
    public function produkCreate()
    {
        $validation         =  \Config\Services::validation();

        $kode_produk            = $this->request->getPost('kode_produk');
        $nama_produk            = $this->request->getPost('nama_produk');
        $deskripsi_produk       = $this->request->getPost('deskripsi_produk');
        $harga_produk           = $this->request->getPost('harga_produk');
        $stok_produk            = $this->request->getPost('stok_produk');

        $data = [
            'kode_produk'        => $kode_produk,
            'nama_produk'        => $nama_produk,
            'deskripsi_produk'   => $deskripsi_produk,
            'harga_produk'       => $harga_produk,
            'stok_produk'        => $stok_produk
        ];
        // return json_encode($validation->run($data, 'user'));
        if ($validation->run($data, 'produk') == FALSE) {
            $code = 500;
            $response = [
                'status'    => 500,
                'error'     => true,
                'data'      => $validation->getErrors(),
            ];
        } else {
            $code = 200;
            $simpan = $this->ProdukModel->insertproduk($data);
            if ($simpan) {
                $msg = ['message' => 'Created Produk successfully'];
                $response = [
                    'status'    => $code,
                    'error'     => false,
                    'data'      => $msg,
                ];
            }
        }
        echo json_encode($response, $code);
    }

    public function produkUpdate($id = NULL)
    {

        $validation =  \Config\Services::validation();

        $kode_produk            = $this->request->getPost('kode_produk');
        $nama_produk            = $this->request->getPost('nama_produk');
        $deskripsi_produk       = $this->request->getPost('deskripsi_produk');
        $harga_produk           = $this->request->getPost('harga_produk');
        $stok_produk            = $this->request->getPost('stok_produk');

        $data = [
            'kode_produk'        => $kode_produk,
            'nama_produk'        => $nama_produk,
            'deskripsi_produk'   => $deskripsi_produk,
            'harga_produk'       => $harga_produk,
            'stok_produk'        => $stok_produk
        ];

        // $data   = $this->request->getRawInput();

        if ($validation->run($data, 'produk') == FALSE) {
            $code = 500;
            $response = [
                'status' => $code,
                'error' => true,
                'data' => $validation->getErrors(),
            ];
        } else {
            $this->ProdukModel->updateProduk($data, $kode_produk);
            $code = 200;
            $msg = ['message' => 'Updated Produk successfully'];
            $response = [
                'status' => 200,
                'error' => false,
                'data' => $msg,
            ];
        }
        // echo json_encode($response, $code);

        return $this->respond($response, $code);
    }

    public function produkDell($id = NULL)
    {

        $dell = $this->ProdukModel->getProduk($id);
        // return var_dump($dell);
        if ($dell) {
            $hapus = $this->ProdukModel->deleteProduk($id);
            $code = 200;
            $msg = ['message' => 'Deleted Produk successfully'];
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
