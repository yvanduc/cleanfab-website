-- Insertion des données initiales

-- Insertion des marques modernes (post-1990)
INSERT INTO cf_marques (nom, region_origine_id, actif, validation_admin) VALUES
-- Marques européennes courantes
('Volkswagen', 1, true, true),  -- Placé en premier car très courant en BE
('Renault', 1, true, true),
('Peugeot', 1, true, true),
('Citroën', 1, true, true),
('BMW', 1, true, true),
('Mercedes-Benz', 1, true, true),
('Audi', 1, true, true),
('Opel', 1, true, true),
('Ford Europe', 1, true, true),
('SEAT', 1, true, true),
('Škoda', 1, true, true),
('Fiat', 1, true, true),
-- Marques asiatiques courantes
('Toyota', 3, true, true),
('Hyundai', 3, true, true),
('Kia', 3, true, true),
('Nissan', 3, true, true),
('Honda', 3, true, true);

-- Insertion des modèles Volkswagen modernes
INSERT INTO cf_modeles (marque_id, nom, type_vehicule_id, debut_production, fin_production, actif, validation_admin) VALUES
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen' LIMIT 1), 'Golf', 1, 1974, NULL, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen' LIMIT 1), 'Polo', 1, 1975, NULL, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen' LIMIT 1), 'Passat', 1, 1973, NULL, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen' LIMIT 1), 'Tiguan', 1, 2007, NULL, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen' LIMIT 1), 'T-Roc', 1, 2017, NULL, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen' LIMIT 1), 'ID.3', 1, 2020, NULL, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen' LIMIT 1), 'ID.4', 1, 2021, NULL, true, true);

-- Insertion des marques Oldtimer (pré-1990)
INSERT INTO cf_marques (nom, region_origine_id, actif, validation_admin) VALUES
-- Volkswagen en premier pour les oldtimers
('Volkswagen Classic', 1, true, true),  -- Section spéciale pour les modèles classiques
-- Autres marques européennes classiques
('Alfa Romeo', 1, true, true),
('Jaguar', 1, true, true),
('Porsche', 1, true, true),
('Triumph', 1, true, true),
('MG', 1, true, true),
-- Américaines classiques
('Chevrolet', 2, true, true),
('Ford America', 2, true, true),
('Cadillac', 2, true, true),
('Pontiac', 2, true, true),
('Dodge', 2, true, true);

-- Insertion des modèles Volkswagen Oldtimer
INSERT INTO cf_modeles (marque_id, nom, type_vehicule_id, debut_production, fin_production, actif, validation_admin) VALUES
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Coccinelle', 1, 1938, 2003, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Combi T1', 2, 1950, 1967, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Combi T2', 2, 1967, 1979, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Karmann Ghia', 1, 1955, 1974, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Type 3', 1, 1961, 1973, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Type 181', 1, 1968, 1983, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Golf MK1', 1, 1974, 1983, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Golf MK2', 1, 1983, 1992, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Scirocco MK1', 1, 1974, 1981, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Passat B1', 1, 1973, 1981, true, true);