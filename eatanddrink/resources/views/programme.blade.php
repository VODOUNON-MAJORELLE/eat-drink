@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <h1>📅 Programme du Festival</h1>
        <p>Découvrez les événements et animations qui vous attendent pendant 3 jours de festivités culinaires</p>
    </div>
</section>

<!-- Navigation des jours -->
<section class="days-navigation">
    <div class="days-container">
        <div class="days-tabs">
            <button class="day-tab active" data-day="day1">
                <i class="fas fa-calendar-day"></i>
                Vendredi 15 Mars
            </button>
            <button class="day-tab" data-day="day2">
                <i class="fas fa-calendar-day"></i>
                Samedi 16 Mars
            </button>
            <button class="day-tab" data-day="day3">
                <i class="fas fa-calendar-day"></i>
                Dimanche 17 Mars
            </button>
        </div>
    </div>
</section>

<!-- Section du programme -->
<section class="programme-section">
    <div class="programme-container">
        <div class="day-programme active" id="day1-programme">
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-time">Toute la journée</div>
                    <div class="timeline-content">
                        <div class="event-header">
                            <div>
                                <h3 class="event-title">🍲 Stands de nourriture avec des chefs locaux</h3>
                            </div>
                            <span class="event-category">Gastronomie</span>
                        </div>
                        <p class="event-description">Découvrez une variété de stands tenus par des chefs et entrepreneurs culinaires de la région, proposant des plats authentiques et créatifs.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-time">Toute la journée</div>
                    <div class="timeline-content">
                        <div class="event-header">
                            <div>
                                <h3 class="event-title">🍹 Bars spécialisés & cocktails</h3>
                            </div>
                            <span class="event-category">Bar</span>
                        </div>
                        <p class="event-description">Savourez des cocktails originaux et des boissons rafraîchissantes préparés par des barmans experts.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-time">Après-midi & Soirée</div>
                    <div class="timeline-content">
                        <div class="event-header">
                            <div>
                                <h3 class="event-title">🎧 DJ & animations musicales</h3>
                            </div>
                            <span class="event-category">Animation</span>
                        </div>
                        <p class="event-description">Ambiance festive assurée avec des DJ, des groupes live et des animations musicales tout au long du festival.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-time">Toute la journée</div>
                    <div class="timeline-content">
                        <div class="event-header">
                            <div>
                                <h3 class="event-title">🍽️ Expériences culinaires immersives</h3>
                            </div>
                            <span class="event-category">Expérience</span>
                        </div>
                        <p class="event-description">Participez à des dégustations, démonstrations et ateliers pour vivre la cuisine autrement.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-time">Matin & Après-midi</div>
                    <div class="timeline-content">
                        <div class="event-header">
                            <div>
                                <h3 class="event-title">👧 Activités pour enfants</h3>
                            </div>
                            <span class="event-category">Famille</span>
                        </div>
                        <p class="event-description">Ateliers de cuisine, jeux, spectacles et animations spécialement conçus pour les plus jeunes.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Programme du Jour 2 -->
        <div class="day-programme" id="day2-programme">
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-time">Toute la journée</div>
                    <div class="timeline-content">
                        <div class="event-header">
                            <div>
                                <h3 class="event-title">🍲 Stands de nourriture avec des chefs locaux</h3>
                            </div>
                            <span class="event-category">Gastronomie</span>
                        </div>
                        <p class="event-description">Découvrez une variété de stands tenus par des chefs et entrepreneurs culinaires de la région, proposant des plats authentiques et créatifs.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-time">Toute la journée</div>
                    <div class="timeline-content">
                        <div class="event-header">
                            <div>
                                <h3 class="event-title">🍹 Bars spécialisés & cocktails</h3>
                            </div>
                            <span class="event-category">Bar</span>
                        </div>
                        <p class="event-description">Savourez des cocktails originaux et des boissons rafraîchissantes préparés par des barmans experts.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-time">Après-midi & Soirée</div>
                    <div class="timeline-content">
                        <div class="event-header">
                            <div>
                                <h3 class="event-title">🎧 DJ & animations musicales</h3>
                            </div>
                            <span class="event-category">Animation</span>
                        </div>
                        <p class="event-description">Ambiance festive assurée avec des DJ, des groupes live et des animations musicales tout au long du festival.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-time">Toute la journée</div>
                    <div class="timeline-content">
                        <div class="event-header">
                            <div>
                                <h3 class="event-title">🍽️ Expériences culinaires immersives</h3>
                            </div>
                            <span class="event-category">Expérience</span>
                        </div>
                        <p class="event-description">Participez à des dégustations, démonstrations et ateliers pour vivre la cuisine autrement.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-time">Matin & Après-midi</div>
                    <div class="timeline-content">
                        <div class="event-header">
                            <div>
                                <h3 class="event-title">👧 Activités pour enfants</h3>
                            </div>
                            <span class="event-category">Famille</span>
                        </div>
                        <p class="event-description">Ateliers de cuisine, jeux, spectacles et animations spécialement conçus pour les plus jeunes.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Programme du Jour 3 -->
        <div class="day-programme" id="day3-programme">
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-time">Toute la journée</div>
                    <div class="timeline-content">
                        <div class="event-header">
                            <div>
                                <h3 class="event-title">🍲 Stands de nourriture avec des chefs locaux</h3>
                            </div>
                            <span class="event-category">Gastronomie</span>
                        </div>
                        <p class="event-description">Découvrez une variété de stands tenus par des chefs et entrepreneurs culinaires de la région, proposant des plats authentiques et créatifs.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-time">Toute la journée</div>
                    <div class="timeline-content">
                        <div class="event-header">
                            <div>
                                <h3 class="event-title">🍹 Bars spécialisés & cocktails</h3>
                            </div>
                            <span class="event-category">Bar</span>
                        </div>
                        <p class="event-description">Savourez des cocktails originaux et des boissons rafraîchissantes préparés par des barmans experts.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-time">Après-midi & Soirée</div>
                    <div class="timeline-content">
                        <div class="event-header">
                            <div>
                                <h3 class="event-title">🎧 DJ & animations musicales</h3>
                            </div>
                            <span class="event-category">Animation</span>
                        </div>
                        <p class="event-description">Ambiance festive assurée avec des DJ, des groupes live et des animations musicales tout au long du festival.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-time">Toute la journée</div>
                    <div class="timeline-content">
                        <div class="event-header">
                            <div>
                                <h3 class="event-title">🍽️ Expériences culinaires immersives</h3>
                            </div>
                            <span class="event-category">Expérience</span>
                        </div>
                        <p class="event-description">Participez à des dégustations, démonstrations et ateliers pour vivre la cuisine autrement.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-time">Matin & Après-midi</div>
                    <div class="timeline-content">
                        <div class="event-header">
                            <div>
                                <h3 class="event-title">👧 Activités pour enfants</h3>
                            </div>
                            <span class="event-category">Famille</span>
                        </div>
                        <p class="event-description">Ateliers de cuisine, jeux, spectacles et animations spécialement conçus pour les plus jeunes.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section informations pratiques -->
