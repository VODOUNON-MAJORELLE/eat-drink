@extends('layouts.app')

@section('content')
<section class="panier-section" style="background:#FFF8F5;min-height:80vh;padding:3rem 0;margin-top:100px;">
    <div class="panier-container" style="max-width:900px;margin:0 auto;padding:0 2rem;">
        <h1 style="font-size:2rem;font-weight:700;color:#FF6B35;margin-bottom:2rem;">🛒 Mon Panier</h1>
        @if(session('success'))
            <div style="background:white;padding:3rem 2rem;border-radius:18px;box-shadow:0 6px 24px rgba(255,107,53,0.08);text-align:center;margin-bottom:2rem;">
                <i class="fas fa-check-circle" style="font-size:3rem;color:#4CAF50;margin-bottom:1rem;"></i>
                <h3 style="color:#4CAF50;">{{ session('success') }}</h3>
                <a href="{{ route('exposants') }}" class="btn-primary" style="margin-top:1.5rem;display:inline-block;">
                    <i class="fas fa-arrow-left"></i> Retourner voir les exposants
                </a>
            </div>
        @endif
        @if(empty($panier) || count($panier) === 0)
            <div style="background:white;padding:3rem 2rem;border-radius:18px;box-shadow:0 6px 24px rgba(255,107,53,0.08);text-align:center;">
                <i class="fas fa-shopping-cart" style="font-size:3rem;color:#FF6B35;margin-bottom:1rem;"></i>
                <h3 style="color:#FF6B35;">Votre panier est vide</h3>
                <p style="color:#444;opacity:0.7;">Ajoutez des produits pour passer une commande.</p>
                <a href="{{ route('exposants') }}" class="btn-primary" style="margin-top:1.5rem;display:inline-block;">
                    <i class="fas fa-arrow-left"></i> Voir les exposants
                </a>
            </div>
        @else
            <div class="panier-produits" style="background:white;border-radius:18px;box-shadow:0 6px 24px rgba(255,107,53,0.08);padding:2rem;">
                <table style="width:100%;border-collapse:collapse;">
                    <thead>
                        <tr style="background:#FFF3E0;">
                            <th style="padding:1rem 0.5rem;text-align:left;">Produit</th>
                            <th style="padding:1rem 0.5rem;text-align:left;">Quantité</th>
                            <th style="padding:1rem 0.5rem;text-align:left;">Prix unitaire</th>
                            <th style="padding:1rem 0.5rem;text-align:left;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($stands as $stand)
                            @foreach($panier[$stand->id]['produits'] as $produitId => $item)
                                @php $ligneTotal = $item['prix'] * $item['quantite']; $total += $ligneTotal; @endphp
                                <tr style="border-bottom:1px solid #f3f3f3;">
                                    <td style="padding:1rem 0.5rem;">
                                        <div style="display:flex;align-items:center;gap:1rem;">
                                            @if($item['image_url'])
                                                <img src="{{ asset('storage/' . $item['image_url']) }}" alt="{{ $item['nom'] }}" style="width:48px;height:48px;object-fit:cover;border-radius:10px;">
                                            @else
                                                <span style="font-size:2rem;color:#FF6B35;">🍽️</span>
                                            @endif
                                            <div>
                                                <div style="font-weight:600;color:#FF6B35;">{{ $item['nom'] }}</div>
                                                <div style="font-size:0.95rem;color:#888;">Stand : {{ $stand->nom_stand }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="padding:1rem 0.5rem;">{{ $item['quantite'] }}</td>
                                    <td style="padding:1rem 0.5rem;">{{ number_format($item['prix'], 2, ',', ' ') }} F CFA</td>
                                    <td style="padding:1rem 0.5rem;font-weight:600;">{{ number_format($ligneTotal, 2, ',', ' ') }} F CFA</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
                <div style="text-align:right;margin-top:2rem;font-size:1.2rem;font-weight:700;color:#2D3436;">
                    Total : {{ number_format($total, 2, ',', ' ') }} F CFA
                </div>
                <form method="POST" action="{{ route('commande') }}" style="margin-top:2.5rem;">
                    @csrf
                    <input type="hidden" name="stand_id" value="{{ $stands->first()->id ?? '' }}">
                    <button type="submit" class="btn-primary" style="width:100%;background:#FF6B35;color:white;padding:1rem 0;border-radius:10px;font-weight:700;font-size:1.1rem;transition:background 0.2s;">
                        <i class="fas fa-paper-plane"></i> Soumettre le panier
                    </button>
                </form>
            </div>
        @endif
    </div>
</section>
@endsection 