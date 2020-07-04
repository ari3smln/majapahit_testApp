<?php

namespace App\Models;

use CodeIgniter\Model;

class HadiahModel extends Model
{
    protected $table = 'hadiah';

    public function getHadiah($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->db->table($this->table)->where(['kode_hadiah' => $id])->get()->getRowArray();
        }
    }
    public function getKode()
    {
        return $this->db->table($this->table)->selectMax('kode_hadiah', 'kode')->get()->getRowArray();
    }
    public function insertHadiah($data)
    {
        return $this->db->table($this->table)->insert($data);
    }
    public function updateHadiah($data, $id)
    {

        return $this->db->table($this->table)->update($data, ['kode_hadiah' => $id]);
    }

    public function deleteHadiah($id)
    {
        return $this->db->table($this->table)->delete(['kode_hadiah' => $id]);
    }
}
