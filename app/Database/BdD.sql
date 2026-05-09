-- Création de la base
DROP DATABASE IF EXISTS regime_db;
CREATE DATABASE regime_db;
USE regime_db;

-- 1. Table des Utilisateurs
CREATE TABLE utilisateurs (
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    email VARCHAR(150) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    genre CHAR(1) -- 'M' ou 'F' (virgule supprimée ici)
) ENGINE=InnoDB;

-- 2. Profil Santé
CREATE TABLE profil_sante (
    id_profil INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT,
    taille DECIMAL(5,2) NOT NULL,
    poids DECIMAL(5,2) NOT NULL,
    age INT NOT NULL,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id_utilisateur) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 3. Portefeuille
CREATE TABLE wallet (
    id_wallet INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT,
    solde DECIMAL(10,2) DEFAULT 0.00,
    est_gold BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id_utilisateur) ON DELETE CASCADE
) ENGINE=InnoDB;




-- 4. Catalogue des Régimes
CREATE TABLE regime (
    id_regime INT AUTO_INCREMENT PRIMARY KEY,
    nom_regime VARCHAR(100) NOT NULL,
    prix_journalier DECIMAL(10,2) NOT NULL,
    pourcentage_viande INT NOT NULL,
    pourcentage_volaille INT NOT NULL,
    pourcentage_poisson INT NOT NULL,
    apport_calorique DECIMAL(7,2) NOT NULL,
    CHECK (pourcentage_viande + pourcentage_volaille + pourcentage_poisson = 100)
) ENGINE=InnoDB;

-- 5. Activités
CREATE TABLE activites (
    id_activite INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT, -- Peut être NULL pour le catalogue général, ou lié pour l'historique
    type_activite VARCHAR(50), 
    duree INT, 
    date_activite DATE,
    frequence_jour INT NOT NULL,
    type_objectif VARCHAR(20) NOT NULL,
    depense_calorique DECIMAL(5,2) NOT NULL,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id_utilisateur)
) ENGINE=InnoDB;




-- 6. Suivi / Historique
CREATE TABLE suivi_poids (
    id_suivi INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT,
    id_regime INT,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    poids_depart DECIMAL(5,2) NOT NULL,
    poids_objectif DECIMAL(5,2) NOT NULL,
    montant_paye DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id_utilisateur),
    FOREIGN KEY (id_regime) REFERENCES regime(id_regime)
) ENGINE=InnoDB;

-- 7. Codes de Recharge
CREATE TABLE code_recharge (
    id_code INT AUTO_INCREMENT PRIMARY KEY,
    valeur_code VARCHAR(20) UNIQUE NOT NULL,
    montant DECIMAL(10,2) NOT NULL,
    est_utilise BOOLEAN DEFAULT FALSE
) ENGINE=InnoDB;

-- 8. Paramètres Système
CREATE TABLE configuration_remise (
    id_config INT AUTO_INCREMENT PRIMARY KEY,
    pourcentage_remise DECIMAL(5,2) DEFAULT 15.00,
    prix_option_gold DECIMAL(10,2) NOT NULL
) ENGINE=InnoDB;