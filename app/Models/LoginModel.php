<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = "tbl_user";

    public function cek_login($username)
    {
        $query = $this->table($this->table)
            ->where('username', $username)
            ->countAll();

        if ($query >  0) {
            $hasil = $this->table($this->table)
                ->where('username', $username)
                ->limit(1)
                ->get()
                ->getRowArray();
        } else {
            $hasil = array();
        }
        return $hasil;
    }
}
