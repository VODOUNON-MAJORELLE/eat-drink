<!DOCTYPE html>
<html>
<head>
    <title>Recherche - Eat&Drink</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h1 class="text-3xl font-bold mb-6">Résultats de recherche</h1>
            <p class="text-gray-600 mb-6">Recherche pour : "{{ $query }}"</p>
            
            @if($stands->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($stands as $stand)
                        <div class="border rounded-lg p-4">
                            <h3 class="text-lg font-bold mb-2">{{ $stand->nom_stand }}</h3>
                            <p class="text-gray-600 text-sm mb-3">{{ $stand->user->nom_entreprise }}</p>
                            
                            @if($stand->description)
                                <p class="text-gray-700 text-sm mb-3">{{ Str::limit($stand->description, 100) }}</p>
                            @endif

                            <div class="mb-3">
                                <h4 class="font-medium text-sm">Produits ({{ $stand->products->count() }})</h4>
                                @if($stand->products->count() > 0)
                                    <div class="text-sm text-gray-600">
                                        @foreach($stand->products->take(2) as $produit)
                                            <div>{{ $produit->nom }} - {{ $produit->prix_formate }}</div>
                                        @endforeach
                                        @if($stand->products->count() > 2)
                                            <div class="text-xs text-gray-500">+ {{ $stand->products->count() - 2 }} autres</div>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <a href="{{ route('public.stand', $stand->id) }}" 
                               class="block w-full bg-orange-500 text-white text-center py-2 px-4 rounded">
                                Voir le stand
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-500 mb-4">Aucun résultat trouvé pour "{{ $query }}"</p>
                    <a href="{{ route('exposants') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                        Voir tous les exposants
                    </a>
                </div>
            @endif

            <div class="mt-8">
                <a href="{{ route('exposants') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                    Retour aux exposants
                </a>
            </div>
        </div>
    </div>
</body>
</html> 