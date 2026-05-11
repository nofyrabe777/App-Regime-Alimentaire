<?php

namespace App\Controllers;

use App\Models\ProfileSanteModel;
use App\Models\SuiviPoidsModel;
use App\Models\UtilisateurModel;
use App\Models\WalletModel;
use CodeIgniter\Controller;

class DashboardController extends Controller{

    
    public function viewDash(){
        if(session()->get('LoginID')){
            return view('welcome_message');
        }
        return view('inscription_view');
    }

    public function index() {
        // 1. Sécurité : Vérifier si l'utilisateur est connecté
        $userId = session()->get('LoginID');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter.');
        }

        // 2. Instancier les modèles et le contrôleur d'algorithme
        $profileModel = new ProfileSanteModel();
        $walletModel  = new WalletModel();
        $suiviModel   = new SuiviPoidsModel();
        $userModel    = new UtilisateurModel();
        $algo         = new AlgorithmeController();

        // 3. Récupérer les données de base
        $user    = $userModel->find($userId);
        $profil  = $profileModel->where('id_utilisateur', $userId)->first();
        $wallet  = $walletModel->where('id_utilisateur', $userId)->first();
        $suivi   = $suiviModel->where('id_utilisateur', $userId)->orderBy('id_suivi', 'DESC')->first();

        // 4. Calculs de santé (via ton AlgorithmeController)
        $data = [
            'user'       => $user,
            'wallet'     => $wallet,
            'profil'     => $profil,
            'imc'        => ($profil) ? $algo->IMC($profil) : null,
            'poidsIdeal' => ($profil) ? $algo->poidsIdeale($profil, $user) : null,
            'fourchette' => ($profil) ? $algo->fourchetteMasseIdeal($profil) : null,
        ];

        // 5. Préparation des données pour le graphique (Chart.js)
        // On envoie des tableaux vides si pas de suivi
        $data['graphLabels'] = [];
        $data['graphPoids']  = [];

        if ($suivi) {
            $data['graphLabels'] = [$suivi['date_debut'], $suivi['date_fin']];
            $data['graphPoids']  = [$suivi['poids_depart'], $suivi['poids_objectif']];
            $data['dernier_programme'] = $suivi;
        }

        // 6. Envoyer le tout à la vue
        return view('dashboard_view', $data);
    }

    // Dans ton DashboardController.php
    public function success() {
        $data['message'] = "Félicitations ! Votre profil santé a été créé avec succès.";
        return view('success_view', $data);
    }
}