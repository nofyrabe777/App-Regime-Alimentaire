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

[Suivie-du-projet]https://docs.google.com/spreadsheets/d/1rNlWRBfINQbBpCAl2TeLiZ4Qi8zbpKnKYZPU4eDYpns/edit?gid=1084618095#gid=1084618095

---
    ## Test de sureté pour le conteneur avant de l'activé 
    ```bash
    # Dockerfile seul : 
    docker build -t php-codeigniter . && docker run -p 8080:80 php-codeigniter && docker logs
    # docker-compose.yml
    docker-compose up --build  && docker compose logs -f app
    # 
    ```
---

# Feuille de route backend: 

1. Création des pages d'inscription
*backend :* <br>
- mini crud pour les models 
    * utilisateurs
    * profil_santé
    * wallet
- controlleur 
    * InscriptionController
        * identity(mail ,nom ,mdp ,...)
        * health (taille, poids)
        * wallet(décision pour profils gold)
- route(en cours)

# Feuille de Route Frontend - Projet Régime 

## 1. Phase d'Inscription & Identification (UX Flow)
L'objectif est de collecter les données de santé pour proposer un régime immédiat.

### Page 1 : Login / Inscription Initiale
* **Composants :**
    * Formulaire : Nom, Email, Genre, Mot de passe.
    * **Barre de progression :** (Étape 1/2) pour encourager l'utilisateur.
    * Lien vers la connexion si déjà inscrit.

### Page 2 : Profil Santé & Objectif
* **Composants :**
    * Inputs : Taille (m) et Poids actuel (kg).
    * **Sélecteur d'Objectif :** * Perte de poids.
        * Prise de masse.
        * Atteindre l'IMC idéal (Poids de forme).
    * **Option Gold (Checkbox) :** * Si cochée : Affichage dynamique d'un champ "Somme d'entrée" (ex: 25 000 Ar).
    * Bouton de validation finale.

---

## 2. Dashboard Utilisateur (Tableau de Bord)
Interface principale après connexion, affichant la solution personnalisée.

### Section A : Analyse Santé
* **Affichage de l'IMC :** Calculé dynamiquement (Valeur + Interprétation couleur).
* **Graphique de variation :** Évolution du poids prévue ou réelle en fonction du temps (Chart.js).
* **Tableau Statistique :**
    * Poids cible.
    * Écart à combler.
    * Date de fin de programme estimée.

### Section B : Le Programme Proposé (Cards)
* **Card Régime Alimentaire :** * Composition : % Viande, % Poisson, % Volaille.
    * Coût total : Affichage du prix (Prix barré si Gold avec remise 15% visible).
    * Badge "Gold" si le profil est Premium.
* **Card Activités Sportives :**
    * Liste des exercices suggérés.
    * Fréquence par jour.
    * Durée et créneaux recommandés.

### Section C : Historique & Progression
* Liste chronologique des changements de poids.
* Lien avec les points du graphique.

---

## 3. Gestion financière (Porte-monnaie)
* **Interface simplifiée :**
    * Affichage du solde actuel.
    * Champ de saisie : "Entrez votre code de recharge".
    * Bouton "Valider la recharge".
    * Feedback : Notification de succès/échec (Flash Data).

---

## 4. Navigation & Bonus
* **Barre de navigation (Navbar) :** Dashboard, Mon Profil, Wallet, Déconnexion.
* **Export PDF :** Bouton flottant "Télécharger mon programme complet".
---
    une première page pour le login(avec une barre de progression)<br>
    seconde page pour entrer la taille et le profile en même temps <br>
    si gold un champs apparait pour mettre une somme d'entrée pour payer cette option <br>
    <br>
    <br>
    affichage de l'imc de l'utilisateur
    Page pour le choix de l'utilisateur garder un imc stable prise de poids ou perte 
    accès au dashboard
---

2. dashboard
*frontend :*<br>
---
    graphique de variation du poids de la personne (selon le choix eten fonction du temps mois visiblement)<br>
    tableau statistique : j'sais pas quoi mettre dedans <br>
    des cards d'affichage des pourcentages demander(ajouter un petit icône gold si profile gold + indice de remise)<br>
    historique des progression(en relation avec le graphe de variation de poids)<br>
    card d'affichage des fréquences de ces exercices avec leurs durée et heure choisi<br>
    une card qui totalise le coût du régime en fonction du temps(les N% de remise bien sur pour les profils gold) 
    un bouton qui mêne vers la section de porte monnaie(rechargement de leurs compte)
    
---

porte monnaie une simple demande de code et inscrire le montant donc update de la somme 