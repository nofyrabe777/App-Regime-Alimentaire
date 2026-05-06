# Cahier de charge 

## Entité : 
1. utilisateur:
    * nom
    * email
    * genre
    * mot de passe (d'acces si déja inscrit)
  <br>
Table a part entière:*information de santé de l'utilisateur :*
* taille (m)
* poids (kg)
* solde (l'argent que l'utilisateur dédie pour son régime)
* code (code de recharge)
* est_gold (boolean true (remise) false pour utilisateur simple)

2. Objectif (masse):
    * augmenter
    * réduire
    * Atteindre l'imc idéal
    * poids idéale
  
3. Régime
    * Nom
    * prix(en fonction de la durée)
    * composition
    * impacte sur le poids actuelle


4. activité sportive 
    * nom des activité
    * fréquence par jour
    * type_objectif(perte ou gain de masse)

5. remise
    * pourcentage remise


## Logique
1. le calcul d'IMC permet l'affichage des options en fonction de l'imc et en fonction du choix de l'utilisateur: <br>
    il sera proposé immédiatement le régime approprié : sport, régime alimentaire, durée du programme 
2. dans le cas ou il choisi l'option prénium l'utilisateur aura droit a une remise de X% sur tout les régimes et il doit payer en une seule fois
3. 

## Besoin coté interface 
1. un graphique 