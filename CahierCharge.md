# Cahier de charge 

## Entité : front office
1. utilisateur:
    * nom
    * email
    * genre
    * mot de passe (d'acces si déja inscrit)

<br>

2. profile santé:
    * taille (m)
    * poids (kg)

3. Objectif (masse):
    * prendre de la masse
    * perte de masse
    * Atteindre l'imc idéal (poids idéale)
  
4. Régime
    * Nom
    * prix(en fonction de la durée)
    * % viande
    * % volaille
    * % poisson
    * impacte sur le poids actuelle


5. activité sportive 
    * nom des activité
    * fréquence par jour
    * type_objectif(perte ou gain de masse)
  
6. suivi de poids(utilisateur - administrateur)
    * id_utilisateur
    * id_regime
    * dateDebut
    * dateFin
    * evolution de poids
    * montant payer
  
7. wallet
    * solde (l'argent que l'utilisateur dédie pour son régime)
    * est_gold (boolean true (remise) false pour utilisateur simple)
  
## Entité : back office
1. remise
    * pourcentage remise
    * prix option gold(a payer en une seule fois)0

2. code recharge
    * valeur(texte du code) 
    * montant
    * est_utilisé(unique)  




## Logique
1. le calcul d'IMC permet l'affichage des options en fonction de l'imc et en fonction du choix de l'utilisateur: <br>
    il sera proposé immédiatement le régime approprié : sport, régime alimentaire, durée du programme 
2. dans le cas ou il choisi l'option prénium l'utilisateur aura droit a une remise de X% sur tout les régimes et il doit payer en une seule fois
---
    IMC : masse_utilisateur / taille
---
3. pour la perte de poids (masse_souhaité < masse_utilisateur)
4. pour la prise de poids (masse_souhaité > masse_utilisateur)
5. pour le calcule de l'IMC idéale : 
---
    facteur poids idéale selon OMC : 18,5 et 24,9

    masse_(-): 18.5 * (taille)^2
    masse_(+): 24.9 * (taille)^2
    ->la masse idéale pour une personne en fonction du genre se trouve entre masse_(-) et masse_(+)


    taille_homme: taille_homme-100-((Taille(cm)-150)/4)

    taille_femme: taille_femme-100-((Taille(cm) - 150)/2.5)
---
