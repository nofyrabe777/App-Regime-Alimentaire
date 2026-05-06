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
    genre CHAR(1), -- 'M' ou 'F'
)ENGINE=InnoDB;

-- 2. Profil Santé (Page d'inscription 2)
CREATE TABLE profil_sante (
    id_profil INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT,
    taille DECIMAL(5,2) NOT NULL, -- Taille en mètres
    poids DECIMAL(5,2) NOT NULL, -- Poids en kg
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 3. Portefeuille (Gestion Gold et Argent)
CREATE TABLE wallet (
    id_wallet INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT,
    solde DECIMAL(10,2) DEFAULT 0.00, -- Porte-monnaie
    est_gold BOOLEAN DEFAULT FALSE, -- Option Gold à 15% de remise
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 4. Catalogue des Régimes
CREATE TABLE regime (
    id_regime INT AUTO_INCREMENT PRIMARY KEY,
    nom_regime VARCHAR(100) NOT NULL,
    prix_journalier DECIMAL(10,2) NOT NULL, -- Le prix varie selon la durée
    pourcentage_viande INT NOT NULL, --
    pourcentage_volaille INT NOT NULL, --
    pourcentage_poisson INT NOT NULL, --
    impact_poids_hebdo DECIMAL(5,2) NOT NULL, -- Ex: -1.0 pour perdre 1kg/semaine
    CHECK (pourcentage_viande + pourcentage_volaille + pourcentage_poisson = 100)
) ENGINE=InnoDB;



CREATE TABLE activites (
    id_activite INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT,
    type_activite VARCHAR(50), -- 'course', 'natation', 'cyclisme', etc.
    duree INT, -- en minutes
    date_activite DATE,
    frequence_jour INT NOT NULL, --
    type_objectif VARCHAR(20) NOT NULL, -- 'perte', 'gain', ou 'maintien'
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id_utilisateur)
)ENGINE=InnoDB;

-- 6. Suivi / Historique (Lien Utilisateur <-> Programme)
CREATE TABLE suivi_poids (
    id_suivi INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT,
    id_regime INT,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL, -- Calculée selon l'objectif
    poids_depart DECIMAL(5,2) NOT NULL,
    poids_objectif DECIMAL(5,2) NOT NULL,
    montant_paye DECIMAL(10,2) NOT NULL, -- Prix après remise Gold éventuelle
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur),
    FOREIGN KEY (id_regime) REFERENCES regime(id_regime)
) ENGINE=InnoDB;

-- ==========================================
-- ENTITÉS : BACK OFFICE
-- ==========================================

-- 7. Codes de Recharge
CREATE TABLE code_recharge (
    id_code INT AUTO_INCREMENT PRIMARY KEY,
    valeur_code VARCHAR(20) UNIQUE NOT NULL, -- Texte secret
    montant DECIMAL(10,2) NOT NULL,
    est_utilise BOOLEAN DEFAULT FALSE -- Un code est unique
) ENGINE=InnoDB;

-- 8. Paramètres Système (Remises et Prix Gold)
CREATE TABLE configuration_remise (
    id_config INT AUTO_INCREMENT PRIMARY KEY,
    pourcentage_remise DECIMAL(5,2) DEFAULT 15.00, -- Fixé à 15%
    prix_option_gold DECIMAL(10,2) NOT NULL -- Prix de l'accès Gold
) ENGINE=InnoDB;