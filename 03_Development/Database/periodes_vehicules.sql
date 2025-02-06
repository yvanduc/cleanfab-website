-- Insertion des périodes dans l'ordre décroissant
INSERT INTO cf_periodes_vehicules (annee_debut, annee_fin, description, is_oldtimer) VALUES
(2021, 2025, 'Années 2021-2025', FALSE),
(2016, 2020, 'Années 2016-2020', FALSE),
(2011, 2015, 'Années 2011-2015', FALSE),
(2006, 2010, 'Années 2006-2010', FALSE),
(2000, 2005, 'Années 2000-2005', FALSE),
(1990, 1999, 'Années 90', FALSE),
(1980, 1989, 'Années 80', TRUE),
(1970, 1979, 'Années 70', TRUE),
(1960, 1969, 'Années 60', TRUE),
(1950, 1959, 'Années 50', TRUE),
(1940, 1949, 'Années 40', TRUE),
(1930, 1939, 'Années 30', TRUE);

-- Requête pour l'interface utilisateur (à utiliser dans le code)
SELECT id, description, is_oldtimer
FROM cf_periodes_vehicules 
ORDER BY annee_debut DESC;