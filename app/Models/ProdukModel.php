<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table = 'produk';

    public function getproduk($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->db->table($this->table)->where(['kode_produk' => $id])->get()->getRowArray();
        }
    }
    public function getKode()
    {
        return $this->db->table($this->table)->selectMax('kode_produk', 'kode')->get()->getRowArray();
    }
    public function insertproduk($data)
    {
        return $this->db->table($this->table)->insert($data);
    }
    public function updateproduk($data, $id)
    {

        return $this->db->table($this->table)->update($data, ['kode_produk' => $id]);
    }

    public function deleteproduk($id)
    {
        return $this->db->table($this->table)->delete(['kode_produk' => $id]);
    }
}
