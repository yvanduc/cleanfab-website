// Validation du numéro de téléphone BE/FR
function validatePhoneNumber(phone) {
    // Nettoyer le numéro
    const cleanPhone = phone.replace(/[\s.-]/g, '');

    // Formats valides
    const formats = {
        // Belgique
        be_mobile: /^(\+32|0)[456]\d{8}$/, // Ex: +32475123456 ou 0475123456
        be_fix: /^(\+32|0)[1-9]\d{7}$/, // Ex: +3224123456 ou 024123456
        
        // France
        fr_mobile: /^(\+33|0)[67]\d{8}$/, // Ex: +33612345678 ou 0612345678
        fr_fix: /^(\+33|0)[1-59]\d{8}$/ // Ex: +33123456789 ou 0123456789
    };

    const isValid = Object.values(formats).some(format => format.test(cleanPhone));
    const isValidFormat = {
        isBelgian: cleanPhone.startsWith('+32') || (cleanPhone.startsWith('0') && cleanPhone.length < 11),
        isFrench: cleanPhone.startsWith('+33') || (cleanPhone.startsWith('0') && cleanPhone.length > 10)
    };

    return {
        isValid: isValid,
        country: isValidFormat.isBelgian ? 'BE' : 'FR',
        error: !isValid ? 'Veuillez entrer un numéro de téléphone belge ou français valide' : ''
    };
}

// Formatage du numéro de téléphone pendant la saisie
function formatPhoneNumber(input) {
    let value = input.value.replace(/\D/g, '');
    let formattedValue = '';

    if (value.startsWith('32') || value.startsWith('33')) {
        value = '+' + value;
    }

    // Format selon le pays
    if (value.startsWith('+32')) {
        // Format belge: +32 XXX XX XX XX
        formattedValue = value.replace(/(\+32)(\d{3})(\d{2})(\d{2})(\d{2})/, '$1 $2 $3 $4 $5');
    } else if (value.startsWith('+33')) {
        // Format français: +33 X XX XX XX XX
        formattedValue = value.replace(/(\+33)(\d{1})(\d{2})(\d{2})(\d{2})(\d{2})/, '$1 $2 $3 $4 $5 $6');
    } else if (value.startsWith('0')) {
        // Format national
        if (value.length <= 10) { // Belgique
            formattedValue = value.replace(/(\d{4})(\d{2})(\d{2})(\d{2})/, '$1 $2 $3 $4');
        } else { // France
            formattedValue = value.replace(/(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})/, '$1 $2 $3 $4 $5');
        }
    }

    input.value = formattedValue;
}

// Validation email temps réel
async function validateEmail(email) {
    // Vérification format basique
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        return {
            isValid: false,
            error: 'Format d\'email invalide'
        };
    }

    // Extraction du domaine
    const domain = email.split('@')[1];

    // Liste des domaines temporaires à bloquer
    const disposableEmailDomains = [
        'yopmail.com', 'tempmail.com', 'guerrillamail.com', 'temp-mail.org',
        'fakeinbox.com', 'mailinator.com', '10minutemail.com'
    ];

    if (disposableEmailDomains.includes(domain.toLowerCase())) {
        return {
            isValid: false,
            error: 'Les adresses email temporaires ne sont pas acceptées'
        };
    }

    try {
        // Vérification DNS MX
        const response = await fetch(`/wp-json/cleanfab/v1/verify-email?email=${encodeURIComponent(email)}`);
        const result = await response.json();

        if (!result.hasMX) {
            return {
                isValid: false,
                error: 'Domaine email invalide'
            };
        }

        return {
            isValid: true,
            error: ''
        };
    } catch (error) {
        console.error('Erreur de vérification email:', error);
        return {
            isValid: true, // On accepte en cas d'erreur technique
            error: ''
        };
    }
}

// Gestionnaire d'événements du formulaire
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('reservation-form');
    const phoneInput = document.getElementById('phone');
    const emailInput = document.getElementById('email');
    
    // Formatage du téléphone pendant la saisie
    phoneInput.addEventListener('input', function() {
        formatPhoneNumber(this);
    });

    // Validation du téléphone à la perte du focus
    phoneInput.addEventListener('blur', function() {
        const result = validatePhoneNumber(this.value);
        const errorElement = document.getElementById('phone-error');
        
        if (!result.isValid) {
            this.classList.add('error');
            errorElement.textContent = result.error;
        } else {
            this.classList.remove('error');
            errorElement.textContent = '';
        }
    });

    // Validation de l'email avec délai
    let emailTimeout = null;
    emailInput.addEventListener('input', function() {
        clearTimeout(emailTimeout);
        const errorElement = document.getElementById('email-error');
        
        emailTimeout = setTimeout(async () => {
            const result = await validateEmail(this.value);
            
            if (!result.isValid) {
                this.classList.add('error');
                errorElement.textContent = result.error;
            } else {
                this.classList.remove('error');
                errorElement.textContent = '';
            }
        }, 500); // Délai de 500ms après la dernière frappe
    });

    // Validation du formulaire à la soumission
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const phoneResult = validatePhoneNumber(phoneInput.value);
        const emailResult = await validateEmail(emailInput.value);
        
        if (!phoneResult.isValid || !emailResult.isValid) {
            return false;
        }
        
        // Si tout est valide, on peut soumettre le formulaire
        this.submit();
    });
});