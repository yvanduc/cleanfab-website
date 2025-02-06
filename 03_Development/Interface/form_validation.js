// Génération des créneaux horaires
function generateTimeSlots() {
    const slots = [];
    let hour = 7;
    let minutes = 0;
    
    while (hour < 18 || (hour === 18 && minutes === 0)) {
        const formattedHour = hour.toString().padStart(2, '0');
        const formattedMinutes = minutes.toString().padStart(2, '0');
        slots.push(`${formattedHour}:${formattedMinutes}`);
        
        minutes += 15;
        if (minutes === 60) {
            minutes = 0;
            hour += 1;
        }
    }
    return slots;
}

// Validation du téléphone
function validateBelgianPhone(phone) {
    const cleanPhone = phone.replace(/[^\d+]/g, '');
    
    const patterns = {
        mobile: /^(\+32|0)[4-6]\d{8}$/, // Mobile belge
        fixe: /^(\+32|0)[1-9]\d{7}$/, // Fixe belge
        international: /^\+\d{8,15}$/ // International
    };
    
    return {
        isValid: Object.values(patterns).some(pattern => pattern.test(cleanPhone)),
        formattedNumber: cleanPhone,
        type: patterns.mobile.test(cleanPhone) ? 'mobile' : 
              patterns.fixe.test(cleanPhone) ? 'fixe' : 
              patterns.international.test(cleanPhone) ? 'international' : 'inconnu'
    };
}

// Messages d'erreur
const errorMessages = {
    service: {
        required: "Veuillez sélectionner un service"
    },
    vehicle: {
        type: "Veuillez sélectionner le type de véhicule",
        brand: "Veuillez sélectionner la marque",
        model: "Veuillez sélectionner le modèle",
        period: "Veuillez sélectionner la période"
    },
    datetime: {
        date: {
            required: "Veuillez choisir une date",
            past: "La date ne peut pas être dans le passé",
            weekend: "Désolé, nous ne prenons pas de réservation le dimanche"
        },
        time: {
            required: "Veuillez choisir un horaire",
            invalid: "Cet horaire n'est plus disponible"
        }
    },
    contact: {
        firstname: "Veuillez entrer votre prénom",
        lastname: "Veuillez entrer votre nom",
        phone: {
            required: "Veuillez entrer votre numéro de téléphone",
            invalid: "Le format du numéro n'est pas valide. Ex: +32 XXX XX XX XX"
        },
        email: {
            required: "Veuillez entrer votre email",
            invalid: "L'adresse email n'est pas valide"
        }
    }
};

// Affichage des erreurs
function showError(fieldId, message) {
    const field = document.getElementById(fieldId);
    const errorDiv = document.createElement('div');
    errorDiv.className = 'text-red-500 text-sm mt-1';
    errorDiv.textContent = message;
    
    // Supprime l'ancien message d'erreur s'il existe
    const existingError = field.parentNode.querySelector('.text-red-500');
    if (existingError) {
        existingError.remove();
    }
    
    field.parentNode.appendChild(errorDiv);
    field.classList.add('border-red-500');
}

// Validation du formulaire
function validateForm(event) {
    event.preventDefault();
    let isValid = true;
    
    // Valide le service
    const service = document.querySelector('input[name="service"]:checked');
    if (!service) {
        showError('service-section', errorMessages.service.required);
        isValid = false;
    }
    
    // Valide le téléphone
    const phone = document.getElementById('phone').value;
    const phoneValidation = validateBelgianPhone(phone);
    if (!phoneValidation.isValid) {
        showError('phone', errorMessages.contact.phone.invalid);
        isValid = false;
    }
    
    // Autres validations...
    
    if (isValid) {
        // Soumission du formulaire
        document.getElementById('reservation-form').submit();
    }
}

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    // Génère les créneaux horaires
    const timeSelect = document.getElementById('time-slot');
    const slots = generateTimeSlots();
    slots.forEach(slot => {
        const option = document.createElement('option');
        option.value = slot;
        option.textContent = slot;
        timeSelect.appendChild(option);
    });
    
    // Ajoute la validation au formulaire
    const form = document.getElementById('reservation-form');
    form.addEventListener('submit', validateForm);
});