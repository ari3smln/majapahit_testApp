<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{

    public function count_data($param)
    {
        $db = \Config\Database::connect();

        return $db->table($param)->countAll();
    }
}
