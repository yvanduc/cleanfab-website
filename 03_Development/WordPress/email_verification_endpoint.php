<?php
// Endpoint de vérification email
add_action('rest_api_init', function () {
    register_rest_route('cleanfab/v1', '/verify-email', array(
        'methods' => 'GET',
        'callback' => 'cleanfab_verify_email',
        'permission_callback' => '__return_true'
    ));
});

function cleanfab_verify_email($request) {
    $email = $request->get_param('email');
    
    // Vérification format basique
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return new WP_REST_Response(['isValid' => false, 'hasMX' => false], 200);
    }

    // Extraction du domaine
    $domain = substr(strrchr($email, "@"), 1);
    
    // Vérification DNS MX
    $hasMX = checkdnsrr($domain, 'MX');
    
    return new WP_REST_Response([
        'isValid' => true,
        'hasMX' => $hasMX
    ], 200);
}