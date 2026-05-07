<?php

namespace App\Models;

use CodeIgniter\Model;

class SuiviPoidsModel extends Model{
    protected $table = 'suivi_poids';
    protected $primaryKey = 'id_suivi';
    protected $allowedFields = [
        'id_utilisateur',
        'id_regime',
        'date_debut',
        'date_fin',
        'poids_depart',
        'poids_objectif',
        'montant_paye'
    ];

    
}