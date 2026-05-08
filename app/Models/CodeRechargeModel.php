<?php

namespace App\Models;

use CodeIgniter\Model;

class CodeRechargeModel extends Model{
    protected $table ='code_recharge';
    protected $primaryKey = 'id_code';
    protected $allowedFields = [
        'valeur_code',
        'montant',
        'est_utilise'//unique pour la database sql mais true pour la version boolean du programme
    ];

    public function registerCodeRecharge($data){
        return $this->insert($data);
    }
    //lors de la recharge
    public function addMoney($id,$money){
        return $this->update($id,$money);
    }
}