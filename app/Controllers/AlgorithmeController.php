<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AlgorithmeController extends Controller{
    public function IMC($profileSante){
        $imc = $profileSante['poids'] / ($profileSante['taille'] * $profileSante['taille']);
        /*NOTA BENE : $profileSante(en kg donc pas de conversion) && $profileSante['taille'] en m 0 conversion*/
        return $imc;
    }

    public function poidsIdeale($profileSante,$utilisateur){
        $taille_cm = $profileSante['taille'] * 100;
        if($utilisateur['genre']=='M'){
            $masseIdeal = $taille_cm -100-(($taille_cm-150)/4);
        }else{
            $masseIdeal = $taille_cm -100-(($taille_cm-150)/2.5);
        }
        return $masseIdeal;
    }

    public function MB($profileSante,$utilisateur){ // 
        $taille_cm = $profileSante['taille'] * 100;
        if($utilisateur['genre'] == 'M'){
            $MB = 66.5 + (13.75 * $profileSante['poids']) + (5.003 * $taille_cm) - (6.775 * $profileSante['age']);
        }else{
            $MB = 655.1 + (9.563 * $profileSante['poids']) + (1.850 * $taille_cm) - (4.676 * $profileSante['age']);
        }
        return $MB;
    }

    /*public function fourchetteMasseIdeale($profileSante){
        $poids_min = 18.5 *  ($profileSante['taille']*$profileSante['taille']);
        $poids_max = 24.9 * ($profileSante['taille']*$profileSante['taille']);
        $fourchette=[];
        $fourchette[0] = $poids_min;
        $fourchette[1] = $poids_max;
        return $fourchette;
    }*/

    public function fourchetteMasseIdeal($profileSante){
        $taille_carre = $profileSante['taille'] * $profileSante['taille'];
        return [
            'min' => 18.5 * $taille_carre,
            'max' => 24.9 * $taille_carre
        ];
    }


    // définition de l'algorithme : moi ; codage algorithme : chat partiel (ratio:60% moi, 40% chat)
    public function predictionProgramme($profileSante, $utilisateur, $soldeWallet, $tousLesRegimes, $toutesLesActivites) {
        $poidsActuel = $profileSante['poids'];
        $poidsCible = $this->poidsIdeale($profileSante, $utilisateur);
        $ecart = $poidsCible - $poidsActuel; // Négatif si perte, Positif si gain
        $tolerance = 2;
        
        $suggestions = [];
        $mb = $this->MB($profileSante, $utilisateur);
        $calories_a_changer = abs($ecart) * 7700;

        // 1. Déterminer le type d'objectif pour filtrer
        if (abs($ecart) <= $tolerance) {
            $type_objectif = 'maintien';
        } else {
            $type_objectif = ($ecart < 0) ? 'perte' : 'gain';
        }

        // 2. Boucler sur les régimes et activités (Double Foreach comme ton brouillon)
        foreach ($tousLesRegimes as $regime) {
            // Filtrage logique du régime
            if ($type_objectif == 'perte' && $regime['impact_hebdo'] >= 0) continue;
            if ($type_objectif == 'gain' && $regime['impact_hebdo'] <= 0) continue;

            foreach ($toutesLesActivites as $activite) {
                // Filtrage de l'activité
                if ($activite['type_objectif'] !== $type_objectif) continue;

                // CALCUL DU DÉFICIT/SURPLUS RÉEL
                // (MB + Sport) - Apport
                $depense_totale = $mb + ($activite['depense_calorique'] * $activite['frequence_jour']);
                $balance_quoti = $depense_totale - $regime['apport_calorique'];
                
                // On s'assure que la balance va dans le bon sens
                if ($type_objectif == 'perte' && $balance_quoti <= 0) continue;
                if ($type_objectif == 'gain' && $balance_quoti >= 0) continue;

                // CALCUL DURÉE ET MONTANT
                $jours = ($type_objectif == 'maintien') ? 28 : ceil($calories_a_changer / abs($balance_quoti));
                
                $montant = $regime['prix_journalier'] * $jours;
                if ($utilisateur['est_gold']) {
                    $montant *= 0.85; // Remise 15%
                }

                // CONDITION WALLET (Règle du brouillon)
                if ($montant <= $soldeWallet) {
                    $suggestions[] = [
                        'regime' => $regime,
                        'activite' => $activite,
                        'duree' => $jours,
                        'prix_total' => $montant,
                        'objectif' => $type_objectif
                    ];
                }
            }
        }

        return $suggestions;
    }

    /*méthode d'appel de l'algorithme : 
    $data['programmes_possibles'] = $this->algoCtrl->predictionProgramme(
        $monProfil, 
        $monUser, 
        $monSolde, 
        $modelRegime->findAll(), 
        $modelActivite->findAll()
    );*/
}