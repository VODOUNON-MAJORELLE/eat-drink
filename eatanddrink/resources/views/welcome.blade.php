<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Eat&Drink - Événement Culinaire</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

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
            .floating-shape {
                animation: float 6s ease-in-out infinite;
            }
            .floating-shape-2 {
                animation: float 8s ease-in-out infinite reverse;
            }
            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                50% { transform: translateY(-20px) rotate(5deg); }
            }
            .glass-effect {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
        </style>
    </head>
    <body class="min-h-screen overflow-x-hidden">
        <!-- Background with floating shapes -->
        <div class="fixed inset-0 gradient-bg">
            <!-- Floating decorative shapes -->
            <div class="absolute top-20 left-10 w-32 h-32 bg-white/10 rounded-full floating-shape"></div>
            <div class="absolute top-40 right-20 w-24 h-24 bg-purple-300/20 rounded-full floating-shape-2"></div>
            <div class="absolute bottom-40 left-20 w-40 h-40 bg-orange-300/15 rounded-full floating-shape"></div>
            <div class="absolute bottom-20 right-10 w-20 h-20 bg-white/10 rounded-full floating-shape-2"></div>
            <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-purple-400/20 rounded-full floating-shape"></div>
        </div>

        <!-- Navigation -->
        <nav class="relative z-50 glass-effect m-4 rounded-2xl">
            <div class="max-w-7xl mx-auto px-6 py-4">
                <div class="flex justify-between items-center">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <h1 class="text-3xl font-bold text-white">
                            🍽️ Eat&Drink
                        </h1>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="/" class="text-white/90 hover:text-white transition-colors font-medium">
                            Accueil
                        </a>
                        <a href="#" class="text-white/90 hover:text-white transition-colors font-medium">
                            Nos Exposants
                        </a>
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a href="#" class="text-white/90 hover:text-white transition-colors font-medium">
                                    Administration
                                </a>
                            @elseif(auth()->user()->role === 'entrepreneur_approuve')
                                <a href="#" class="text-white/90 hover:text-white transition-colors font-medium">
                                    Mon Stand
                                </a>
                            @else
                                <a href="#" class="text-white/90 hover:text-white transition-colors font-medium">
                                    Statut de ma demande
                                </a>
                            @endif
                        @endauth
                    </div>

                    <!-- Auth Buttons -->
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="bg-white/20 hover:bg-white/30 text-white px-6 py-2 rounded-full font-medium transition-all duration-300 backdrop-blur-sm">
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-white/90 hover:text-white transition-colors font-medium">
                                    Déconnexion
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-white/90 hover:text-white transition-colors font-medium">
                                Connexion
                            </a>
                            <a href="{{ route('register') }}" class="bg-white text-purple-600 hover:bg-gray-50 px-6 py-2 rounded-full font-medium transition-all duration-300 shadow-lg hover:shadow-xl">
                                Demander un Stand
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative z-10 min-h-screen flex items-center justify-center px-6">
            <div class="text-center max-w-4xl mx-auto">
                <!-- Main Title -->
                <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
                    Bienvenue à
                    <span class="block gradient-text">Eat&Drink</span>
                </h1>
                
                <!-- Subtitle -->
                <p class="text-xl md:text-2xl text-white/90 mb-12 max-w-3xl mx-auto leading-relaxed">
                    L'événement culinaire qui rassemble les meilleurs restaurateurs et artisans. 
                    Découvrez des saveurs uniques et des créations gastronomiques exceptionnelles.
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                    <a href="#" class="bg-white text-purple-600 hover:bg-gray-50 px-8 py-4 rounded-full text-lg font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                        Découvrir nos exposants
                    </a>
                    @guest
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-orange-500 to-purple-600 hover:from-orange-600 hover:to-purple-700 text-white px-8 py-4 rounded-full text-lg font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                            Demander un stand
                        </a>
                    @endguest
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="relative z-10 py-24 px-6">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-20">
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                        Pourquoi participer à 
                        <span class="gradient-text">Eat&Drink</span> ?
                    </h2>
                    <p class="text-xl text-white/80 max-w-2xl mx-auto">
                        Une plateforme moderne pour connecter exposants et visiteurs
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="glass-effect p-8 rounded-3xl text-center hover:bg-white/20 transition-all duration-300 transform hover:scale-105">
                        <div class="w-20 h-20 bg-gradient-to-r from-orange-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="text-3xl">🍽️</span>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">
                            Exposition de Qualité
                        </h3>
                        <p class="text-white/80 leading-relaxed">
                            Présentez vos meilleures créations culinaires à un public passionné et exigeant
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="glass-effect p-8 rounded-3xl text-center hover:bg-white/20 transition-all duration-300 transform hover:scale-105">
                        <div class="w-20 h-20 bg-gradient-to-r from-purple-500 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="text-3xl">💻</span>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">
                            Gestion Simplifiée
                        </h3>
                        <p class="text-white/80 leading-relaxed">
                            Gérez vos produits et commandes en ligne avec une interface intuitive et moderne
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="glass-effect p-8 rounded-3xl text-center hover:bg-white/20 transition-all duration-300 transform hover:scale-105">
                        <div class="w-20 h-20 bg-gradient-to-r from-orange-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="text-3xl">🎯</span>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">
                            Visibilité Maximale
                        </h3>
                        <p class="text-white/80 leading-relaxed">
                            Augmentez votre visibilité auprès d'un large public de passionnés culinaires
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="relative z-10 py-12 px-6">
            <div class="max-w-4xl mx-auto text-center">
                <h3 class="text-3xl font-bold gradient-text mb-6">🍽️ Eat&Drink</h3>
                <p class="text-white/70 mb-8 text-lg">
                    L'événement culinaire qui connecte passionnés et professionnels
                </p>
                <div class="flex justify-center space-x-8 mb-8">
                    <a href="#" class="text-white/70 hover:text-white transition-colors">
                        À propos
                    </a>
                    <a href="#" class="text-white/70 hover:text-white transition-colors">
                        Contact
                    </a>
                    <a href="#" class="text-white/70 hover:text-white transition-colors">
                        Conditions
                    </a>
                </div>
                <div class="pt-8 border-t border-white/20">
                    <p class="text-white/50 text-sm">
                        © 2024 Eat&Drink. Tous droits réservés.
                    </p>
                </div>
            </div>
        </footer>
    </body>
</html>
