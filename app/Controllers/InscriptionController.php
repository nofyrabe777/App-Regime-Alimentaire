<?php

namespace App\Controllers;

use App\Models\ProfileSanteModel;
use App\Models\UtilisateurModel;
use App\Models\WalletModel;
use CodeIgniter\Controller;

class InscriptionController extends Controller{
    
    public function Identity(){
        $UtilistaterModel = new UtilisateurModel();
        $data=[
            'nom' => $this->request->getPost('nom'),
            'email' => $this->request->getPost('email'),
            'mot_de_passe' => password_hash($this->request->getPost('mot_de_passe'),PASSWORD_DEFAULT),
            'genre' => $this->request->getPost('genre')
        ];
        $userId = $UtilistaterModel->register($data);
        if($userId){
            $walletModel = new WalletModel();
            
            $walletModel->insertfirsaccount([
                'id_utilisateur' => $userId, 
                'solde' => 0,
                'est_gold' => false
            ]);
            
            session()->set('new_UserID', $userId); 
            
            return redirect()->to('/inscriptionIdentite');
        }
    }

    public function Health(){
        $ProfileSanteModel = new ProfileSanteModel();
        $data=[
            'id_utilisateur' => session()->get('new_UserID'),
            'taille' => $this->request->getPost('taille'),
            'poids' => $this->request->getPost('poids')
        ];
        if($ProfileSanteModel->registerEtat($data)){
            session()->set('LoginID',session()->get('new_UserID'));
            return redirect()->to('/dashboard');
        }
    }

    public function log_in(){
        $UtilisateurModel = new UtilisateurModel();
        $data=[
            'email' => $this->request->getPost('email'),
            'mot_de_passe' => $this->request->getPost('mot_de_passe')
        ];
        $user = $UtilisateurModel->login($data['email'],$data['mot_de_passe']);
        if($user){
            session()->set('LoginID',$user['id_utilisateur']);
            return redirect()->to('/dashboard');
        }
    }

    public function log_out(){
        session_destroy();
        return redirect()->to('/inscription');
    }
}