# Installation et Configuration WordPress - CleanFab

## 1. Prérequis Serveur
- PHP 8.1 ou supérieur
- MySQL 5.7 ou supérieur
- HTTPS activé
- Extension PHP `intl` pour la gestion des numéros de téléphone
- Extension PHP `curl` pour les vérifications email

## 2. Thème WordPress
Nous utiliserons un thème enfant basé sur GeneratePress :
- Léger et performant
- Hautement personnalisable
- Compatible avec les constructeurs de page

## 3. Plugins Essentiels

### Sécurité et Performance
- **Wordfence Security**
  - Protection contre les attaques
  - Pare-feu WAF
  - Scans de sécurité

- **WP Rocket**
  - Cache
  - Minification CSS/JS
  - LazyLoad images

### Formulaires et Réservations
- **Contact Form 7**
  - Base pour notre formulaire de réservation personnalisé
  - Intégration AJAX
  - Validations personnalisées

### SEO et Analytics
- **Yoast SEO**
  - Optimisation SEO
  - Sitemap XML
  - Intégration réseaux sociaux

## 4. Développements Personnalisés
Les fichiers suivants devront être intégrés :
- `admin_simple_panel.php`
- `email_notifications.php`
- `form_validation.js`
- `email_verification_endpoint.php`

## 5. Étapes d'Installation

### 5.1 Installation WordPress
1. Télécharger WordPress
2. Configurer la base de données
3. Exécuter l'installation
4. Activer HTTPS

### 5.2 Installation des Plugins
```bash
# Via WP-CLI
wp plugin install wordfence --activate
wp plugin install wp-rocket --activate
wp plugin install wordpress-seo --activate
wp plugin install contact-form-7 --activate
```

### 5.3 Configuration Base de Données
1. Importer le schéma de base :
```bash
mysql -u [user] -p [database] < structure.sql
mysql -u [user] -p [database] < vehicules_structure.sql
```

### 5.4 Intégration Code Personnalisé
1. Créer un plugin personnalisé "CleanFab Core"
2. Intégrer les fichiers développés
3. Activer les endpoints API WordPress

### 5.5 Configuration Email
1. Configurer le serveur SMTP
2. Tester les notifications
3. Vérifier les templates d'emails

## 6. Tests Post-Installation

### 6.1 Tests Fonctionnels
- Formulaire de réservation
- Validations (téléphone, email)
- Notifications
- Interface admin

### 6.2 Tests de Performance
- PageSpeed Insights
- GTmetrix
- Tests de charge

### 6.3 Tests de Sécurité
- Scan Wordfence
- Test SSL
- Vérification des permissions

## 7. Maintenance

### 7.1 Sauvegardes
- Base de données : quotidienne
- Fichiers : hebdomadaire
- Conservation : 30 jours

### 7.2 Mises à jour
- WordPress Core : automatique
- Plugins : manuel après test
- Thème : manuel après test

## 8. Documentation
- Guide administrateur
- Procédures de maintenance
- Contact support