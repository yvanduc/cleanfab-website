# Formulaire de Réservation - Contact Form 7

## Code du Formulaire

```html
<div class="reservation-form">
    <h3>Réservation de service</h3>

    <div class="date-time">
        [date* date-reservation min:today placeholder "Date souhaitée"]
        [select* heure-reservation "7:00" "7:15" "7:30" "7:45" "8:00" "8:15" "8:30" "8:45" "9:00" "9:15" "9:30" "9:45" "10:00" "10:15" "10:30" "10:45" "11:00" "11:15" "11:30" "11:45" "12:00" "12:15" "12:30" "12:45" "13:00" "13:15" "13:30" "13:45" "14:00" "14:15" "14:30" "14:45" "15:00" "15:15" "15:30" "15:45" "16:00" "16:15" "16:30" "16:45" "17:00" "17:15" "17:30" "17:45" "18:00"]
    </div>

    <div class="service-type">
        [select* service "Nettoyage Intérieur" "Nettoyage Extérieur" "Nettoyage Complet"]
    </div>

    <div class="personal-info">
        [text* nom placeholder "Votre nom"]
        [email* email placeholder "Votre email"]
        [tel* telephone placeholder "Votre téléphone"]
    </div>

    <div class="vehicle-info">
        [text* marque-vehicule placeholder "Marque du véhicule"]
        [text* modele-vehicule placeholder "Modèle du véhicule"]
    </div>

    <div class="message">
        [textarea message placeholder "Message ou demande particulière"]
    </div>

    [submit "Envoyer la demande"]
</div>
```

## Configuration Email Admin

```
Sujet: Nouvelle réservation de [nom] pour le [date-reservation]

Corps:
Nouvelle demande de réservation

Date: [date-reservation]
Heure: [heure-reservation]
Service: [service]

Client:
Nom: [nom]
Email: [email]
Téléphone: [telephone]

Véhicule:
Marque: [marque-vehicule]
Modèle: [modele-vehicule]

Message:
[message]
```

## Configuration Email Client

```
Sujet: Confirmation de votre demande de réservation - CleanFab

Corps:
Bonjour [nom],

Nous avons bien reçu votre demande de réservation pour le [date-reservation] à [heure-reservation].

Détails de votre réservation :
- Service demandé : [service]
- Véhicule : [marque-vehicule] [modele-vehicule]

Nous vous contacterons dans les plus brefs délais pour confirmer votre réservation.

Cordialement,
L'équipe CleanFab
```

## CSS Personnalisé (à ajouter dans le thème)

```css
.reservation-form {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
}

.reservation-form > div {
    margin-bottom: 20px;
}

.reservation-form input[type="text"],
.reservation-form input[type="email"],
.reservation-form input[type="tel"],
.reservation-form input[type="date"],
.reservation-form select,
.reservation-form textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.reservation-form input[type="submit"] {
    background-color: #0066cc;
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.reservation-form input[type="submit"]:hover {
    background-color: #0052a3;
}
```
