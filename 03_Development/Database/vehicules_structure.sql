-- Structure pour la gestion des véhicules

-- Table des régions d'origine
CREATE TABLE cf_regions_origine (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    code VARCHAR(10) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Données initiales régions
INSERT INTO cf_regions_origine (nom, code) VALUES
('Europe', 'EU'),
('Amérique du Nord', 'NA'),
('Asie', 'AS'),
('Autre', 'OTHER');

-- Table des types de véhicules
CREATE TABLE cf_types_vehicule (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Données initiales types de véhicules
INSERT INTO cf_types_vehicule (nom, description) VALUES
('Voiture', 'Véhicules particuliers'),
('Camionnette', 'Véhicules utilitaires légers'),
('Camion', 'Poids lourds et véhicules commerciaux'),
('Mobil-home', 'Véhicules de loisirs et camping-cars'),
('Oldtimer', 'Véhicules de collection et anciens');

-- Table des marques
CREATE TABLE cf_marques (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    region_origine_id INT,
    actif BOOLEAN DEFAULT TRUE,
    validation_admin BOOLEAN DEFAULT FALSE,
    date_ajout TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (region_origine_id) REFERENCES cf_regions_origine(id)
);

-- Table des modèles
CREATE TABLE cf_modeles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    marque_id INT NOT NULL,
    nom VARCHAR(100) NOT NULL,
    type_vehicule_id INT,
    debut_production INT,
    fin_production INT,
    actif BOOLEAN DEFAULT TRUE,
    validation_admin BOOLEAN DEFAULT FALSE,
    date_ajout TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (marque_id) REFERENCES cf_marques(id),
    FOREIGN KEY (type_vehicule_id) REFERENCES cf_types_vehicule(id)
);

-- Table des suggestions d'ajout
CREATE TABLE cf_suggestions_vehicule (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type_suggestion ENUM('marque', 'modele') NOT NULL,
    marque VARCHAR(100) NOT NULL,
    modele VARCHAR(100),
    annee_production INT,
    type_vehicule_id INT,
    client_nom VARCHAR(100),
    client_email VARCHAR(255),
    statut ENUM('en_attente', 'approuve', 'refuse') DEFAULT 'en_attente',
    commentaire TEXT,
    date_suggestion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_traitement TIMESTAMP,
    FOREIGN KEY (type_vehicule_id) REFERENCES cf_types_vehicule(id)
);

-- Index pour optimiser les recherches
CREATE INDEX idx_marques_nom ON cf_marques(nom);
CREATE INDEX idx_modeles_nom ON cf_modeles(nom);
CREATE INDEX idx_modeles_production ON cf_modeles(debut_production, fin_production);

-- Procédure pour ajouter une suggestion
DELIMITER //
CREATE PROCEDURE sp_ajouter_suggestion(
    IN p_type_suggestion VARCHAR(10),
    IN p_marque VARCHAR(100),
    IN p_modele VARCHAR(100),
    IN p_annee INT,
    IN p_type_vehicule_id INT,
    IN p_client_nom VARCHAR(100),
    IN p_client_email VARCHAR(255)
)
BEGIN
    INSERT INTO cf_suggestions_vehicule (
        type_suggestion, marque, modele, annee_production,
        type_vehicule_id, client_nom, client_email
    ) VALUES (
        p_type_suggestion, p_marque, p_modele, p_annee,
        p_type_vehicule_id, p_client_nom, p_client_email
    );
END //
DELIMITER ;