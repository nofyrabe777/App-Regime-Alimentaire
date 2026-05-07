<?php

namespace App\Models;

use CodeIgniter\Model;

class CodeRechargeModel extends Model{
    protected $table ='code_recharge';
    protected $primaryKey = 'id_code';
    protected $allowedFields = [
        'valeur_code',
        'montant',
        'est_utilise'
    ];
}