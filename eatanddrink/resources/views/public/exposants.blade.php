@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <h1>🍽️ Nos Exposants</h1>
        <p>Découvrez les stands et entrepreneurs qui participent au festival</p>
    </div>
</section>

<!-- Filtres et recherche -->
<section class="filters-section">
    <div class="filters-container" style="justify-content:center; align-items:center; gap:2rem; flex-wrap:wrap;">
        <form method="GET" action="{{ route('exposants') }}" class="search-box" style="flex:1; min-width:300px; position:relative; max-width:400px;">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Rechercher un exposant..." style="width:100%; padding:1rem 3rem 1rem 1rem; border:2px solid rgba(255,107,53,0.2); border-radius:25px; font-size:1rem; transition:all 0.3s ease; box-shadow:0 2px 10px rgba(255,107,53,0.05);">
            <i class="fas fa-search" style="position:absolute; right:1rem; top:50%; transform:translateY(-50%); color:var(--gray-dark); opacity:0.6;"></i>
        </form>
        <form method="GET" action="{{ route('exposants') }}" class="filter-options" style="display:flex; gap:1rem; flex-wrap:wrap; align-items:center;">
            <select name="categorie" onchange="this.form.submit()" style="padding:1rem; border:2px solid rgba(255,107,53,0.2); border-radius:25px; font-size:1rem; background:white; min-width:200px;">
                <option value="">Toutes les catégories</option>
                <option value="restaurant" {{ request('categorie') == 'restaurant' ? 'selected' : '' }}>Restaurant</option>
                <option value="catering" {{ request('categorie') == 'catering' ? 'selected' : '' }}>Traiteur</option>
                <option value="bakery" {{ request('categorie') == 'bakery' ? 'selected' : '' }}>Boulangerie/Pâtisserie</option>
                <option value="beverages" {{ request('categorie') == 'beverages' ? 'selected' : '' }}>Boissons/Cocktails</option>
                <option value="street-food" {{ request('categorie') == 'street-food' ? 'selected' : '' }}>Street Food</option>
                <option value="artisan" {{ request('categorie') == 'artisan' ? 'selected' : '' }}>Artisan culinaire</option>
            </select>
            <select name="sort" onchange="this.form.submit()" style="padding:1rem; border:2px solid rgba(255,107,53,0.2); border-radius:25px; font-size:1rem; background:white; min-width:200px;">
                <option value="nom" {{ request('sort') == 'nom' ? 'selected' : '' }}>Trier par nom</option>
                <option value="popularity" {{ request('sort') == 'popularity' ? 'selected' : '' }}>Trier par popularité</option>
                <option value="note" {{ request('sort') == 'note' ? 'selected' : '' }}>Trier par note</option>
            </select>
        </form>
    </div>
</section>

<!-- Grille des exposants -->
<section class="exposants-section">
    <div class="exposants-container">
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
                            <div>
                                <h3 class="exposant-title">{{ $stand->nom_stand ?? $stand->company_name ?? $stand->user->company_name ?? 'Stand' }}</h3>
                            </div>
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
@endsection 