import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// ===== FONCTIONS GLOBALES =====

// Animation au scroll
function animateOnScroll() {
    const elements = document.querySelectorAll('.animate-on-scroll');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
            }
        });
    });
    
    elements.forEach(element => {
        observer.observe(element);
    });
}

// Smooth scroll pour les liens d'ancrage
function setupSmoothScroll() {
    const links = document.querySelectorAll('a[href^="#"]');
    
    links.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const target = document.querySelector(link.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// Menu mobile responsive
function setupMobileMenu() {
    const menuToggle = document.querySelector('.menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    
    if (menuToggle && navMenu) {
        menuToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
            menuToggle.classList.toggle('active');
        });
    }
}

// Animation des statistiques
function animateStats() {
    const statNumbers = document.querySelectorAll('.stat-number');
    
    statNumbers.forEach(stat => {
        const target = parseInt(stat.getAttribute('data-target'));
        const duration = 2000;
        const increment = target / (duration / 16);
        let current = 0;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            stat.textContent = Math.floor(current);
        }, 16);
    });
}

// ===== FONCTIONS DU FORMULAIRE D'INSCRIPTION =====

// Initialisation du formulaire
function setupInscriptionForm() {
    const form = document.getElementById('inscription-form');
    if (!form) return;
    
    setupFormValidation();
    setupFormSubmission();
    setupDynamicValidation();
}

// Configuration de la validation
function setupFormValidation() {
    const form = document.getElementById('inscription-form');
    const inputs = form.querySelectorAll('input, select, textarea');
    
    inputs.forEach(input => {
        input.addEventListener('blur', validateField);
        input.addEventListener('input', clearFieldError);
    });
}

// Configuration de la soumission
function setupFormSubmission() {
    const form = document.getElementById('inscription-form');
    form.addEventListener('submit', handleFormSubmission);
}

// Configuration de la validation dynamique
function setupDynamicValidation() {
    const emailInput = document.getElementById('email');
    const phoneInput = document.getElementById('phone');
    
    if (emailInput) {
        emailInput.addEventListener('input', (e) => {
            if (e.target.value) {
                validateEmail(e.target.value);
            }
        });
    }
    
    if (phoneInput) {
        phoneInput.addEventListener('input', (e) => {
            if (e.target.value) {
                formatPhoneNumber(e.target);
            }
        });
    }
}

// Gestion de la soumission
function handleFormSubmission(e) {
    e.preventDefault();
    
    if (validateForm()) {
        submitForm();
    } else {
        showNotification('Veuillez corriger les erreurs avant de soumettre', 'error');
        scrollToFirstError();
    }
}

// Validation du formulaire complet
function validateForm() {
    const requiredFields = document.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!validateField({ target: field })) {
            isValid = false;
        }
    });
    
    if (!validateTerms()) {
        isValid = false;
    }
    
    return isValid;
}

// Validation d'un champ
function validateField(event) {
    const field = event.target;
    const value = field.value.trim();
    const fieldName = field.name;
    
    let isValid = true;
    let errorMessage = '';
    
    switch (fieldName) {
        case 'first_name':
        case 'last_name':
        case 'company_name':
            if (value.length < 2) {
                isValid = false;
                errorMessage = 'Ce champ doit contenir au moins 2 caractères';
            }
            break;
            
        case 'email':
            if (!isValidEmail(value)) {
                isValid = false;
                errorMessage = 'Veuillez entrer une adresse email valide';
            }
            break;
            
        case 'phone':
            if (!isValidPhone(value)) {
                isValid = false;
                errorMessage = 'Veuillez entrer un numéro de téléphone valide';
            }
            break;
            
        case 'activity_type':
            if (!value) {
                isValid = false;
                errorMessage = 'Veuillez sélectionner un type d\'activité';
            }
            break;
            
        case 'specialties':
            if (value.length < 10) {
                isValid = false;
                errorMessage = 'Veuillez décrire vos spécialités (minimum 10 caractères)';
            }
            break;
            
        case 'description':
            if (value.length < 50) {
                isValid = false;
                errorMessage = 'Veuillez fournir une description détaillée (minimum 50 caractères)';
            }
            break;
            
        case 'password':
            if (value.length < 8) {
                isValid = false;
                errorMessage = 'Le mot de passe doit contenir au moins 8 caractères';
            }
            break;
            
        case 'password_confirmation':
            const password = document.getElementById('password').value;
            if (value !== password) {
                isValid = false;
                errorMessage = 'Les mots de passe ne correspondent pas';
            }
            break;
    }
    
    if (!isValid) {
        showFieldError(field, errorMessage);
    } else {
        clearFieldError(field);
    }
    
    return isValid;
}

