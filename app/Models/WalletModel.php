<?php

namespace App\Models;

use CodeIgniter\Model;

class WalletModel extends Model{
    protected $table='wallet';
    protected $primaryKey = 'id_wallet';
    protected $allowedFields = [
        'id_utilisateur',
        'solde',
        'est_gold'
    ];


    public function insertfirsaccount($data){
        return $this->insert($data);
    }
    public function updateSolde($id_utilisateur, $nouveau_solde){
        return $this->where('id_utilisateur', $id_utilisateur)
                    ->set(['solde' => $nouveau_solde])
                    ->update();
    }
    
}