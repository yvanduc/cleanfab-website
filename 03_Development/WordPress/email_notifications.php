<?php
// Configuration des templates d'emails
function get_email_templates() {
    return array(
        'admin_new_booking' => array(
            'subject' => 'Nouvelle réservation CleanFab',
            'message' => "NOUVELLE RÉSERVATION

Date : {date}
Heure : {time}
Client : {name}
Téléphone : {phone}
Email : {email}

{service_info}

{additional_info}"
        ),
        
        // [Autres templates inchangés...]
        'client_confirmation' => array(
            'subject' => 'Confirmation de votre demande - CleanFab',
            'message' => "Bonjour {name},

Nous avons bien reçu votre demande de rendez-vous.

Date : {date}
Heure : {time}

Fabian vous contactera rapidement pour confirmer ce rendez-vous.

À bientôt chez CleanFab !"
        ),
        'client_approved' => array(
            'subject' => 'Votre rendez-vous est confirmé - CleanFab',
            'message' => "Bonjour {name},

Votre rendez-vous est confirmé pour le :
Date : {date}
Heure : {time}

Adresse : [Adresse du garage]

À bientôt !
L'équipe CleanFab"
        ),
        'client_alternative' => array(
            'subject' => 'Proposition d\'horaire alternatif - CleanFab',
            'message' => "Bonjour {name},

Malheureusement, l'horaire demandé n'est pas disponible.
Nous vous proposons le créneau suivant :

Date : {alternative_date}
Heure : {alternative_time}

Pour accepter ce nouveau créneau, cliquez ici : {confirm_link}
Pour choisir un autre horaire, cliquez ici : {reschedule_link}

Merci de votre compréhension.
L'équipe CleanFab"
        )
    );
}

[Reste du code inchangé...]