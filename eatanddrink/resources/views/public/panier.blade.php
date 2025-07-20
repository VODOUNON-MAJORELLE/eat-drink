<!DOCTYPE html>
<html>
<head>
    <title>Panier - Eat&Drink</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h1 class="text-3xl font-bold mb-6">Mon Panier</h1>
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(!empty($panier))
                @foreach($panier as $standId => $standData)
                    <div class="border rounded-lg p-6 mb-6">
                        <h2 class="text-xl font-bold mb-4">{{ $standData['nom_stand'] }}</h2>
                        
                        @foreach($standData['produits'] as $produitId => $produit)
                            <div class="flex justify-between items-center border-b py-2">
                                <div>
                                    <h3 class="font-medium">{{ $produit['nom'] }}</h3>
                                    <p class="text-gray-600">{{ number_format($produit['prix'], 2, ',', ' ') }} € x {{ $produit['quantite'] }}</p>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="font-bold">{{ number_format($produit['prix'] * $produit['quantite'], 2, ',', ' ') }} €</span>
                                    
                                    <form method="POST" action="{{ route('public.panier.supprimer') }}" class="inline">
                                        @csrf
                                        <input type="hidden" name="stand_id" value="{{ $standId }}">
                                        <input type="hidden" name="produit_id" value="{{ $produitId }}">
                                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-sm">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        
                        <div class="mt-4 flex justify-between items-center">
                            <form method="POST" action="{{ route('public.commande') }}">
                                @csrf
                                <input type="hidden" name="stand_id" value="{{ $standId }}">
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Commander ce stand</button>
                            </form>
                        </div>
                    </div>
                @endforeach
                
                <form method="POST" action="{{ route('public.panier.vider') }}" class="mt-6">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Vider le panier</button>
                </form>
            @else
                <p class="text-gray-500 text-center py-8">Votre panier est vide</p>
            @endif

            <div class="mt-6">
                <a href="{{ route('exposants') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Retour aux exposants</a>
            </div>
        </div>
    </div>
</body>
</html> 