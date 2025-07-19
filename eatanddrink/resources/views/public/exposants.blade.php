<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nos Exposants - Eat&Drink</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 25%, #8b5cf6 75%, #7c3aed 100%);
        }
        .gradient-text {
            background: linear-gradient(135deg, #ff6b35, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-50">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="/" class="text-2xl font-bold gradient-text">
                            🍽️ Eat&Drink
                        </a>
                    </div>

                    <div class="flex items-center space-x-4">
                        <a href="/" class="text-gray-600 hover:text-gray-900 transition-colors">
                            Accueil
                        </a>
                        <a href="{{ route('public.exposants') }}" class="text-orange-600 font-medium">
                            Nos Exposants
                        </a>
                        <a href="{{ route('public.panier') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition-colors">
                            🛒 Panier
                        </a>
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 transition-colors">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 transition-colors">
                                Connexion
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Header -->
        <div class="bg-gradient-to-r from-orange-500 to-purple-600 text-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Nos Exposants</h1>
                <p class="text-xl text-white/90 max-w-2xl mx-auto">
                    Découvrez les meilleurs restaurateurs et artisans culinaires de notre événement
                </p>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="bg-white border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <form action="{{ route('public.recherche') }}" method="GET" class="max-w-2xl mx-auto">
                    <div class="flex">
                        <input type="text" name="q" placeholder="Rechercher un stand, un produit..." 
                               class="flex-1 px-4 py-3 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-r-lg transition-colors">
                            🔍 Rechercher
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if($stands->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($stands as $stand)
                        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden">
                            <!-- Stand Header -->
                            <div class="p-6 border-b">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $stand->nom_stand }}</h3>
                                <p class="text-gray-600 text-sm mb-3">{{ $stand->user->nom_entreprise }}</p>
                                @if($stand->description)
                                    <p class="text-gray-700 text-sm">{{ Str::limit($stand->description, 100) }}</p>
                                @endif
                            </div>

                            <!-- Products Preview -->
                            <div class="p-6">
                                <h4 class="font-medium text-gray-900 mb-3">Produits disponibles</h4>
                                @if($stand->products->count() > 0)
                                    <div class="space-y-2 mb-4">
                                        @foreach($stand->products->take(3) as $produit)
                                            <div class="flex justify-between items-center text-sm">
                                                <span class="text-gray-600">{{ $produit->nom }}</span>
                                                <span class="font-medium text-orange-600">{{ $produit->prix_formate }}</span>
                                            </div>
                                        @endforeach
                                        @if($stand->products->count() > 3)
                                            <p class="text-xs text-gray-500">+ {{ $stand->products->count() - 3 }} autres produits</p>
                                        @endif
                                    </div>
                                @else
                                    <p class="text-sm text-gray-500 mb-4">Aucun produit disponible pour le moment</p>
                                @endif

                                <!-- Action Button -->
                                <a href="{{ route('public.stand', $stand->id) }}" 
                                   class="block w-full bg-gradient-to-r from-orange-500 to-purple-600 hover:from-orange-600 hover:to-purple-700 text-white text-center py-2 px-4 rounded-lg transition-colors">
                                    Voir le stand
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-gray-100 mb-4">
                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun exposant disponible</h3>
                    <p class="text-gray-600 mb-6">Il n'y a actuellement aucun stand approuvé dans le système.</p>
                    <a href="/" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg transition-colors">
                        Retour à l'accueil
                    </a>
                </div>
            @endif
        </div>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h3 class="text-2xl font-bold mb-4">🍽️ Eat&Drink</h3>
                <p class="text-gray-400 mb-6">L'événement culinaire qui connecte passionnés et professionnels</p>
                <div class="flex justify-center space-x-6">
                    <a href="/" class="text-gray-400 hover:text-white transition-colors">Accueil</a>
                    <a href="{{ route('public.exposants') }}" class="text-gray-400 hover:text-white transition-colors">Exposants</a>
                    <a href="{{ route('public.panier') }}" class="text-gray-400 hover:text-white transition-colors">Panier</a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html> 