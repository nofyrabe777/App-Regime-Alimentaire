<?php

namespace App\Models;
use CodeIgniter\Model;

class ProfileSanteModel extends Model{
    protected $table='profil_sante';
    protected $primaryKey = 'id_profil';
    protected $allowedFields = ['id_utilisateur','taille','poids'];
}