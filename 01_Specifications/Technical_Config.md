# Configuration Technique - CleanFab

## 1. Environnement de Développement
### 1.1 Accès Site de Développement
- URL : dev.cleanfab.be
- WordPress admin : /wp-admin

### 1.2 Base de Données
- Nom : u721383695_pgu2u
- Utilisateur MySQL : u721383695_wkvqP
- Hébergeur : Hostinger

### 1.3 Structure Base de Données
#### Tables WordPress Personnalisées
```sql
-- Table des Réservations
CREATE TABLE wp_cleanfab_bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_time DATETIME,
    client_name VARCHAR(100),
    client_email VARCHAR(100),
    client_phone VARCHAR(20),
    vehicle_info TEXT,
    service_type VARCHAR(50),
    status VARCHAR(20),
    notes TEXT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- Table des Créneaux Horaires
CREATE TABLE wp_cleanfab_time_slots (
    id INT AUTO_INCREMENT PRIMARY KEY,
    day_of_week INT,
    start_time TIME,
    end_time TIME,
    is_available BOOLEAN DEFAULT true
);
```

## 2. Configuration Serveur
### 2.1 Serveur Web
- Apache/Nginx sur Hostinger
- PHP 8.x requis
- Extensions PHP nécessaires :
  * mysqli
  * curl
  * gd
  * intl (pour WPML)

### 2.2 Sécurité
- SSL/HTTPS activé
- Protection contre les injections SQL
- Validation des formulaires côté serveur
- Sanitization des entrées utilisateur

### 2.3 Performance
- Cache activé
- Optimisation des images
- Compression GZIP

## 3. Emails
### 3.1 Configuration SMTP
- Serveur : smtp.hostinger.com
- Port : 587
- Authentification : TLS

### 3.2 Templates d'Emails
- Confirmation de réservation
- Notification admin
- Acceptation/Refus
- Proposition alternative