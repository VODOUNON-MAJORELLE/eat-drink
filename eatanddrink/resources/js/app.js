import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// ===== JAVASCRIPT EAT&DRINK =====

// Animation des statistiques
function animateStats() {
    const stats = document.querySelectorAll('.stat-number');
    
    stats.forEach(stat => {
        const target = parseInt(stat.textContent);
        const increment = target / 50;
        let current = 0;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            stat.textContent = Math.floor(current) + '+';
        }, 30);
    });
}

// Animation au scroll
function animateOnScroll() {
    const elements = document.querySelectorAll('.stat-card, .category-card, .info-card');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    });
    
    elements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
}

// Navigation smooth scroll
function initSmoothScroll() {
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

// Header scroll effect
function initHeaderScroll() {
    const header = document.querySelector('.header');
    let lastScroll = 0;
    
    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll > 100) {
            header.style.background = 'rgba(255, 255, 255, 0.95)';
            header.style.backdropFilter = 'blur(10px)';
        } else {
            header.style.background = 'var(--white)';
            header.style.backdropFilter = 'none';
        }
        
        lastScroll = currentScroll;
    });
}

// Mobile menu toggle
function initMobileMenu() {
    const navMenu = document.querySelector('.nav-menu');
    const authButtons = document.querySelector('.auth-buttons');
    
    // Ajouter un bouton hamburger pour mobile
    const hamburger = document.createElement('button');
    hamburger.className = 'mobile-menu-toggle';
    hamburger.innerHTML = '<i class="fas fa-bars"></i>';
    hamburger.style.display = 'none';
    
    const navContainer = document.querySelector('.nav-container');
    navContainer.insertBefore(hamburger, navMenu);
    
    hamburger.addEventListener('click', () => {
        navMenu.classList.toggle('active');
        authButtons.classList.toggle('active');
    });
    
    // Masquer le menu au clic sur un lien
    const navLinks = navMenu.querySelectorAll('a');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            navMenu.classList.remove('active');
            authButtons.classList.remove('active');
        });
    });
    
    // Responsive
    function checkMobile() {
        if (window.innerWidth <= 768) {
            hamburger.style.display = 'block';
            navMenu.style.display = 'none';
            authButtons.style.display = 'none';
        } else {
            hamburger.style.display = 'none';
            navMenu.style.display = 'flex';
            authButtons.style.display = 'flex';
        }
    }
    
    checkMobile();
    window.addEventListener('resize', checkMobile);
}

// Initialisation
document.addEventListener('DOMContentLoaded', () => {
    animateStats();
    animateOnScroll();
    initSmoothScroll();
    initHeaderScroll();
    initMobileMenu();
    
    // Ajouter des styles CSS pour le menu mobile
    const style = document.createElement('style');
    style.textContent = `
        .mobile-menu-toggle {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--primary-color);
            cursor: pointer;
            padding: 0.5rem;
        }
        
        @media (max-width: 768px) {
            .nav-menu.active {
                display: flex !important;
                flex-direction: column;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: var(--white);
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                padding: 1rem;
            }
            
            .auth-buttons.active {
                display: flex !important;
                flex-direction: column;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: var(--white);
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                padding: 1rem;
                margin-top: 1rem;
            }
        }
    `;
    document.head.appendChild(style);
});
