<?php

namespace App\Controllers\Panel;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Models\UserModel;

class Users extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index()
    {
        $data["rec"] = $this->userModel->getUser();
        return view('panel/users/index', $data);
    }
    public function show($id = false)
    {

        $data["rec"] = $this->userModel->getUser($id);
        var_dump($data["rec"]);
        // return view('panel/users/index', $data);
    }
}
