<?php

namespace App\Controllers;

use \Firebase\JWT\JWT;
use CodeIgniter\RESTful\ResourceController;
use App\Models\HadiahModel;


class RestHadiah extends ResourceController
{
    protected $format       = 'json';
    public function __construct()
    {
        $this->HadiahModel  = new HadiahModel();
    }
    public function index()
    {
        $data = [
            "status"    => 200,
            "data"      => $this->HadiahModel->getHadiah()
        ];
        return $this->respond($data, 200);
    }
    public function hadiahCreate()
    {
        $validation         =  \Config\Services::validation();

        $kode_hadiah            = $this->request->getPost('kode_hadiah');
        $nama_hadiah            = $this->request->getPost('nama_hadiah');
        $poin                   = $this->request->getPost('poin');

        $data = [
            'kode_hadiah'       => $kode_hadiah,
            'nama_hadiah'       => $nama_hadiah,
            'poin'              => $poin
        ];
        // return json_encode($validation->run($data, 'user'));
        if ($validation->run($data, 'hadiah') == FALSE) {
            $code = 500;
            $response = [
                'status'    => 500,
                'error'     => true,
                'data'      => $validation->getErrors(),
            ];
        } else {
            $code = 200;
            $simpan = $this->HadiahModel->inserthadiah($data);
            if ($simpan) {
                $msg = ['message' => 'Created Hadiah successfully'];
                $response = [
                    'status'    => $code,
                    'error'     => false,
                    'data'      => $msg,
                ];
            }
        }
        echo json_encode($response, $code);
    }

    public function hadiahUpdate($id = NULL)
    {

        $validation =  \Config\Services::validation();

        $kode_hadiah            = $this->request->getPost('kode_hadiah');
        $nama_hadiah            = $this->request->getPost('nama_hadiah');
        $poin                   = $this->request->getPost('poin');

        $data = [
            'nama_hadiah'       => $nama_hadiah,
            'poin'              => $poin
        ];

        // $data   = $this->request->getRawInput();

        if ($validation->run($data, 'hadiah') == FALSE) {
            $code = 500;
            $response = [
                'status' => $code,
                'error' => true,
                'data' => $validation->getErrors(),
            ];
        } else {
            $this->HadiahModel->updateHadiah($data, $kode_hadiah);
            $code = 200;
            $msg = ['message' => 'Updated Hadiah successfully'];
            $response = [
                'status' => 200,
                'error' => false,
                'data' => $msg,
            ];
        }
        // echo json_encode($response, $code);

        return $this->respond($response, $code);
    }

    public function hadiahDell($id = NULL)
    {

        $dell = $this->HadiahModel->getHadiah($id);
        // return var_dump($dell);
        if ($dell) {
            $hapus = $this->HadiahModel->deleteHadiah($id);
            $code = 200;
            $msg = ['message' => 'Deleted Hadiah successfully'];
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
