[Contenu précédent inchangé jusqu'aux modèles Volkswagen Oldtimer]

-- Modèles Coccinelle détaillés
INSERT INTO cf_modeles (marque_id, nom, type_vehicule_id, debut_production, fin_production, actif, validation_admin) VALUES
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Coccinelle Type 1', 1, 1938, 1957, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Coccinelle 1200', 1, 1954, 1973, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Coccinelle 1300', 1, 1965, 1973, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Coccinelle 1500', 1, 1967, 1974, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Coccinelle Cabriolet', 1, 1949, 1980, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Coccinelle 1302', 1, 1970, 1972, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Coccinelle 1303', 1, 1972, 1975, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Coccinelle Mexico', 1, 1975, 2003, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Coccinelle Ovale', 1, 1953, 1957, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Super Beetle', 1, 1971, 1975, true, true),
-- Éditions spéciales notables
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Coccinelle Ultima Edicion', 1, 2003, 2003, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Coccinelle Jeans', 1, 1974, 1975, true, true),
((SELECT id FROM cf_marques WHERE nom = 'Volkswagen Classic' LIMIT 1), 'Coccinelle Jubilé', 1, 1985, 1985, true, true);