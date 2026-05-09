<?php

namespace App\Controllers;

use App\Models\CodeRechargeModel;
use App\Models\WalletModel;
use CodeIgniter\Controller;

class WalletController extends Controller{
    public function recharger() {
    $codeSaisi = $this->request->getPost('code_valeur');
    $idUser = session()->get('LoginID');

    $codeModel = new CodeRechargeModel();
    $walletModel = new WalletModel();

    // 1. Vérifier le code
    $check = $codeModel->where('valeur_code', $codeSaisi)
                       ->where('est_utilise', 0)
                       ->first();

    if ($check) {
        // 2. Calculer le nouveau solde
        $wallet = $walletModel->where('id_utilisateur', $idUser)->first();
        $nouveauSolde = $wallet['solde'] + $check['montant'];

        // 3. Mettre à jour (Transaction)
        $walletModel->updateSolde($idUser, $nouveauSolde);
        $codeModel->update($check['id_code'], ['est_utilise' => 1]);

        return redirect()->to('/dashboard')->with('success', 'Compte rechargé !');
    }
    
    return redirect()->back()->with('error', 'Code invalide ou déjà utilisé.');
}
}