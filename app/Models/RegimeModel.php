<?php

namespace App\Models;

use CodeIgniter\Model;

class RegimeModel extends Model{
    protected $table = 'regime';
    protected $primaryKey = 'id_regime';
    protected $allowedFields = [
        'nom_regime',
        'prix_journalier', 
        'pourcentage_viande',
        'pourcentage_volaille',
        'pourcentage_poisson',
        'impact_hebdo',
        'apport_calorique'
    ];

    /*public function getAllRegime(){
        $tableauRegime = [];
        $regimes = $this->findAll();
        foreach ($regimes as $regime) {
            $tableauRegime[] = $regime;
        }
        return $tableauRegime;
    } en bas la version simplifié*/
    
    public function getAllRegime(){
        return $this->findAll(); //ok c'est déja un tableau en soit 
    }

    public function insertionNewRegime($data){
        return $this->insert($data);
    }

}