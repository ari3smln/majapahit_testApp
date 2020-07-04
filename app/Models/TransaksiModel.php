<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';

    public function getTransaksi($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->db->table($this->table)->where(['kode_transaksi' => $id])->get()->getRowArray();
        }
    }
    public function getKode()
    {
        return $this->db->table($this->table)->selectMax('kode_transaksi', 'kode')->get()->getRowArray();
    }
    public function insertTransaksi($data)
    {
        return $this->db->table($this->table)->insert($data);
    }
    public function updateTransaksi($data, $id)
    {

        return $this->db->table($this->table)->update($data, ['kode_transaksi' => $id]);
    }

    public function deleteTransaksi($id)
    {
        return $this->db->table($this->table)->delete(['kode_transaksi' => $id]);
    }
}
