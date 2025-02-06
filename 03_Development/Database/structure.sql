-- Structure de la base de données CleanFab

-- Table des périodes de véhicules
CREATE TABLE cf_periodes_vehicules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    annee_debut INT NOT NULL,
    annee_fin INT NOT NULL,
    description VARCHAR(50) NOT NULL,
    is_oldtimer BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table des services proposés
CREATE TABLE cf_services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    duree_estimee_min INT COMMENT 'Durée minimale estimée en minutes (à titre indicatif)',
    duree_estimee_max INT COMMENT 'Durée maximale estimée en minutes (à titre indicatif)',
    actif BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table des réservations
CREATE TABLE cf_reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    service_id INT NOT NULL,
    date_reservation DATE NOT NULL,
    heure_debut TIME NOT NULL,
    duree_prevue INT COMMENT 'Durée prévue en minutes, à définir par l''administrateur',
    client_nom VARCHAR(100) NOT NULL,
    client_prenom VARCHAR(100) NOT NULL,
    client_email VARCHAR(255) NOT NULL,
    client_telephone VARCHAR(20) NOT NULL,
    vehicule_marque VARCHAR(50) NOT NULL,
    vehicule_modele VARCHAR(50) NOT NULL,
    vehicule_periode_id INT NOT NULL,
    message TEXT,
    statut ENUM('en_attente', 'accepte', 'refuse') NOT NULL DEFAULT 'en_attente',
    raison_refus TEXT,
    creneau_alternatif_propose DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (service_id) REFERENCES cf_services(id),
    FOREIGN KEY (vehicule_periode_id) REFERENCES cf_periodes_vehicules(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

[Autres tables inchangées...]

-- Données initiales pour les périodes de véhicules
INSERT INTO cf_periodes_vehicules (annee_debut, annee_fin, description, is_oldtimer) VALUES
(1950, 1959, 'Années 50', TRUE),
(1960, 1969, 'Années 60', TRUE),
(1970, 1979, 'Années 70', TRUE),
(1980, 1989, 'Années 80', TRUE),
(1990, 1999, 'Années 90', FALSE),
(2000, 2009, 'Années 2000', FALSE),
(2010, 2019, 'Années 2010', FALSE),
(2020, 2029, 'Années 2020', FALSE);

[Autres données initiales inchangées...]