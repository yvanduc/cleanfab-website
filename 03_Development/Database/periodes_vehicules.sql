-- Insertion des périodes dans l'ordre décroissant
INSERT INTO cf_periodes_vehicules (annee_debut, annee_fin, description, is_oldtimer) VALUES
(2020, 2029, 'Années 2020', FALSE),
(2010, 2019, 'Années 2010', FALSE),
(2000, 2009, 'Années 2000', FALSE),
(1990, 1999, 'Années 90', FALSE),
(1980, 1989, 'Années 80', TRUE),
(1970, 1979, 'Années 70', TRUE),
(1960, 1969, 'Années 60', TRUE),
(1950, 1959, 'Années 50', TRUE),
(1940, 1949, 'Années 40', TRUE),
(1930, 1939, 'Années 30', TRUE);

-- Requête pour l'interface utilisateur (à utiliser dans le code)
SELECT id, description 
FROM cf_periodes_vehicules 
ORDER BY annee_debut DESC;