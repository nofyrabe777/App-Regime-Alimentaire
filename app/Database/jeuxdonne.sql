-- Configuration (Remise 15% demandée)
INSERT INTO configuration_remise (pourcentage_remise, prix_option_gold) 
VALUES (15.00, 25000.00);

-- 15 Codes de recharge
INSERT INTO code_recharge (valeur_code, montant) VALUES 
('CODE10_1', 10000), ('CODE10_2', 10000), ('CODE10_3', 10000), ('CODE10_4', 10000), ('CODE10_5', 10000),
('CODE20_1', 20000), ('CODE20_2', 20000), ('CODE20_3', 20000), ('CODE20_4', 20000), ('CODE20_5', 20000),
('CODE50_1', 50000), ('CODE50_2', 50000), ('CODE50_3', 50000), ('CODE50_4', 50000), ('CODE50_5', 50000);

-- 5 Régimes (Impact positif = Gain, négatif = Perte)
INSERT INTO regime (nom_regime, prix_journalier, pourcentage_viande, pourcentage_volaille, pourcentage_poisson, impact_poids_hebdo) VALUES 
('Sèche Intense', 12000, 20, 20, 60, -1.20),
('Équilibre Tonus', 10000, 30, 40, 30, -0.50),
('Masse Musculaire', 15000, 50, 25, 25, 1.00),
('Végé-Poisson', 9000, 0, 30, 70, -0.30),
('Carnivore Bulk', 20000, 60, 30, 10, 1.50);

-- 5 Utilisateurs
INSERT INTO utilisateurs (nom, email, mot_de_passe, genre) VALUES 
('Jean', 'jean@itmail.mg', 'pass123', 'M'),
('Moi', 'Moi@itmail.mg', 'pass123', 'F'),
('Rindra', 'rindra@itmail.mg', 'pass123', 'M'),
('Soa', 'soa@itmail.mg', 'pass123', 'F'),
('Rakoto', 'rakoto@itmail.mg', 'pass123', 'M');

-- Profils Santé correspondants
INSERT INTO profil_sante (id_utilisateur, taille, poids) VALUES 
(1, 1.75, 80.00), 
(2, 1.60, 50.00), 
(3, 1.80, 95.00), 
(4, 1.65, 55.00), 
(5, 1.70, 70.00);

-- Wallets correspondants
INSERT INTO wallet (id_utilisateur, solde, est_gold) VALUES 
(1, 0.00, FALSE), (2, 30000.00, TRUE), (3, 15000.00, FALSE), (4, 50000.00, FALSE), (5, 5000.00, FALSE);

-- Activités types (Exemples)
INSERT INTO activites (id_utilisateur, type_activite, duree, date_activite, frequence_jour, type_objectif) VALUES 
(NULL, 'Course à pied', 30, NULL, 1, 'perte'),
(NULL, 'Natation', 45, NULL, 1, 'perte'),
(NULL, 'Musculation', 60, NULL, 1, 'gain'),
(NULL, 'Yoga', 40, NULL, 1, 'maintien'),
(NULL, 'Cyclisme', 50, NULL, 2, 'perte');