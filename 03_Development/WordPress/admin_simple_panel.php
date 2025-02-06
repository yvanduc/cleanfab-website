<!-- Section Absences/Congés -->
<div class="card" style="max-width: 600px; margin-top: 20px; padding: 20px;">
    <h2 style="margin-top: 0;">🌴 Mes absences</h2>
    
    <!-- Formulaire d'ajout d'absence -->
    <form method="post" action="admin-post.php">
        <table class="form-table">
            <tr>
                <th>Date</th>
                <td>
                    <input type="date" name="absence_date" required 
                           style="width: 150px;" min="<?php echo date('Y-m-d'); ?>">
                </td>
            </tr>
            <tr>
                <th>Type d'absence</th>
                <td>
                    <label style="display: block; margin-bottom: 10px;">
                        <input type="radio" name="absence_type" value="full_day" checked 
                               onchange="toggleTimeSelection(this)"> 
                        Journée entière
                    </label>
                    <label style="display: block;">
                        <input type="radio" name="absence_type" value="partial_day"
                               onchange="toggleTimeSelection(this)"> 
                        Plage horaire spécifique
                    </label>
                </td>
            </tr>
            <tr id="time_selection" style="display: none;">
                <th>Horaires</th>
                <td>
                    <select name="absence_start_time" style="width: 100px;">
                        <?php
                        for ($hour = 7; $hour <= 18; $hour++) {
                            for ($min = 0; $min < 60; $min += 30) {
                                $time = sprintf("%02d:%02d", $hour, $min);
                                echo "<option value='{$time}'>{$time}</option>";
                            }
                        }
                        ?>
                    </select>
                    à
                    <select name="absence_end_time" style="width: 100px;">
                        <?php
                        for ($hour = 7; $hour <= 18; $hour++) {
                            for ($min = 0; $min < 60; $min += 30) {
                                $time = sprintf("%02d:%02d", $hour, $min);
                                echo "<option value='{$time}'>{$time}</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Raison</th>
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
                    <th>Date</th>
                    <th>Horaires</th>
                    <th>Raison</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $absences = get_option('cleanfab_absences', array());
                foreach($absences as $key => $absence) {
                    $date = date('d/m/Y', strtotime($absence['date']));
                    $hours = $absence['type'] === 'full_day' 
                        ? 'Toute la journée'
                        : "{$absence['start_time']} à {$absence['end_time']}";
                    
                    echo "<tr>
                            <td>{$date}</td>
                            <td>{$hours}</td>
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
function toggleTimeSelection(radio) {
    const timeSelection = document.getElementById('time_selection');
    timeSelection.style.display = radio.value === 'partial_day' ? 'table-row' : 'none';
}

// Validation des horaires
document.addEventListener('DOMContentLoaded', function() {
    const startTimeSelect = document.querySelector('select[name="absence_start_time"]');
    const endTimeSelect = document.querySelector('select[name="absence_end_time"]');

    startTimeSelect.addEventListener('change', function() {
        const startTime = this.value;
        const endTime = endTimeSelect.value;
        
        // Désactive les options d'heure de fin antérieures à l'heure de début
        Array.from(endTimeSelect.options).forEach(option => {
            option.disabled = option.value <= startTime;
        });

        // Si l'heure de fin est antérieure à l'heure de début, la réinitialise
        if (endTime <= startTime) {
            // Sélectionne la prochaine demi-heure disponible
            for (let option of endTimeSelect.options) {
                if (!option.disabled) {
                    endTimeSelect.value = option.value;
                    break;
                }
            }
        }
    });
});
</script>