<?php

namespace App\Models;

use CodeIgniter\Model;

class WalletModel extends Model{
    protected $table='wallet';
    protected $primaryKey = 'id_wallet';
    protected $allowedFields = ['solde','est_gold'];
}