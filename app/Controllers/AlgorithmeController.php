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
        $taille_cm = $profileSante['taille']*100;
        if($utilisateur['genre']=='M'){
            $masseIdeal = $taille_cm -100-(($taille_cm-150)/4);
        }else{
            $masseIdeal = $taille_cm -100-(($taille_cm-150)/2.5);
        }
        return $masseIdeal;
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

    public function predireProgramme($profileSante,$utilisateur,$idUser) {
        $poidsActuel = $profileSante['poids'];
        $poidsCible = $this->poidsIdeale($profileSante, $utilisateur);//taille , genre
        $ecart = $poidsCible - $poidsActuel;
        
    }
}