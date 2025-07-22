@extends('layouts.app')

@section('content')
<main style="padding-top:0 !important;">
    <!-- Hero Section -->
    <section class="hero-section" style="margin-top:0 !important; padding-top:4rem !important; padding-bottom:4rem !important; min-height:300px;">
        <div class="hero-content">
            <h1>🍽️ Nos Exposants</h1>
            <p>Découvrez les stands et entrepreneurs qui participent au festival</p>
        </div>
    </section>

    <!-- Grille des exposants -->
    <section class="exposants-section" style="padding:3rem 0; min-height:80vh;">
        <div class="exposants-container" style="padding:0 2rem;">
            <div class="results-info">
                <div class="results-count">
                    <span id="results-count">{{ $stands->total() }}</span> exposants trouvés
                </div>
            </div>
            <div class="exposants-grid" id="exposants-grid">
                @forelse($stands as $stand)
                    <div class="exposant-card">
                        <div class="exposant-image">
                            {{ $stand->emoji ?? '🍽️' }}
                            @if($stand->user && $stand->user->statut === 'approuve')
                                <span class="exposant-badge">✓ Vérifié</span>
                            @endif
                        </div>
                        <div class="exposant-content">
                            <div class="exposant-header">
                                <h3 class="exposant-title">{{ $stand->nom_stand ?? $stand->company_name ?? $stand->user->company_name ?? 'Stand' }}</h3>
                                <span class="exposant-category">{{ $stand->categorie_label ?? $stand->categorie ?? 'Autre' }}</span>
                            </div>
                            <p class="exposant-description">{{ Str::limit($stand->description, 120) }}</p>
                            <div class="exposant-specialties">
                                @if($stand->specialties)
                                    @foreach(explode(',', $stand->specialties) as $specialty)
                                        <span class="specialty-tag">{{ trim($specialty) }}</span>
                                    @endforeach
                                @endif
                            </div>
                            <div class="exposant-stats">
                                <div class="stat-item">
                                    <div class="stat-number">{{ $stand->note ?? '4.5' }}</div>
                                    <div class="stat-label">Note</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">{{ $stand->products_count ?? ($stand->products ? $stand->products->count() : 0) }}</div>
                                    <div class="stat-label">Produits</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">{{ $stand->orders_count ?? ($stand->orders ? $stand->orders->count() : 0) }}</div>
                                    <div class="stat-label">Commandes</div>
                                </div>
                            </div>
                            <div class="exposant-actions">
                                <a href="{{ route('stand.show', $stand->id) }}" class="btn-primary">
                                    <i class="fas fa-eye"></i>
                                    Voir le stand
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                <div class="no-results" style="text-align:center; padding:4rem 2rem; background:white; border-radius:20px; box-shadow:0 10px 30px var(--shadow);">
                    <i class="fas fa-search" style="font-size:4rem; color:var(--gray-dark); opacity:0.3; margin-bottom:1rem;"></i>
                    <h3 style="color:var(--gray-dark); margin-bottom:1rem;">Aucun exposant trouvé</h3>
                    <p style="color:var(--gray-dark); opacity:0.7; margin-bottom:2rem;">Aucun exposant ne correspond à vos critères de recherche.</p>
                    <a href="{{ route('exposants') }}" class="btn-primary" style="display:inline-block; margin-top:1rem;">
                            <i class="fas fa-times"></i>
                            Effacer les filtres
                        </a>
                    </div>
                @endforelse
            </div>
        <div class="mt-8">
            {{ $stands->withQueryString()->links() }}
            </div>
        </div>
    </section>
</main>
<style>
:root {
    --orange-primary: #FF6B35;
    --red-coral: #E63946;
    --yellow-gold: #FFB627;
    --white-cream: #FFF8F5;
    --gray-dark: #2D3436;
    --green-emerald: #00B894;
    --shadow: rgba(0,0,0,0.1);
}
body {
    background: var(--white-cream) !important;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
}
.exposants-section {
    background: var(--white-cream) !important;
    padding: 3rem 0 !important;
}
.exposants-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}
.exposants-grid {
    display: grid !important;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)) !important;
    gap: 2rem !important;
    margin-top: 2rem !important;
}
.exposant-card {
    background: white !important;
    border-radius: 20px !important;
    overflow: hidden !important;
    box-shadow: 0 10px 30px var(--shadow) !important;
    transition: all 0.3s ease !important;
    cursor: pointer !important;
    padding: 0 !important;
    display: flex;
    flex-direction: column;
}
.exposant-card:hover {
    transform: translateY(-10px) !important;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15) !important;
}
.exposant-image {
    height: 200px !important;
    background: linear-gradient(135deg, var(--orange-primary), var(--red-coral)) !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 4rem !important;
    color: white !important;
    position: relative !important;
}
.exposant-badge {
    position: absolute !important;
    top: 1rem !important;
    right: 1rem !important;
    background: var(--green-emerald) !important;
    color: white !important;
    padding: 0.3rem 0.8rem !important;
    border-radius: 15px !important;
    font-size: 0.8rem !important;
    font-weight: bold !important;
}
.exposant-content {
    padding: 1.5rem !important;
}
.exposant-header {
    display: flex !important;
    justify-content: space-between !important;
    align-items: flex-start !important;
    margin-bottom: 1rem !important;
}
.exposant-title {
    font-size: 1.3rem !important;
    font-weight: bold !important;
    color: var(--gray-dark) !important;
    margin-bottom: 0.5rem !important;
}
.exposant-category {
    background: var(--yellow-gold) !important;
    color: var(--gray-dark) !important;
    padding: 0.3rem 0.8rem !important;
    border-radius: 15px !important;
    font-size: 0.8rem !important;
    font-weight: bold !important;
}
.exposant-description {
    color: var(--gray-dark) !important;
    opacity: 0.7 !important;
    margin-bottom: 1rem !important;
    line-height: 1.5 !important;
}
.exposant-specialties {
    display: flex !important;
    flex-wrap: wrap !important;
    gap: 0.5rem !important;
    margin-bottom: 1rem !important;
}
.specialty-tag {
    background: rgba(255,107,53,0.1) !important;
    color: var(--orange-primary) !important;
    padding: 0.2rem 0.6rem !important;
    border-radius: 10px !important;
    font-size: 0.8rem !important;
    font-weight: 600 !important;
}
.exposant-stats {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    margin-bottom: 1rem !important;
    padding-top: 1rem !important;
    border-top: 1px solid rgba(0,0,0,0.1) !important;
}
.stat-item {
    text-align: center !important;
}
.stat-number {
    font-size: 1.2rem !important;
    font-weight: bold !important;
    color: var(--orange-primary) !important;
}
.stat-label {
    font-size: 0.8rem !important;
    color: var(--gray-dark) !important;
    opacity: 0.7 !important;
}
.exposant-actions {
    display: flex !important;
    gap: 1rem !important;
}
.btn-primary {
    background: var(--orange-primary) !important;
    color: white !important;
    border: none !important;
    padding: 0.8rem 1.5rem !important;
    border-radius: 10px !important;
    font-size: 1rem !important;
    font-weight: bold !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    display: flex !important;
    align-items: center !important;
    gap: 0.5rem !important;
    text-decoration: none !important;
    flex: 1 !important;
    justify-content: center !important;
}
.btn-primary:hover {
    background: #e55a2b !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 5px 15px rgba(255,107,53,0.3) !important;
}
@media (max-width: 700px) {
  .exposants-grid {
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }
  .exposant-card {
    min-height: 280px;
  }
}
</style>
@endsection 