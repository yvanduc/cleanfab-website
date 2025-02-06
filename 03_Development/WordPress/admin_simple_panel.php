<?php
// Ajout du menu simplifié dans WordPress
add_action('admin_menu', 'cleanfab_add_admin_menu');
function cleanfab_add_admin_menu() {
    add_menu_page(
        'CleanFab - Gestion',
        'CleanFab',
        'manage_options',
        'cleanfab-gestion',
        'cleanfab_main_page',
        'dashicons-car',
        6
    );
}

// Page principale simplifiée
function cleanfab_main_page() {
    ?>
    <div class="wrap">
        <h1>Gestion CleanFab</h1>

        <!-- Section Prix -->
        <div class="card" style="max-width: 600px; margin-bottom: 20px; padding: 20px;">
            <h2 style="margin-top: 0;">🏷️ Tarifs des services</h2>
            <form method="post" action="options.php">
                <?php settings_fields('cleanfab-pricing'); ?>
                <table class="form-table">
                    <tr>
                        <th>Nettoyage intérieur</th>
                        <td>
                            <input type="number" 
                                name="cleanfab_price_interior" 
                                value="<?php echo esc_attr(get_option('cleanfab_price_interior', '0')); ?>"
                                style="width: 100px;"> €
                        </td>
                    </tr>
                    <tr>
                        <th>Nettoyage extérieur</th>
                        <td>
                            <input type="number" 
                                name="cleanfab_price_exterior" 
                                value="<?php echo esc_attr(get_option('cleanfab_price_exterior', '0')); ?>"
                                style="width: 100px;"> €
                        </td>
                    </tr>
                    <tr>
                        <th>Formule complète</th>
                        <td>
                            <input type="number" 
                                name="cleanfab_price_complete" 
                                value="<?php echo esc_attr(get_option('cleanfab_price_complete', '0')); ?>"
                                style="width: 100px;"> €
                        </td>
                    </tr>
                </table>
                <?php submit_button('Enregistrer les prix'); ?>
            </form>
        </div>

        <!-- Section Rendez-vous -->
        <div class="card" style="max-width: 800px; padding: 20px;">
            <h2 style="margin-top: 0;">📅 Mes rendez-vous</h2>
            
            <!-- Navigation simple entre les jours -->
            <div style="margin-bottom: 20px;">
                <button class="button" onclick="changeDate(-1)">◀ Jour précédent</button>
                <input type="date" id="date-selector" style="margin: 0 10px;">
                <button class="button" onclick="changeDate(1)">Jour suivant ▶</button>
            </div>

            <!-- Liste des rendez-vous du jour -->
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>Heure</th>
                        <th>Client</th>
                        <th>Téléphone</th>
                        <th>Service</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="appointments-list">
                    <!-- Exemple de rendez-vous -->
                    <tr>
                        <td>09:00</td>
                        <td>Jean Dupont</td>
                        <td>0123456789</td>
                        <td>Nettoyage intérieur</td>
                        <td>
                            <button class="button" onclick="viewDetails(1)">Voir détails</button>
                            <button class="button button-primary" onclick="markComplete(1)">Terminé ✓</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Modal simplifié pour les détails -->
        <div id="appointment-details" style="display: none;" class="card">
            <h3>Détails du rendez-vous</h3>
            <p><strong>Client:</strong> <span id="modal-client"></span></p>
            <p><strong>Téléphone:</strong> <span id="modal-phone"></span></p>
            <p><strong>Email:</strong> <span id="modal-email"></span></p>
            <p><strong>Service:</strong> <span id="modal-service"></span></p>
            <p><strong>Message:</strong> <span id="modal-message"></span></p>
            <button class="button" onclick="closeDetails()">Fermer</button>
        </div>
    </div>

    <script>
    // JavaScript simplifié
    document.addEventListener('DOMContentLoaded', function() {
        // Initialise la date à aujourd'hui
        document.getElementById('date-selector').valueAsDate = new Date();
        loadAppointments(); // Charge les rendez-vous du jour
    });

    function loadAppointments() {
        // Chargement des rendez-vous via AJAX
    }

    function changeDate(days) {
        const dateInput = document.getElementById('date-selector');
        const currentDate = new Date(dateInput.value);
        currentDate.setDate(currentDate.getDate() + days);
        dateInput.valueAsDate = currentDate;
        loadAppointments();
    }

    function viewDetails(id) {
        // Affiche les détails du rendez-vous
        document.getElementById('appointment-details').style.display = 'block';
    }

    function closeDetails() {
        document.getElementById('appointment-details').style.display = 'none';
    }

    function markComplete(id) {
        if(confirm('Marquer ce rendez-vous comme terminé ?')) {
            // Mise à jour via AJAX
        }
    }
    </script>
    <?php
}
