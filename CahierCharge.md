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
    * solde (l'argent que l'utilisateur dédie pour son régime)
    * est_gold (boolean true (remise) false pour utilisateur simple)

3. Objectif (masse):
    * augmenter
    * réduire
    * Atteindre l'imc idéal
    * poids idéale
  
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


## Entité : back office
1. remise
    * pourcentage remise
    * prix option gold(a payer en une seule fois)0

2. 


## Logique
1. le calcul d'IMC permet l'affichage des options en fonction de l'imc et en fonction du choix de l'utilisateur: <br>
    il sera proposé immédiatement le régime approprié : sport, régime alimentaire, durée du programme 
2. dans le cas ou il choisi l'option prénium l'utilisateur aura droit a une remise de X% sur tout les régimes et il doit payer en une seule fois
3. 

## Besoin coté interface 
1. un graphique 