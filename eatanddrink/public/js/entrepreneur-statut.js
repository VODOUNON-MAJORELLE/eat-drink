// Initialisation
    document.addEventListener('DOMContentLoaded', () => {
        loadRequestStatus();
        setupAutoRefresh();
    });

    // Chargement du statut de la demande
    function loadRequestStatus() {
        const requests = JSON.parse(localStorage.getItem('entrepreneurRequests')) || [];
        if (requests.length === 0) {
            showNoRequestMessage();
            return;
        }
        // Prendre la demande la plus récente
        const latestRequest = requests[requests.length - 1];
        displayRequestStatus(latestRequest);
    }

    // Affichage du statut de la demande
    function displayRequestStatus(request) {
        // Mettre à jour les dates
        const submissionDate = new Date(request.submittedAt);
        document.getElementById('submission-date').textContent = formatDate(submissionDate);
        // Mettre à jour le statut
        updateStatusDisplay(request.status);
        // Afficher les détails de la demande
        displayRequestDetails(request);
        // Mettre à jour la timeline selon le statut
        updateTimeline(request.status);
    }

    // Mise à jour de l'affichage du statut
    function updateStatusDisplay(status) {
        const statusBadge = document.getElementById('status-badge');
        const statusText = document.getElementById('status-text');
        const statusMessage = document.getElementById('status-message');
        switch (status) {
            case 'pending':
                statusBadge.className = 'status-badge pending';
                statusBadge.innerHTML = '<i class="fas fa-clock"></i><span>En attente d\'approbation</span>';
                statusText.textContent = 'En attente d\'approbation';
                statusMessage.className = 'status-message pending';
                statusMessage.innerHTML = `
                    <h3>⏳ Votre demande est en cours d'examen</h3>
                    <p>Notre équipe examine actuellement votre demande de stand. Ce processus prend généralement 24 à 48 heures. Vous recevrez un email dès qu'une décision sera prise.</p>
                `;
                break;
            case 'approved':
                statusBadge.className = 'status-badge approved';
                statusBadge.innerHTML = '<i class="fas fa-check-circle"></i><span>Demande approuvée</span>';
                statusText.textContent = 'Demande approuvée';
                statusMessage.className = 'status-message approved';
                statusMessage.innerHTML = `
                    <h3>✅ Félicitations ! Votre demande est approuvée</h3>
                    <p>Votre stand est confirmé pour le festival Eat&Drink. Vous recevrez bientôt les détails de votre emplacement et les instructions de préparation.</p>
                `;
                break;
            case 'rejected':
                statusBadge.className = 'status-badge rejected';
                statusBadge.innerHTML = '<i class="fas fa-times-circle"></i><span>Demande refusée</span>';
                statusText.textContent = 'Demande refusée';
                statusMessage.className = 'status-message rejected';
                statusMessage.innerHTML = `
                    <h3>❌ Votre demande n'a pas été approuvée</h3>
                    <p>Nous regrettons de vous informer que votre demande n'a pas été retenue. Vous recevrez un email détaillant les raisons de cette décision.</p>
                `;
                break;
        }
    }

    // Mise à jour de la timeline
    function updateTimeline(status) {
        const reviewIcon = document.getElementById('review-icon');
        const decisionIcon = document.getElementById('decision-icon');
        const setupIcon = document.getElementById('setup-icon');
        const reviewDate = document.getElementById('review-date');
        const decisionDate = document.getElementById('decision-date');
        const setupDate = document.getElementById('setup-date');
        switch (status) {
            case 'pending':
                // En cours d'examen
                reviewIcon.className = 'timeline-icon current';
                reviewDate.textContent = 'En cours...';
                break;
            case 'approved':
                // Approuvé
                reviewIcon.className = 'timeline-icon completed';
                reviewDate.textContent = formatDate(new Date());
                decisionIcon.className = 'timeline-icon completed';
                decisionDate.textContent = formatDate(new Date());
                setupIcon.className = 'timeline-icon current';
                setupDate.textContent = 'En cours...';
                break;
            case 'rejected':
                // Refusé
                reviewIcon.className = 'timeline-icon completed';
                reviewDate.textContent = formatDate(new Date());
                decisionIcon.className = 'timeline-icon completed';
                decisionDate.textContent = formatDate(new Date());
                break;
        }
    }

    // Affichage des détails de la demande
    function displayRequestDetails(request) {
        const detailsContainer = document.getElementById('request-details');
        const details = [
            {
                label: 'Numéro de demande',
                value: `ED${request.id}`
            },
            {
                label: 'Nom de l\'entreprise',
                value: request.companyInfo.name
            },
            {
                label: 'Type d\'activité',
                value: getActivityTypeLabel(request.companyInfo.activityType)
            },
            {
                label: 'Spécialités',
                value: request.companyInfo.specialties
            },
            {
                label: 'Taille de stand',
                value: getStandSizeLabel(request.standInfo.size)
            },
            {
                label: 'Date de soumission',
                value: formatDate(new Date(request.submittedAt))
            }
        ];
        detailsContainer.innerHTML = details.map(detail => `
            <div class="detail-item">
                <div class="detail-label">${detail.label}</div>
                <div class="detail-value">${detail.value}</div>
            </div>
        `).join('');
    }

    // Formatage de la date
    function formatDate(date) {
        return date.toLocaleDateString('fr-FR', {
            day: 'numeric',
            month: 'long',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    // Obtenir le libellé du type d'activité
    function getActivityTypeLabel(type) {
        const types = {
            'restaurant': 'Restaurant',
            'catering': 'Traiteur',
            'bakery': 'Boulangerie/Pâtisserie',
            'beverages': 'Boissons/Cocktails',
            'street-food': 'Street Food',
            'artisan': 'Artisan culinaire',
            'other': 'Autre'
        };
        return types[type] || type;
    }

    // Obtenir le libellé de la taille de stand
    function getStandSizeLabel(size) {
        const sizes = {
            'small': 'Petit stand (3x3m)',
            'medium': 'Stand moyen (4x4m)',
            'large': 'Grand stand (5x5m)'
        };
        return sizes[size] || size;
    }

    // Message si aucune demande
    function showNoRequestMessage() {
        const statusCard = document.querySelector('.status-card');
        statusCard.innerHTML = `
            <div class="status-header">
                <h1>📋 Aucune demande trouvée</h1>
                <p>Vous n'avez pas encore soumis de demande de stand</p>
            </div>
            <div class="status-message pending">
                <h3>🚀 Prêt à rejoindre le festival ?</h3>
                <p>Soumettez votre demande de stand pour participer au plus grand événement culinaire de Cotonou !</p>
            </div>
            <div class="status-actions">
                <a href="{{ route('entrepreneur.register') }}" class="btn-primary">
                    <i class="fas fa-plus"></i>
                    Soumettre une demande
                </a>
                <a href="{{ route('home') }}" class="btn-outline">
                    <i class="fas fa-home"></i>
                    Retour à l'accueil
                </a>
            </div>
        `;
    }

    // Configuration du rafraîchissement automatique
    function setupAutoRefresh() {
        // Rafraîchir le statut toutes les 30 secondes
        setInterval(() => {
            loadRequestStatus();
        }, 30000);
    }

    // Contact du support
    function contactSupport() {
        const email = 'support@eatdrink.bj';
        const phone = '+229 90 12 34 56';
        const message = `Contactez notre équipe support :\n\n` +
                       `📧 Email : ${email}\n` +
                       `📞 Téléphone : ${phone}\n\n` +
                       `Heures d'ouverture : Lundi-Vendredi 9h-18h`;
        alert(message);
    }

    // Simulation de mise à jour du statut (pour démonstration)
    function simulateStatusUpdate() {
        const requests = JSON.parse(localStorage.getItem('entrepreneurRequests')) || [];
        if (requests.length > 0) {
            const latestRequest = requests[requests.length - 1];
            // Simuler une mise à jour du statut après 5 secondes
            setTimeout(() => {
                latestRequest.status = 'approved';
                localStorage.setItem('entrepreneurRequests', JSON.stringify(requests));
                loadRequestStatus();
                showNotification('Votre demande a été approuvée !', 'success');
            }, 5000);
        }
    }

    // Notifications
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = message;
        const colors = {
            success: '#00B894',
            error: '#E63946',
            info: '#219EBC'
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
                document.body.removeChild(notification);
            }, 300);
        }, 5000);
    }

    // Styles CSS pour les animations
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
    `;
    document.head.appendChild(style);
    // Pour la démonstration, simuler une mise à jour du statut
    // simulateStatusUpdate(); 