<!DOCTYPE html>
<html>
<head>
    <title>Stand - {{ $stand->nom_stand }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h1 class="text-3xl font-bold mb-4">{{ $stand->nom_stand }}</h1>
            <p class="text-gray-600 mb-6">{{ $stand->user->nom_entreprise }}</p>
            
            @if($stand->description)
                <p class="mb-6">{{ $stand->description }}</p>
            @endif

            <h2 class="text-2xl font-bold mb-4">Produits</h2>
            
            @if($stand->products->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($stand->products as $produit)
                        <div class="border rounded-lg p-4">
                            <h3 class="font-bold">{{ $produit->nom }}</h3>
                            <p class="text-gray-600">{{ $produit->description }}</p>
                            <p class="text-lg font-bold text-orange-600 mt-2">{{ $produit->prix_formate }}</p>
                            
                            <form method="POST" action="{{ route('public.panier.ajouter') }}" class="mt-4">
                                @csrf
                                <input type="hidden" name="stand_id" value="{{ $stand->id }}">
                                <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                                <input type="number" name="quantite" value="1" min="1" max="99" class="border rounded px-2 py-1 w-16">
                                <button type="submit" class="bg-orange-500 text-white px-4 py-1 rounded ml-2">Ajouter</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">Aucun produit disponible</p>
            @endif

            <div class="mt-8">
                <a href="{{ route('exposants') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Retour aux exposants</a>
            </div>
        </div>
    </div>
</body>
</html> 