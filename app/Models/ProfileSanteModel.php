<?php

namespace App\Models;
use CodeIgniter\Model;

class ProfileSanteModel extends Model{
    protected $table='profil_sante';
    protected $primaryKey = 'id_profil';
    protected $allowedFields = [
        'id_utilisateur',
        'taille',
        'poids',
        'age' 
    ];

    public function registerEtat($data){
        return $this->insert($data);
    }
    public function suppressEtat($id){
        return $this->delete($id);
    }
    public function selectProfileComplete($id){
        return $this->select('utilisateurs.*, profil_sante.taille,profil_sante.poids,wallet.solde')
                    ->join('utilisateurs',('utilisateurs.id_utilisateur=profil_sante.id_utilisateur'))
                    ->join('wallet','wallet.id_utilisateur=utilisateurs.id_utilisateur')
                    ->where('utilisateurs.id_utilisateur',$id)
                    ->first();
    }
}