<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;
use CodeIgniter\Controller;

class AccountController extends Controller{
    public function updateAccount(){
        $UtilisateurModel = new UtilisateurModel();
        
        // On récupère l'ID proprement depuis la session
        $id = session()->get('LoginID'); 

        $data = [
            'nom'   => $this->request->getPost('nom'),
            'email' => $this->request->getPost('email'),
        ];

        // On ne hache le mot de passe que s'il a été saisi
        $mdp = $this->request->getPost('mot_de_passe');
        if (!empty($mdp)) {
            $data['mot_de_passe'] = password_hash($mdp, PASSWORD_DEFAULT);
        }

        $UtilisateurModel->modif($id, $data);
        
        // Mise à jour du nom en session au cas où il a changé
        session()->set('userName', $data['nom']);

        return redirect()->to('/MyAccount');
    }

    public function deleteAccount(){
        $UtilisateurModel = new UtilisateurModel();
        $id = session()->get('LoginID');

        if ($id) {
            $UtilisateurModel->suppress($id);
            session()->destroy(); // On détruit la session après suppression
            return redirect()->to('/inscription');
        }
    }
}