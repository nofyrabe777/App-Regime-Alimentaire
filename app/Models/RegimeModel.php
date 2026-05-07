<?php

namespace App\Models;

use CodeIgniter\Model;

class RegimeModel extends Model{
    protected $table = 'regime';
    protected $primaryKey = 'id_regime';
    protected $allowedFields = ['nom_regime','prix_journalier','pourcentage_viande','pourcentage_volaille','pourcentage_poisson','impact_poids_hebdo'];
}