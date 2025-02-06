<?php
// Configuration des templates d'emails
function get_email_templates() {
    return array(
        'admin_new_booking' => array(
            'subject' => 'Nouvelle réservation CleanFab',
            'message' => "Bonjour Fabian,

Une nouvelle réservation a été effectuée.

Date : {date}
Heure : {time}
Client : {name}
Téléphone : {phone}
Email : {email}

{service_info}

{additional_info}

Pour gérer cette réservation, connectez-vous à votre tableau de bord."
        ),
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

// Envoi des notifications
class CleanFab_Notifications {
    
    // Notification à Fabian pour nouvelle réservation
    public static function send_admin_notification($booking) {
        $admin_email = get_option('cleanfab_notification_email', 'fabian@cleanfab.be');
        $template = get_email_templates()['admin_new_booking'];
        
        $service_info = empty($booking['service']) ? 
            "Service : À définir lors du contact" : 
            "Service choisi : " . $booking['service'];
            
        $additional_info = empty($booking['message']) ? 
            "" : 
            "\nMessage du client :\n" . $booking['message'];
        
        $message = strtr($template['message'], array(
            '{date}' => date_i18n('l j F Y', strtotime($booking['date'])),
            '{time}' => date_i18n('H:i', strtotime($booking['time'])),
            '{name}' => $booking['name'],
            '{phone}' => $booking['phone'],
            '{email}' => $booking['email'],
            '{service_info}' => $service_info,
            '{additional_info}' => $additional_info
        ));
        
        return wp_mail($admin_email, $template['subject'], $message);
    }
    
    // Confirmation initiale au client
    public static function send_client_confirmation($booking) {
        $template = get_email_templates()['client_confirmation'];
        
        $message = strtr($template['message'], array(
            '{name}' => $booking['name'],
            '{date}' => date_i18n('l j F Y', strtotime($booking['date'])),
            '{time}' => date_i18n('H:i', strtotime($booking['time']))
        ));
        
        return wp_mail($booking['email'], $template['subject'], $message);
    }
    
    // Confirmation finale au client
    public static function send_client_approval($booking) {
        $template = get_email_templates()['client_approved'];
        
        $message = strtr($template['message'], array(
            '{name}' => $booking['name'],
            '{date}' => date_i18n('l j F Y', strtotime($booking['date'])),
            '{time}' => date_i18n('H:i', strtotime($booking['time']))
        ));
        
        return wp_mail($booking['email'], $template['subject'], $message);
    }
    
    // Proposition d'horaire alternatif
    public static function send_alternative_proposal($booking, $alternative) {
        $template = get_email_templates()['client_alternative'];
        
        $message = strtr($template['message'], array(
            '{name}' => $booking['name'],
            '{alternative_date}' => date_i18n('l j F Y', strtotime($alternative['date'])),
            '{alternative_time}' => date_i18n('H:i', strtotime($alternative['time'])),
            '{confirm_link}' => add_query_arg(array(
                'action' => 'confirm_alternative',
                'booking_id' => $booking['id'],
                'token' => wp_create_nonce('confirm_booking_' . $booking['id'])
            ), home_url()),
            '{reschedule_link}' => add_query_arg(array(
                'action' => 'reschedule',
                'booking_id' => $booking['id']
            ), home_url())
        ));
        
        return wp_mail($booking['email'], $template['subject'], $message);
    }
}

// Hooks pour les actions de réservation
add_action('cleanfab_new_booking', function($booking) {
    CleanFab_Notifications::send_admin_notification($booking);
    CleanFab_Notifications::send_client_confirmation($booking);
});

add_action('cleanfab_booking_approved', function($booking) {
    CleanFab_Notifications::send_client_approval($booking);
});

add_action('cleanfab_alternative_proposed', function($booking, $alternative) {
    CleanFab_Notifications::send_alternative_proposal($booking, $alternative);
}, 10, 2);
