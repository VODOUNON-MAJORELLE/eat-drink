@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero" style="margin-top:0 !important; padding-top:4rem !important; padding-bottom:4rem !important; min-height:320px;">
        <div class="hero-content">
            <h1>🎪 EAT&DRINK Festival</h1>
            <p>Découvrez les saveurs du monde dans une atmosphère festive et colorée. Le plus grand événement culinaire de Cotonou vous attend !</p>
            <div class="hero-buttons">
                <a href="{{ route('exposants') }}" class="btn-primary">
                    <i class="fas fa-store"></i>
                    Découvrir les stands
                </a>
                <a href="{{ route('programme') }}" class="btn-outline">
                    <i class="fas fa-calendar-alt"></i>
                    Programme complet
                </a>
                    <a href="{{ route('register') }}" class="btn-outline">
                        <i class="fas fa-plus"></i>
                        Rejoindre comme exposant
                    </a>
            </div>
        </div>
    </section>

    <!-- Présentation événement -->
    <section class="event-description" style="padding:2.5rem 0;text-align:center;max-width:800px;margin:0 auto;">
        <h2 style="font-size:2rem;font-weight:700;color:#FF6B35;margin-bottom:1.5rem;">Un rendez-vous culinaire unique à Cotonou</h2>
        <p style="font-size:1.15rem;color:#333;line-height:1.7;">
            Le festival EAT&DRINK rassemble chaque année des passionnés de gastronomie, des chefs talentueux et des entrepreneurs culinaires venus de tous horizons. Profitez d'une ambiance festive, de découvertes gustatives, d'animations pour petits et grands, et de rencontres inoubliables autour de la cuisine du monde.<br><br>
            Rejoignez-nous pour célébrer la diversité culinaire, soutenir les talents locaux et vivre une expérience gourmande hors du commun !
        </p>
    </section>

    <!-- Catégories -->
    <section class="categories-section">
        <div class="section-header">
            <h2 class="section-title">🍽️ Nos Catégories Culinaires</h2>
            <p class="section-subtitle">Un voyage gustatif à travers les continents</p>
        </div>
        <div class="categories-grid">
            <div class="category-card">
                <div class="category-image">🍕</div>
                <div class="category-content">
                    <h3 class="category-title">Cuisine Européenne</h3>
                    <p class="category-description">Pizza, pâtes, crêpes et spécialités méditerranéennes</p>
                </div>
            </div>
            <div class="category-card">
                <div class="category-image">🍛</div>
                <div class="category-content">
                    <h3 class="category-title">Cuisine Africaine</h3>
                    <p class="category-description">Plats traditionnels et saveurs authentiques du continent</p>
                </div>
            </div>
            <div class="category-card">
                <div class="category-image">🍜</div>
                <div class="category-content">
                    <h3 class="category-title">Cuisine Asiatique</h3>
                    <p class="category-description">Sushi, nouilles, curry et délices orientaux</p>
                </div>
            </div>
            <div class="category-card">
                <div class="category-image">🌮</div>
                <div class="category-content">
                    <h3 class="category-title">Cuisine Latino</h3>
                    <p class="category-description">Tacos, empanadas et saveurs d'Amérique latine</p>
                </div>
            </div>
            <div class="category-card">
                <div class="category-image">🧃</div>
                <div class="category-content">
                    <h3 class="category-title">Boissons & Cocktails</h3>
                    <p class="category-description">Jus frais, cocktails et boissons du monde</p>
                </div>
            </div>
            <div class="category-card">
                <div class="category-image">🍰</div>
                <div class="category-content">
                    <h3 class="category-title">Desserts & Pâtisseries</h3>
                    <p class="category-description">Gâteaux, chocolats et douceurs sucrées</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Rejoindre comme Exposant -->
    <section class="join-section">
        <div class="join-container">
            <div class="join-content">
                <h2>🎪 Vous êtes un entrepreneur culinaire ?</h2>
                <p>Rejoignez le plus grand festival culinaire de Cotonou et présentez vos spécialités à des milliers de visiteurs !</p>
                <div class="join-benefits">
                    <div class="benefit-item">
                        <i class="fas fa-users"></i>
                        <span>Exposition à 50,000+ visiteurs</span>
                    </div>
                    <div class="benefit-item">
                        <i class="fas fa-chart-line"></i>
                        <span>Augmentation de votre visibilité</span>
                    </div>
                    <div class="benefit-item">
                        <i class="fas fa-handshake"></i>
                        <span>Opportunités de partenariats</span>
                    </div>
                    <div class="benefit-item">
                        <i class="fas fa-star"></i>
                        <span>Reconnaissance de votre expertise</span>
                    </div>
                </div>
                <div class="join-actions">
                            <a href="{{ route('register') }}" class="btn-primary">
                                <i class="fas fa-plus"></i>
                                Demander un stand
                            </a>
                    <a href="{{ route('exposants') }}" class="btn-secondary">
                        <i class="fas fa-eye"></i>
                        Voir les exposants
                    </a>
                </div>
            </div>
            <div class="join-image">
                <div class="image-placeholder">
                    <i class="fas fa-utensils"></i>
                    <p>Votre stand vous attend !</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Informations Pratiques -->
    <section class="info-section" id="infos">
        <div class="section-header">
            <h2 class="section-title">📅 Informations Pratiques</h2>
            <p class="section-subtitle">Tout ce que vous devez savoir pour votre visite</p>
        </div>
        <div class="info-grid">
            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h3 class="info-title">Dates & Horaires</h3>
                <div class="info-details">
                    Du 15 au 17 Mars 2025<br>
                    10h00 - 22h00<br>
                    Entrée gratuite
                </div>
            </div>
            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3 class="info-title">Lieu</h3>
                <div class="info-details">
                    Palais des Congrès<br>
                    Cotonou, Littoral<br>
                    Parking gratuit
                </div>
            </div>
            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-credit-card"></i>
                </div>
                <h3 class="info-title">Moyens de Paiement</h3>
                <div class="info-details">
                    Espèces • Mobile Money<br>
                    Cartes bancaires<br>
                    Paiement en ligne
                </div>
            </div>
        </div>
    </section>
@endsection

@section('main_padding', '24px')

<style>
.info-card {
    background: linear-gradient(135deg, #219EBC, #00B894) !important;
    color: #fff !important;
    box-shadow: 0 10px 30px rgba(33, 158, 188, 0.08);
    border-radius: 20px;
    padding: 2.5rem;
    text-align: center;
}
.info-card * {
    color: #fff !important;
}
.info-icon {
    color: #fff !important;
    font-size: 3.5rem;
    margin-bottom: 1.5rem;
}
.info-title {
    color: #fff !important;
    font-weight: bold;
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
}
.info-details {
    color: #fff !important;
    font-size: 1.1rem;
    opacity: 0.95;
    line-height: 1.8;
}
</style>
