<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';

    public function getUser($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->db->table($this->table)->where(['kode_user' => $id])->get()->getRowArray();
        }
    }
    public function getKode()
    {
        return $this->db->table($this->table)->selectMax('kode_user', 'kode')->get()->getRowArray();
    }
    public function insertUser($data)
    {
        return $this->db->table($this->table)->insert($data);
    }
    public function updateUser($data, $id)
    {

        return $this->db->table($this->table)->update($data, ['kode_user' => $id]);
    }

    public function deleteUser($id)
    {
        return $this->db->table($this->table)->delete(['kode_user' => $id]);
    }
}
