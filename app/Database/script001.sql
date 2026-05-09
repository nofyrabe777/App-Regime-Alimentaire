USE regime_db;

-- Insertion des Régimes (Impact négatif = Perte, Positif = Gain)
INSERT INTO regime (nom_regime, prix_journalier, pourcentage_viande, pourcentage_volaille, pourcentage_poisson, impact_hebdo, apport_calorique) VALUES
('Régime Méditerranéen', 15000, 10, 30, 60, -0.80, 1800.00),
('Régime Hyperprotéiné', 25000, 50, 30, 20, -1.50, 1500.00),
('Cure de Masse Alpha', 35000, 40, 40, 20, 1.20, 3200.00),
-- Pour le végétarien, on met 100% en poisson (ou on peut imaginer des substituts végétaux comptés ainsi) pour valider le CHECK
('Végétarien Équilibré', 12000, 0, 0, 100, -0.50, 2000.00), 
('Régime Océanique', 22000, 0, 20, 80, -1.00, 1600.00);

-- Insertion des Activités (Catalogue général : id_utilisateur est NULL)
INSERT INTO activites (id_utilisateur, type_activite, frequence_jour, type_objectif, depense_calorique) VALUES
(NULL, 'Course à pied (Intense)', 1, 'perte', 600.00),
(NULL, 'Marche rapide', 1, 'perte', 250.00),
(NULL, 'Natation', 1, 'perte', 450.00),
(NULL, 'Musculation (Prise de masse)', 1, 'gain', 300.00),
(NULL, 'Yoga & Étirements', 1, 'maintien', 150.00);

-- Codes de Recharge (Pour tes tests Wallet)
INSERT INTO code_recharge (valeur_code, montant, est_utilise) VALUES
('RECH-100K', 100000.00, FALSE),
('RECH-50K', 50000.00, FALSE),
('GOLD-PROMO', 200000.00, FALSE);

-- Config Admin
INSERT INTO configuration_remise (pourcentage_remise, prix_option_gold) VALUES (15.00, 50000.00);