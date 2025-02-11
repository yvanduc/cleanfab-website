# Workflow - CleanFab

## 1. Processus de Réservation
### 1.1 Côté Client
1. **Sélection du Créneau**
   - Consultation du calendrier
   - Choix date/heure (créneaux 15min)
   - Sélection du service

2. **Soumission du Formulaire**
   - Informations personnelles
   - Détails du véhicule
   - Message spécifique

3. **Notifications Client**
   - Email de confirmation de demande
   - Email de statut (accepté/refusé)
   - Email de proposition alternative

### 1.2 Côté Administration
1. **Réception Demande**
   - Notification email instantanée
   - Affichage dans le dashboard

2. **Traitement**
   - Vérification disponibilité
   - Consultation historique client
   - Décision (accepter/refuser)

3. **Suivi**
   - Mise à jour statut
   - Envoi notification client
   - Ajout notes internes

## 2. Gestion des Emails
### 2.1 Types d'Emails
1. **Emails Client**
   ```
   ├── confirmation_demande
   │   ├── FR
   │   └── NL
   ├── reservation_acceptee
   │   ├── FR
   │   └── NL
   ├── reservation_refusee
   │   ├── FR
   │   └── NL
   └── proposition_alternative
       ├── FR
       └── NL
   ```

2. **Emails Administration**
   ```
   ├── nouvelle_reservation
   ├── rappel_traitement
   └── resume_journalier
   ```

### 2.2 Paramètres Variables
- {CLIENT_NAME}
- {DATE_RESERVATION}
- {HEURE_RESERVATION}
- {SERVICE_TYPE}
- {VEHICLE_INFO}
- {ADMIN_NOTE}

## 3. Validation Multilingue
### 3.1 Interface
- **Menu Principal**
  * FR : Menu principal
  * NL : Hoofdmenu

- **Formulaire Réservation**
  * FR : Formulaire de réservation
  * NL : Reserveringsformulier

- **Messages Système**
  * FR : Messages système
  * NL : Systeemberichten

### 3.2 Processus de Traduction
1. **Extraction des Chaînes**
   - WordPress gettext
   - WPML String Translation

2. **Traduction**
   - Interface WPML
   - Export/Import XLIFF

3. **Validation**
   - Relecture native
   - Test contextuel

### 3.3 Points d'Attention
- Longueur variable des textes
- Formatage des dates
- Expressions idiomatiques
- Tons et registres de langue