// Validation de l'email
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Validation du téléphone
function isValidPhone(phone) {
    const phoneRegex = /^[\+]?[0-9\s\-\(\)]{8,}$/;
    return phoneRegex.test(phone);
}

// Formatage du numéro de téléphone
function formatPhoneNumber(input) {
    let value = input.value.replace(/\D/g, '');
    
    if (value.length > 0) {
        if (value.startsWith('229')) {
            value = '+' + value;
        } else if (value.startsWith('0')) {
            value = '+229' + value.substring(1);
        } else if (!value.startsWith('+')) {
            value = '+229' + value;
        }
    }
    
    input.value = value;
}

// Validation des conditions
function validateTerms() {
    const termsCheckbox = document.getElementById('terms');
    const privacyCheckbox = document.getElementById('privacy');
    
    if (!termsCheckbox || !termsCheckbox.checked) {
        if (termsCheckbox) showFieldError(termsCheckbox, 'Vous devez accepter les conditions générales');
        return false;
    }
    
    if (!privacyCheckbox || !privacyCheckbox.checked) {
        if (privacyCheckbox) showFieldError(privacyCheckbox, 'Vous devez accepter la politique de confidentialité');
        return false;
    }
    
    return true;
}

// Affichage de l'erreur d'un champ
function showFieldError(field, message) {
    clearFieldError(field);
    
    field.classList.add('error');
    
    const errorDiv = document.createElement('div');
    errorDiv.className = 'field-error';
    errorDiv.textContent = message;
    
    field.parentNode.appendChild(errorDiv);
}

// Effacement de l'erreur d'un champ
function clearFieldError(field) {
    field.classList.remove('error');
    
    const errorDiv = field.parentNode.querySelector('.field-error');
    if (errorDiv) {
        errorDiv.remove();
    }
}

// Soumission du formulaire
function submitForm() {
    const form = document.getElementById('inscription-form');
    const submitBtn = form.querySelector('.btn-primary');
    
    // Afficher l'état de chargement
    submitBtn.classList.add('loading');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Envoi en cours...';
    
    // Le formulaire sera soumis normalement par Laravel
    // Cette fonction peut être utilisée pour des validations supplémentaires
    // ou des actions avant soumission
}

// Défilement vers la première erreur
function scrollToFirstError() {
    const firstError = document.querySelector('.form-group.error');
    if (firstError) {
        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
}

// ===== FONCTIONS DE LA PAGE PROGRAMME =====

// Variables globales pour le programme
let cartItems = 0;
let userCalendar = [];

// Configuration des onglets de jours
function setupDayTabs() {
    const dayTabs = document.querySelectorAll('.day-tab');
    const dayProgrammes = document.querySelectorAll('.day-programme');
    
    dayTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const targetDay = tab.getAttribute('data-day');
            
            // Mettre à jour les onglets
            dayTabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            
            // Mettre à jour les programmes
            dayProgrammes.forEach(programme => {
                programme.classList.remove('active');
                if (programme.id === `${targetDay}-programme`) {
                    programme.classList.add('active');
                }
            });
        });
    });
}

// Chargement du calendrier utilisateur
function loadUserCalendar() {
    const saved = localStorage.getItem('userCalendar');
    if (saved) {
        userCalendar = JSON.parse(saved);
    }
}

// Sauvegarde du calendrier utilisateur
function saveUserCalendar() {
    localStorage.setItem('userCalendar', JSON.stringify(userCalendar));
}

// Ajouter un événement au calendrier (version Laravel)
function addToCalendar(day, time, event) {
    const eventData = {
        day: day,
        time: time,
        event: event,
        addedAt: new Date().toISOString()
    };
    
    // Vérifier si l'événement n'est pas déjà ajouté
    const exists = userCalendar.find(item => 
        item.day === day && item.time === time && item.event === event
    );
    
    if (exists) {
        showNotification('Cet événement est déjà dans votre calendrier', 'info');
        return;
    }
    
    // Utiliser la route Laravel pour sauvegarder
    fetch('/calendrier/ajouter', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(eventData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            userCalendar.push(eventData);
            saveUserCalendar();
            showNotification(data.message, 'success');
        } else {
            showNotification(data.message, 'info');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        // Fallback vers localStorage
        userCalendar.push(eventData);
        saveUserCalendar();
        showNotification(`${event} ajouté à votre calendrier !`, 'success');
    });
}

