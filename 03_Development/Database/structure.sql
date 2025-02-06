-- Structure de la base de données CleanFab

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
    message TEXT,
    statut ENUM('en_attente', 'accepte', 'refuse') NOT NULL DEFAULT 'en_attente',
    raison_refus TEXT,
    creneau_alternatif_propose DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (service_id) REFERENCES cf_services(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table des horaires disponibles
CREATE TABLE cf_horaires (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jour_semaine TINYINT NOT NULL, -- 1=Lundi, 7=Dimanche
    heure_debut TIME NOT NULL,     -- 07:00
    heure_fin TIME NOT NULL,       -- 18:00
    intervalle_minutes INT NOT NULL DEFAULT 15,
    actif BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table des jours fériés ou fermetures exceptionnelles
CREATE TABLE cf_jours_exclus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    raison VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table des emails automatiques
CREATE TABLE cf_emails (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type_email ENUM('notification_admin', 'confirmation_client', 'refus_client') NOT NULL,
    sujet VARCHAR(255) NOT NULL,
    contenu TEXT NOT NULL,
    actif BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Données initiales pour les services
INSERT INTO cf_services (nom, description, duree_estimee_min, duree_estimee_max) VALUES
('Service 1', 'Description du service 1', 120, 240),
('Service 2', 'Description du service 2', 180, 360),
('Service 3', 'Description du service 3', 240, 480);

-- Données initiales pour les horaires
INSERT INTO cf_horaires (jour_semaine, heure_debut, heure_fin, intervalle_minutes) VALUES
(1, '07:00', '18:00', 15), -- Lundi
(2, '07:00', '18:00', 15), -- Mardi
(3, '07:00', '18:00', 15), -- Mercredi
(4, '07:00', '18:00', 15), -- Jeudi
(5, '07:00', '18:00', 15), -- Vendredi
(6, '07:00', '18:00', 15), -- Samedi
(7, '07:00', '18:00', 15); -- Dimanche