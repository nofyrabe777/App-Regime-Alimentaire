<?php

namespace App\Models;
use CodeIgniter\Model;

class ActiviteModel extends Model{
    protected $table ='activites';
    protected $primaryKey = 'id_activite';
    protected $allowedFields = [
        'id_utilisateur',
        'type_activite',
        'duree',
        'date_activite',
        'frequence_jour',
        'type_objetif'
    ];

    public function getAllActivity(){
        return $this->findAll();
    }
    
}