<section class="info-section">
    <div class="info-container">
        <div class="section-header">
            <h2 class="section-title">📋 Informations Pratiques</h2>
            <p class="section-subtitle">Tout ce que vous devez savoir pour profiter du festival</p>
        </div>
        <div class="info-grid">
            <div class="info-card" style="color: white !important; background: linear-gradient(135deg, #219EBC, #00B894) !important;">
                <div class="info-icon" style="color: white !important;">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <h3 class="info-title" style="color: white !important;">Contact</h3>
                <div class="info-details" style="color: white !important;">
                    +229 21 30 12 34<br>
                    info@eatdrink-festival.bj<br>
                    Support en ligne 24/7
                </div>
            </div>
            <div class="info-card" style="color: white !important; background: linear-gradient(135deg, #219EBC, #00B894) !important;">
                <div class="info-icon" style="color: white !important;">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3 class="info-title" style="color: white !important;">Lieu</h3>
                <div class="info-details" style="color: white !important;">
                    Palais des Congrès<br>
                    Cotonou, Littoral<br>
                    Parking gratuit
                </div>
            </div>
            <div class="info-card" style="color: white !important; background: linear-gradient(135deg, #219EBC, #00B894) !important;">
                <div class="info-icon" style="color: white !important;">
                    <i class="fas fa-credit-card"></i>
                </div>
                <h3 class="info-title" style="color: white !important;">Réservations</h3>
                <div class="info-details" style="color: white !important;">
                    Ateliers payants<br>
                    Réservation obligatoire<br>
                    Places limitées
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('main_padding', '0px') 
 
 