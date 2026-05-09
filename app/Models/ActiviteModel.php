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
        'type_objetif',
        'depense_calorique'
    ];

    public function getAllActivity(){
        return $this->findAll();
    } 
     
    /*public function getAllActivityByTypeObjectif($factor){
        $Activity =[];
        $activities =  $this->where('type_objetif',$factor)
                            ->findAll();
        foreach ($activities as $activity) {
            $Activity[] = $activity;
        }
        return $Activity;
    } ceci est la version plus difficile de l'algorithme*/

    public function getAllActivityByTypeObjectif($factor){
        $activities =  $this->where('type_objetif',$factor)
                            ->findAll();
        return $activities; //retourne le tableau 
    }
    
    
}