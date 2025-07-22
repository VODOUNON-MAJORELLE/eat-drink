@extends('layouts.app')

@section('content')
<section class="stand-section" style="background:#FFF8F5;min-height:80vh;padding:3rem 0;margin-top:100px;">
    <div class="stand-container" style="max-width:1100px;margin:0 auto;padding:0 2rem;">
        <div class="stand-header" style="margin-bottom:2.5rem;">
            <h1 style="font-size:2.2rem;font-weight:700;color:#FF6B35;display:flex;align-items:center;gap:1rem;">
                {{ $stand->emoji ?? '🍽️' }} {{ $stand->nom_stand ?? $stand->company_name ?? $stand->user->company_name ?? 'Stand' }}
            </h1>
            <p style="color:#444;font-size:1.1rem;margin-top:0.5rem;">{{ $stand->description }}</p>
        </div>
        <div class="produits-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:2rem;">
            @forelse($products as $product)
                <div class="produit-card" style="background:white;border-radius:18px;box-shadow:0 6px 24px rgba(255,107,53,0.08);overflow:hidden;display:flex;flex-direction:column;">
                    <div class="produit-image" style="height:180px;background:#f3f3f3;display:flex;align-items:center;justify-content:center;">
                        @if($product->image_url)
                            <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->nom }}" style="max-width:100%;max-height:100%;object-fit:cover;">
                        @else
                            <span style="font-size:3rem;color:#FF6B35;">🍽️</span>
                        @endif
                    </div>
                    <div class="produit-content" style="padding:1.5rem;flex:1;display:flex;flex-direction:column;">
                        <h3 style="font-size:1.2rem;font-weight:700;color:#FF6B35;margin-bottom:0.5rem;">{{ $product->nom }}</h3>
                        <p style="color:#444;font-size:1rem;opacity:0.85;margin-bottom:1rem;">{{ $product->description }}</p>
                        <div style="font-size:1.1rem;font-weight:600;color:#2D3436;margin-bottom:1.2rem;">{{ number_format($product->prix, 2, ',', ' ') }} F CFA</div>
                        <form method="POST" action="{{ route('panier.ajouter') }}" style="margin-top:auto;">
                            @csrf
                            <input type="hidden" name="stand_id" value="{{ $stand->id }}">
                            <input type="hidden" name="produit_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantite" value="1">
                            <button type="submit" class="btn-primary" style="width:100%;background:#FF6B35;color:white;padding:0.8rem 0;border-radius:10px;font-weight:600;font-size:1rem;transition:background 0.2s;">
                                <i class="fas fa-cart-plus"></i> Ajouter au panier
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div style="grid-column:1/-1;text-align:center;padding:3rem 1rem;background:white;border-radius:18px;box-shadow:0 6px 24px rgba(255,107,53,0.08);">
                    <i class="fas fa-box-open" style="font-size:3rem;color:#FF6B35;margin-bottom:1rem;"></i>
                    <h3 style="color:#FF6B35;">Aucun produit pour ce stand</h3>
                    <p style="color:#444;opacity:0.7;">Ce stand n'a pas encore ajouté de produits.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
<a href="{{ route('panier') }}" class="floating-cart" style="position:fixed;bottom:2rem;right:2rem;background:#FF6B35;color:white;width:60px;height:60px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.5rem;box-shadow:0 4px 20px rgba(255,107,53,0.3);cursor:pointer;transition:all 0.3s ease;z-index:1000;">
    <i class="fas fa-shopping-cart"></i>
</a>
@endsection 