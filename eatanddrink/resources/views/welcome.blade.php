@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>🎪 EAT&DRINK Carnaval Festival 6</h1>
            <p>Découvrez les saveurs du monde dans une atmosphère festive et colorée. Le plus grand événement culinaire de Cotonou vous attend !</p>
            <div class="hero-buttons">
                <a href="{{ route('exposants') }}" class="btn-primary">
                    <i class="fas fa-store"></i>
                    Découvrir les stands
                </a>
                <a href="#programme" class="btn-secondary">
                    <i class="fas fa-calendar-alt"></i>
                    Programme complet
                </a>
                @guest
                    <a href="{{ route('register') }}" class="btn-outline">
                        <i class="fas fa-plus"></i>
                        Rejoindre comme exposant
                    </a>
                @endguest
            </div>
        </div>
    </section>

    <!-- Statistiques -->
    <section class="stats-section">
        <div class="stats-container">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="stat-number" id="stands-count">
                        {{ App\Models\Stand::count() }}+
                    </div>
                    <div class="stat-label">Stands Culinaires</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <div class="stat-number" id="products-count">
                        {{ App\Models\Product::count() }}+
                    </div>
                    <div class="stat-label">Plats & Boissons</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number" id="visitors-count">50K+</div>
                    <div class="stat-label">Visiteurs Attendus</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <div class="stat-number" id="countries-count">25+</div>
                    <div class="stat-label">Cuisines du Monde</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Catégories -->
    <section class="categories-section">
        <div class="section-header">
            <h2 class="section-title">🍽️ Nos Catégories Culinaires</h2>
            <p class="section-subtitle">Un voyage gustatif à travers les continents</p>
        </div>
        <div class="categories-grid">
            <div class="category-card">
                <div class="category-image">
                    🍕
                </div>
                <div class="category-content">
                    <h3 class="category-title">Cuisine Européenne</h3>
                    <p class="category-description">Pizza, pâtes, crêpes et spécialités méditerranéennes</p>
                    <span class="category-count">25 stands</span>
                </div>
            </div>
            <div class="category-card">
                <div class="category-image">
                    🍛
                </div>
                <div class="category-content">
                    <h3 class="category-title">Cuisine Africaine</h3>
                    <p class="category-description">Plats traditionnels et saveurs authentiques du continent</p>
                    <span class="category-count">40 stands</span>
                </div>
            </div>
            <div class="category-card">
                <div class="category-image">
                    🍜
                </div>
                <div class="category-content">
                    <h3 class="category-title">Cuisine Asiatique</h3>
                    <p class="category-description">Sushi, nouilles, curry et délices orientaux</p>
                    <span class="category-count">30 stands</span>
                </div>
            </div>
            <div class="category-card">
                <div class="category-image">
                    🌮
                </div>
                <div class="category-content">
                    <h3 class="category-title">Cuisine Latino</h3>
                    <p class="category-description">Tacos, empanadas et saveurs d'Amérique latine</p>
                    <span class="category-count">20 stands</span>
                </div>
            </div>
            <div class="category-card">
                <div class="category-image">
                    🧃
                </div>
                <div class="category-content">
                    <h3 class="category-title">Boissons & Cocktails</h3>
                    <p class="category-description">Jus frais, cocktails et boissons du monde</p>
                    <span class="category-count">25 stands</span>
                </div>
            </div>
            <div class="category-card">
                <div class="category-image">
                    🍰
                </div>
                <div class="category-content">
                    <h3 class="category-title">Desserts & Pâtisseries</h3>
                    <p class="category-description">Gâteaux, chocolats et douceurs sucrées</p>
                    <span class="category-count">15 stands</span>
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
                    @guest
                        <a href="{{ route('register') }}" class="btn-primary">
                            <i class="fas fa-plus"></i>
                            Demander un stand
                        </a>
                    @else
                        @if(auth()->user()->role === 'entrepreneur')
                            <a href="{{ route('entrepreneur.dashboard') }}" class="btn-primary">
                                <i class="fas fa-tachometer-alt"></i>
                                Mon Tableau de Bord
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn-primary">
                                <i class="fas fa-plus"></i>
                                Demander un stand
                            </a>
                        @endif
                    @endguest
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
