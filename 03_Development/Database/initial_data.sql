-- Modèles Coccinelle simplifiés
INSERT INTO cf_modeles (marque_id, nom, type_vehicule_id, debut_production, fin_production, actif, validation_admin) VALUES
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Coccinelle Standard', 1, 1938, 1980, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Coccinelle Cabriolet', 1, 1949, 1980, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Coccinelle Ovale', 1, 1953, 1957, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Super Beetle', 1, 1971, 1975, true, true);

-- Autres modèles Volkswagen Classic inchangés
INSERT INTO cf_modeles (marque_id, nom, type_vehicule_id, debut_production, fin_production, actif, validation_admin) VALUES
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Combi T1', 2, 1950, 1967, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Combi T2', 2, 1967, 1979, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Karmann Ghia', 1, 1955, 1974, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Type 3', 1, 1961, 1973, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Type 181', 1, 1968, 1983, true, true);