[Code précédent inchangé jusqu'à la section des rendez-vous]

        <!-- Section Absences/Congés -->
        <div class="card" style="max-width: 600px; margin-top: 20px; padding: 20px;">
            <h2 style="margin-top: 0;">🌴 Mes absences</h2>
            
            <!-- Formulaire d'ajout d'absence -->
            <form method="post" action="admin-post.php">
                <table class="form-table">
                    <tr>
                        <th>Du</th>
                        <td>
                            <input type="date" name="absence_start" required 
                                   style="width: 150px;" min="<?php echo date('Y-m-d'); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>Au</th>
                        <td>
                            <input type="date" name="absence_end" required 
                                   style="width: 150px;" min="<?php echo date('Y-m-d'); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>Raison (optionnel)</th>
                        <td>
                            <select name="absence_reason" style="width: 200px;">
                                <option value="vacances">Vacances</option>
                                <option value="formation">Formation</option>
                                <option value="meeting">Meeting/Salon</option>
                                <option value="autre">Autre</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <p>
                    <button type="submit" class="button button-primary" style="margin-top: 10px;">
                        Ajouter cette absence
                    </button>
                </p>
            </form>

            <!-- Liste des absences prévues -->
            <div style="margin-top: 20px;">
                <h3>Absences prévues</h3>
                <table class="wp-list-table widefat fixed striped">
                    <thead>
                        <tr>
                            <th>Dates</th>
                            <th>Raison</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Les absences seront listées ici -->
                        <?php
                        $absences = get_option('cleanfab_absences', array());
                        foreach($absences as $key => $absence) {
                            $start = date('d/m/Y', strtotime($absence['start']));
                            $end = date('d/m/Y', strtotime($absence['end']));
                            echo "<tr>
                                    <td>{$start} au {$end}</td>
                                    <td>{$absence['reason']}</td>
                                    <td>
                                        <button class='button button-small' 
                                                onclick='deleteAbsence({$key})'>
                                            Supprimer
                                        </button>
                                    </td>
                                </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <script>
        // Validation des dates d'absence
        document.addEventListener('DOMContentLoaded', function() {
            const startInput = document.querySelector('input[name="absence_start"]');
            const endInput = document.querySelector('input[name="absence_end"]');

            startInput.addEventListener('change', function() {
                endInput.min = this.value; // La date de fin ne peut pas être avant la date de début
                if(endInput.value && endInput.value < this.value) {
                    endInput.value = this.value;
                }
            });

            // Confirmation avant suppression
            window.deleteAbsence = function(id) {
                if(confirm('Voulez-vous vraiment supprimer cette absence ?')) {
                    // Appel AJAX pour supprimer l'absence
                    // À implémenter
                }
            }
        });
        </script>

[Code des fonctions PHP à ajouter]

<?php
// Sauvegarde d'une nouvelle absence
function save_absence() {
    if (!current_user_can('manage_options')) {
        return;
    }

    $absences = get_option('cleanfab_absences', array());
    $new_absence = array(
        'start' => sanitize_text_field($_POST['absence_start']),
        'end' => sanitize_text_field($_POST['absence_end']),
        'reason' => sanitize_text_field($_POST['absence_reason'])
    );

    $absences[] = $new_absence;
    update_option('cleanfab_absences', $absences);

    // Redirection avec message de succès
    wp_redirect(add_query_arg(
        'message', 
        'absence-added', 
        admin_url('admin.php?page=cleanfab-gestion')
    ));
    exit;
}
add_action('admin_post_save_absence', 'save_absence');

// Suppression d'une absence
function delete_absence() {
    if (!current_user_can('manage_options')) {
        return;
    }

    $id = intval($_POST['absence_id']);
    $absences = get_option('cleanfab_absences', array());

    if(isset($absences[$id])) {
        unset($absences[$id]);
        update_option('cleanfab_absences', array_values($absences));
        wp_send_json_success();
    } else {
        wp_send_json_error();
    }
}
add_action('wp_ajax_delete_absence', 'delete_absence');
