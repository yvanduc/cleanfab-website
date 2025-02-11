# Interface CleanFab

## 1. Interface Client
### 1.1 Système de Réservation
- Calendrier de réservation (créneaux de 15min, 7h-18h)
- Formulaire de demande
  * Sélection date/heure
  * Informations personnelles
  * Détails du véhicule
  * Message spécifique
- Notifications par email

### 1.2 Interface Multilingue
- Français (FR)
- Néerlandais (NL)

## 2. Interface Administration
### 2.1 Gestion des Réservations
- Vue calendrier des réservations
- Actions :
  * Accepter/Refuser
  * Proposer un autre créneau
  * Ajouter des notes

### 2.2 Notifications
- Système d'emails automatiques
  * Confirmation de demande
  * Acceptation/Refus
  * Proposition alternative

### 2.3 Configuration
- Gestion des créneaux horaires
- Textes multilingues
- Templates d'emails

## 3. Structure des Dossiers
```
Interface/
├── admin/
│   ├── calendar/
│   ├── bookings/
│   └── settings/
├── client/
│   ├── booking-form/
│   └── notifications/
└── languages/
    ├── fr_BE/
    └── nl_BE/
```