// S'inscrire à un atelier
function registerWorkshop(workshopId) {
    const workshops = {
        'pizza-masterclass': 'Masterclass Pizza',
        'wine-tasting': 'Dégustation de vins',
        'sushi-workshop': 'Atelier Sushi',
        'pastry-workshop': 'Atelier Pâtisserie'
    };
    
    const workshopName = workshops[workshopId];
    
    // Simuler une inscription
    showNotification(`Inscription à ${workshopName} en cours...`, 'info');
    
    // Utiliser la route Laravel pour l'inscription
    fetch('/ateliers/inscription', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            workshop_id: workshopId,
            name: 'Utilisateur Festival', // Dans un vrai projet, on récupérerait les données du formulaire
            email: 'user@festival.com',
            phone: '+22912345678'
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification(`Inscription réussie à ${workshopName} !`, 'success');
            
            // Ajouter automatiquement au calendrier
            const day = getCurrentDay();
            const time = getWorkshopTime(workshopId);
            addToCalendar(day, time, workshopName);
        } else {
            showNotification(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        showNotification('Erreur lors de l\'inscription', 'error');
    });
}

// Obtenir le jour actuel
function getCurrentDay() {
    const activeTab = document.querySelector('.day-tab.active');
    return activeTab ? activeTab.getAttribute('data-day') : 'day1';
}

// Obtenir l'heure d'un atelier
function getWorkshopTime(workshopId) {
    const times = {
        'pizza-masterclass': '12:00',
        'wine-tasting': '18:00',
        'sushi-workshop': '14:00',
        'pastry-workshop': '10:00'
    };
    return times[workshopId] || '10:00';
}

// Fonction panier
function toggleCart() {
    showNotification('Fonctionnalité du panier en cours de développement', 'info');
}

function addToCart() {
    cartItems++;
    const cartCount = document.getElementById('cart-count');
    if (cartCount) {
        cartCount.textContent = cartItems;
    }
}

// ===== FONCTIONS UTILITAIRES =====

// Affichage des conditions générales
function showTerms() {
    alert('Conditions générales du festival Eat&Drink\n\n' +
          '1. Les entrepreneurs s\'engagent à respecter les horaires du festival\n' +
          '2. La qualité des produits doit être irréprochable\n' +
          '3. Les normes d\'hygiène doivent être respectées\n' +
          '4. L\'organisation se réserve le droit de refuser une demande\n' +
          '5. Les frais de participation seront communiqués après approbation');
}

// Affichage de la politique de confidentialité
function showPrivacy() {
    alert('Politique de confidentialité\n\n' +
          'Vos données personnelles sont collectées uniquement pour :\n' +
          '- Traiter votre demande de stand\n' +
          '- Vous contacter concernant votre participation\n' +
          '- Vous envoyer des informations sur le festival\n\n' +
          'Vos données ne seront pas partagées avec des tiers.');
}

// Notifications
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.textContent = message;
    
    const colors = {
        success: '#4CAF50',
        error: '#F44336',
        info: '#2196F3'
    };
    
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${colors[type]};
        color: white;
        padding: 1rem 2rem;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        z-index: 10000;
        animation: slideIn 0.3s ease;
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => {
            if (document.body.contains(notification)) {
                document.body.removeChild(notification);
            }
        }, 300);
    }, 4000);
}

// ===== INITIALISATION =====

document.addEventListener('DOMContentLoaded', () => {
    // Initialisation des fonctions globales
    animateOnScroll();
    setupSmoothScroll();
    setupMobileMenu();
    
    // Initialisation du formulaire d'inscription
    setupInscriptionForm();
    
    // Initialisation de la page programme
    setupDayTabs();
    loadUserCalendar();
    
    // Animation des statistiques au scroll
    const statsSection = document.querySelector('.stats-section');
    if (statsSection) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateStats();
                    observer.unobserve(entry.target);
                }
            });
        });
        observer.observe(statsSection);
    }
});

// ===== STYLES CSS DYNAMIQUES =====

const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
    
    .btn-primary.loading {
        background: var(--gray);
        cursor: not-allowed;
    }
    
    .btn-primary.loading::after {
        content: '';
        width: 20px;
        height: 20px;
        border: 2px solid transparent;
        border-top: 2px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-left: 0.5rem;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .animate-on-scroll {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }
    
    .animate-on-scroll.animated {
        opacity: 1;
        transform: translateY(0);
    }
    
    .nav-menu.active {
        display: flex;
    }
    
    .menu-toggle.active {
        background: var(--primary-color);
    }
`;
document.head.appendChild(style);
