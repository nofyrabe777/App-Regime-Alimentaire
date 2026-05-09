<?php

namespace App\Models;
use CodeIgniter\Model;

class UtilisateurModel extends Model{
    protected $table = 'utilisateurs';
    protected $primaryKey = 'id_utilisateur';
    protected $allowedFields = [
        'nom',
        'email',
        'mot_de_passe',
        'genre'
    ];
    
    public function register($data){
        return $this->insert($data);
    }
    public function login($email,$mot_de_passe){
        $user = $this->where('email',$email)->first();
        if($user){
            if (password_verify($mot_de_passe,$user['mot_de_passe'])) {
                return $user;
            }
        }
        return null;
    }
    
    public function modif($id,$data){
        return $this->update($id,$data);
    }
    public function suppress($id){
        return $this->delete($id);
    }

}