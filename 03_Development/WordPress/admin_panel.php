<?php
// Ajout du menu dans WordPress
add_action('admin_menu', 'cleanfab_add_admin_menu');
function cleanfab_add_admin_menu() {
    add_menu_page(
        'Gestion des Rendez-vous',
        'Rendez-vous',
        'manage_options',
        'cleanfab-reservations',
        'cleanfab_reservations_page',
        'dashicons-calendar-alt',
        6
    );
}

// Page principale de gestion des rendez-vous
function cleanfab_reservations_page() {
    ?>
    <div class="wrap">
        <h1>Gestion des Rendez-vous</h1>

        <!-- Onglets de navigation -->
        <nav class="nav-tab-wrapper">
            <a href="?page=cleanfab-reservations&tab=calendar" class="nav-tab <?php echo empty($_GET['tab']) || $_GET['tab'] === 'calendar' ? 'nav-tab-active' : ''; ?>">
                Calendrier
            </a>
            <a href="?page=cleanfab-reservations&tab=list" class="nav-tab <?php echo isset($_GET['tab']) && $_GET['tab'] === 'list' ? 'nav-tab-active' : ''; ?>">
                Liste des rendez-vous
            </a>
            <a href="?page=cleanfab-reservations&tab=settings" class="nav-tab <?php echo isset($_GET['tab']) && $_GET['tab'] === 'settings' ? 'nav-tab-active' : ''; ?>">
                Paramètres
            </a>
        </nav>

        <div class="tab-content">
            <?php
            $tab = isset($_GET['tab']) ? $_GET['tab'] : 'calendar';
            switch($tab) {
                case 'calendar':
                    cleanfab_display_calendar();
                    break;
                case 'list':
                    cleanfab_display_appointments_list();
                    break;
                case 'settings':
                    cleanfab_display_settings();
                    break;
            }
            ?>
        </div>
    </div>
    <?php
}

// Affichage du calendrier
function cleanfab_display_calendar() {
    ?>
    <div class="calendar-container">
        <!-- Contrôles du calendrier -->
        <div class="calendar-controls">
            <select id="calendar-view">
                <option value="month">Vue par mois</option>
                <option value="week">Vue par semaine</option>
                <option value="day">Vue par jour</option>
            </select>
            <button class="button" id="prev-period">&lt; Précédent</button>
            <span id="current-period">Février 2025</span>
            <button class="button" id="next-period">Suivant &gt;</button>
        </div>

        <!-- Calendrier -->
        <div id="calendar"></div>

        <!-- Modal pour les détails du rendez-vous -->
        <div id="appointment-modal" class="modal">
            <div class="modal-content">
                <h2>Détails du rendez-vous</h2>
                <div class="appointment-details">
                    <p><strong>Client:</strong> <span id="client-name"></span></p>
                    <p><strong>Téléphone:</strong> <span id="client-phone"></span></p>
                    <p><strong>Email:</strong> <span id="client-email"></span></p>
                    <p><strong>Service:</strong> <span id="service-type"></span></p>
                    <p><strong>Date et heure:</strong> <span id="appointment-datetime"></span></p>
                    <p><strong>Message:</strong> <span id="client-message"></span></p>
                </div>
                <div class="appointment-actions">
                    <button class="button button-primary" id="accept-appointment">Accepter</button>
                    <button class="button" id="propose-new-time">Proposer un autre créneau</button>
                    <button class="button button-secondary" id="reject-appointment">Refuser</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}

// Affichage de la liste des rendez-vous
function cleanfab_display_appointments_list() {
    ?>
    <div class="appointments-list-container">
        <!-- Filtres -->
        <div class="filters">
            <select id="status-filter">
                <option value="">Tous les statuts</option>
                <option value="pending">En attente</option>
                <option value="confirmed">Confirmés</option>
                <option value="completed">Terminés</option>
                <option value="cancelled">Annulés</option>
            </select>
            <input type="date" id="date-filter" />
            <input type="text" id="search" placeholder="Rechercher un client..." />
        </div>

        <!-- Tableau des rendez-vous -->
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Date/Heure</th>
                    <th>Client</th>
                    <th>Service</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="appointments-list">
                <!-- Rempli dynamiquement par JavaScript -->
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="tablenav">
            <div class="tablenav-pages">
                <span class="pagination-links">
                    <!-- Contrôles de pagination -->
                </span>
            </div>
        </div>
    </div>
    <?php
}

// Affichage des paramètres
function cleanfab_display_settings() {
    ?>
    <div class="settings-container">
        <form method="post" action="options.php">
            <?php settings_fields('cleanfab-settings'); ?>
            
            <h2>Horaires d'ouverture</h2>
            <table class="form-table">
                <?php
                $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
                foreach($days as $day) {
                    ?>
                    <tr>
                        <th><?php echo $day; ?></th>
                        <td>
                            <label>
                                <input type="checkbox" name="cleanfab_hours[<?php echo $day; ?>][active]" 
                                    value="1" <?php checked(get_option("cleanfab_hours_{$day}_active"), 1); ?>>
                                Ouvert
                            </label>
                            <select name="cleanfab_hours[<?php echo $day; ?>][start]">
                                <?php
                                for($i = 7; $i <= 18; $i++) {
                                    printf('<option value="%02d:00">%02d:00</option>', $i, $i);
                                }
                                ?>
                            </select>
                            à
                            <select name="cleanfab_hours[<?php echo $day; ?>][end]">
                                <?php
                                for($i = 7; $i <= 18; $i++) {
                                    printf('<option value="%02d:00">%02d:00</option>', $i, $i);
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>

            <h2>Paramètres des notifications</h2>
            <table class="form-table">
                <tr>
                    <th>Email de notification</th>
                    <td>
                        <input type="email" name="cleanfab_notification_email" 
                            value="<?php echo esc_attr(get_option('cleanfab_notification_email')); ?>" 
                            class="regular-text">
                    </td>
                </tr>
                <tr>
                    <th>Notifications SMS</th>
                    <td>
                        <label>
                            <input type="checkbox" name="cleanfab_sms_notifications" 
                                value="1" <?php checked(get_option('cleanfab_sms_notifications'), 1); ?>>
                            Activer les notifications SMS
                        </label>
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
