<?php
namespace App\Models;

use CodeIgniter\Model;

class ConfigRemiseModel extends Model{
    protected $table='configuration_remise';
    protected $primaryKey = 'id_config';
    protected $allowedFields = [
        'pourcentage_remise',
        'prix_option_gold'
    ];

    //la logique au lieu de modifier via update autant laisser des traces et les affichés dans le truc de l'admin lorsqu'on aura le temps de le finir
    public function AbsoluteRegister($data){
        return $this->insert($data);
    }
    public function ApplicationLastReduction($id){
        return $this->where('id_config',$id)->first();
    }

}