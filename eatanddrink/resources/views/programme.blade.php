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
        <!-- Programme du Jour 1 -->
        <div class="day-programme active" id="day1-programme">
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-time">10:00</div>
                    <div class="timeline-content">
                        <div class="event-header">
                            <div>
                                <h3 class="event-title">🎪 Cérémonie d'ouverture</h3>
                            </div>
                            <span class="event-category">Événement</span>
                        </div>
                        <p class="event-description">Ouverture officielle du festival avec discours des organisateurs et présentation des exposants.</p>
                        <div class="event-details">
                            <div class="event-detail">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Scène principale</span>
                            </div>
                            <div class="event-detail">
                                <i class="fas fa-clock"></i>
                                <span>1h30</span>
                            </div>
                        </div>
                        <div class="event-actions">
                            <button class="btn-primary" onclick="addToCalendar('day1', '10:00', 'Cérémonie d\'ouverture')">
                                <i class="fas fa-calendar-plus"></i>
                                Ajouter au calendrier
                            </button>
                        </div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-time">12:00</div>
                    <div class="timeline-content">
                        <div class="event-header">
                            <div>
                                <h3 class="event-title">🍕 Masterclass Pizza</h3>
                            </div>
                            <span class="event-category">Atelier</span>
                        </div>
                        <p class="event-description">Apprenez à faire une vraie pizza napolitaine avec nos maîtres pizzaiolos italiens.</p>
                        <div class="event-details">
                            <div class="event-detail">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Zone ateliers</span>
                            </div>
                            <div class="event-detail">
                                <i class="fas fa-clock"></i>
                                <span>2h00</span>
                            </div>
                            <div class="event-detail">
                                <i class="fas fa-users"></i>
                                <span>20 places</span>
                            </div>
                        </div>
                        <div class="event-actions">
                            <button class="btn-primary" onclick="registerWorkshop('pizza-masterclass')">
                                <i class="fas fa-sign-in-alt"></i>
                                S'inscrire
                            </button>
                            <button class="btn-outline" onclick="addToCalendar('day1', '12:00', 'Masterclass Pizza')">
                                <i class="fas fa-calendar-plus"></i>
                                Calendrier
                            </button>
                        </div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-time">15:00</div>
                    <div class="timeline-content">
                        <div class="event-header">
                            <div>
                                <h3 class="event-title">🎵 Concert Jazz & Food</h3>
                            </div>
                            <span class="event-category">Spectacle</span>
                        </div>
                        <p class="event-description">Concert de jazz en plein air avec dégustation de spécialités culinaires locales.</p>
                        <div class="event-details">
                            <div class="event-detail">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Jardin musical</span>
                            </div>
                            <div class="event-detail">
                                <i class="fas fa-clock"></i>
                                <span>1h45</span>
                            </div>
                        </div>
                        <div class="event-actions">
                            <button class="btn-primary" onclick="addToCalendar('day1', '15:00', 'Concert Jazz & Food')">
                                <i class="fas fa-calendar-plus"></i>
                                Ajouter au calendrier
                            </button>
                        </div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-time">18:00</div>
                    <div class="timeline-content">
                        <div class="event-header">
                            <div>
                                <h3 class="event-title">🍷 Dégustation de vins</h3>
                            </div>
                            <span class="event-category">Dégustation</span>
                        </div>
                        <p class="event-description">Découverte des vins du monde avec des sommeliers experts et accords mets-vins.</p>
                        <div class="event-details">
                            <div class="event-detail">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Cave à vins</span>
                            </div>
                            <div class="event-detail">
                                <i class="fas fa-clock"></i>
                                <span>1h30</span>
                            </div>
                            <div class="event-detail">
                                <i class="fas fa-users"></i>
                                <span>15 places</span>
                            </div>
                        </div>
                        <div class="event-actions">
                            <button class="btn-primary" onclick="registerWorkshop('wine-tasting')">
                                <i class="fas fa-sign-in-alt"></i>
                                S'inscrire
                            </button>
                            <button class="btn-outline" onclick="addToCalendar('day1', '18:00', 'Dégustation de vins')">
                                <i class="fas fa-calendar-plus"></i>
                                Calendrier
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Programme du Jour 2 -->
        <div class="day-programme" id="day2-programme">
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-time">09:00</div>
                    <div class="timeline-content">
                        <div class="event-header">
                            <div>
                                <h3 class="event-title">🥐 Petit-déjeuner gourmet</h3>
                            </div>
                            <span class="event-category">Dégustation</span>
                        </div>
                        <p class="event-description">Petit-déjeuner continental avec viennoiseries fraîches et boissons chaudes.</p>
                        <div class="event-details">
                            <div class="event-detail">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Espace petit-déjeuner</span>
                            </div>
                            <div class="event-detail">
                                <i class="fas fa-clock"></i>
                                <span>2h00</span>
                            </div>
                        </div>
                        <div class="event-actions">
                            <button class="btn-primary" onclick="addToCalendar('day2', '09:00', 'Petit-déjeuner gourmet')">
                                <i class="fas fa-calendar-plus"></i>
                                Ajouter au calendrier
                            </button>
                        </div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-time">11:00</div>
                    <div class="timeline-content">
                        <div class="event-header">
                            <div>
                                <h3 class="event-title">👨‍🍳 Concours de cuisine</h3>
                            </div>
                            <span class="event-category">Compétition</span>
                        </div>
                        <p class="event-description">Grand concours de cuisine avec des chefs professionnels et amateurs.</p>
                        <div class="event-details">
                            <div class="event-detail">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Scène culinaire</span>
                            </div>
                            <div class="event-detail">
                                <i class="fas fa-clock"></i>
                                <span>3h00</span>
                            </div>
                        </div>
                        <div class="event-actions">
                            <button class="btn-primary" onclick="addToCalendar('day2', '11:00', 'Concours de cuisine')">
                                <i class="fas fa-calendar-plus"></i>
                                Ajouter au calendrier
                            </button>
                        </div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-time">14:00</div>
                    <div class="timeline-content">
                        <div class="event-header">
                            <div>
                                <h3 class="event-title">🍣 Atelier Sushi</h3>
                            </div>
                            <span class="event-category">Atelier</span>
                        </div>
                        <p class="event-description">Apprenez à préparer des sushis et makis avec nos experts japonais.</p>
                        <div class="event-details">
                            <div class="event-detail">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Zone ateliers</span>
                            </div>
                            <div class="event-detail">
                                <i class="fas fa-clock"></i>
                                <span>2h30</span>
                            </div>
                            <div class="event-detail">
                                <i class="fas fa-users"></i>
                                <span>25 places</span>
                            </div>
                        </div>
                        <div class="event-actions">
                            <button class="btn-primary" onclick="registerWorkshop('sushi-workshop')">
                                <i class="fas fa-sign-in-alt"></i>
                                S'inscrire
                            </button>
                            <button class="btn-outline" onclick="addToCalendar('day2', '14:00', 'Atelier Sushi')">
                                <i class="fas fa-calendar-plus"></i>
                                Calendrier
                            </button>
                        </div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-time">17:00</div>
                    <div class="timeline-content">
                        <div class="event-header">
                            <div>
                                <h3 class="event-title">🎭 Spectacle culinaire</h3>
                            </div>
                            <span class="event-category">Spectacle</span>
                        </div>
                        <p class="event-description">Spectacle de cuisine moléculaire et performances artistiques culinaires.</p>
                        <div class="event-details">
                            <div class="event-detail">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Scène principale</span>
                            </div>
                            <div class="event-detail">
                                <i class="fas fa-clock"></i>
                                <span>1h15</span>
                            </div>
                        </div>
                        <div class="event-actions">
                            <button class="btn-primary" onclick="addToCalendar('day2', '17:00', 'Spectacle culinaire')">
                                <i class="fas fa-calendar-plus"></i>
                                Ajouter au calendrier
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Programme du Jour 3 -->
        <div class="day-programme" id="day3-programme">
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-time">10:00</div>
                    <div class="timeline-content">
                        <div class="event-header">
                            <div>
                                <h3 class="event-title">🍰 Atelier Pâtisserie</h3>
                            </div>
                            <span class="event-category">Atelier</span>
                        </div>
                        <p class="event-description">Créez vos propres pâtisseries avec nos chefs pâtissiers français.</p>
                        <div class="event-details">
                            <div class="event-detail">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Zone ateliers</span>
                            </div>
                            <div class="event-detail">
                                <i class="fas fa-clock"></i>
                                <span>2h00</span>
                            </div>
                            <div class="event-detail">
                                <i class="fas fa-users"></i>
                                <span>18 places</span>
                            </div>
                        </div>
                        <div class="event-actions">
                            <button class="btn-primary" onclick="registerWorkshop('pastry-workshop')">
                                <i class="fas fa-sign-in-alt"></i>
                                S'inscrire
                            </button>
                            <button class="btn-outline" onclick="addToCalendar('day3', '10:00', 'Atelier Pâtisserie')">
                                <i class="fas fa-calendar-plus"></i>
                                Calendrier
                            </button>
                        </div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-time">13:00</div>
                    <div class="timeline-content">
                        <div class="event-header">
                            <div>
                                <h3 class="event-title">🏆 Remise des prix</h3>
                            </div>
                            <span class="event-category">Cérémonie</span>
                        </div>
                        <p class="event-description">Cérémonie de remise des prix du concours de cuisine et des meilleurs stands.</p>
                        <div class="event-details">
                            <div class="event-detail">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Scène principale</span>
                            </div>
                            <div class="event-detail">
                                <i class="fas fa-clock"></i>
                                <span>1h00</span>
                            </div>
                        </div>
                        <div class="event-actions">
                            <button class="btn-primary" onclick="addToCalendar('day3', '13:00', 'Remise des prix')">
                                <i class="fas fa-calendar-plus"></i>
                                Ajouter au calendrier
                            </button>
                        </div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-marker"></div>
                    <div class="timeline-time">15:00</div>
                    <div class="timeline-content">
                        <div class="event-header">
                            <div>
                                <h3 class="event-title">🎉 Grande fête de clôture</h3>
                            </div>
                            <span class="event-category">Fête</span>
                        </div>
                        <p class="event-description">Grande fête de clôture avec musique, danse et dégustation finale.</p>
                        <div class="event-details">
                            <div class="event-detail">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Espace festif</span>
                            </div>
                            <div class="event-detail">
                                <i class="fas fa-clock"></i>
                                <span>3h00</span>
                            </div>
                        </div>
                        <div class="event-actions">
                            <button class="btn-primary" onclick="addToCalendar('day3', '15:00', 'Grande fête de clôture')">
                                <i class="fas fa-calendar-plus"></i>
                                Ajouter au calendrier
                            </button>
                        </div>
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
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h3 class="info-title" style="color: white !important;">Dates & Horaires</h3>
                <div class="info-details" style="color: white !important;">
                    Du 15 au 17 Mars 2025<br>
                    10h00 - 22h00<br>
                    Entrée gratuite
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
        </div>
    </div>
</section>
@endsection 
 
 