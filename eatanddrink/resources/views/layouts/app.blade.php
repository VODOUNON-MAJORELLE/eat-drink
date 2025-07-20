<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Eat&Drink') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Header -->
        <header class="header">
            <div class="nav-container">
                <div class="logo">
                    <i class="fas fa-utensils"></i>
                    EAT&DRINK
                </div>
                <nav class="nav-menu">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <li><a href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
                            <li><a href="{{ route('admin.demandes') }}">Gestion Demandes</a></li>
                        @elseif(auth()->user()->role === 'entrepreneur')
                            <li><a href="{{ route('entrepreneur.dashboard') }}">Mon Tableau de Bord</a></li>
                            <li><a href="{{ route('entrepreneur.produits.index') }}">Mes Produits</a></li>
                        @else
                            <li><a href="{{ route('home') }}">Accueil</a></li>
                            <li><a href="{{ route('exposants') }}">Nos Exposants</a></li>
                        @endif
                    @else
                        <li><a href="{{ route('home') }}">Accueil</a></li>
                        <li><a href="{{ route('exposants') }}">Nos Exposants</a></li>
                        <li><a href="{{ route('programme') }}">Programme</a></li>
                        <li><a href="#infos">Infos</a></li>
                    @endauth
                </nav>
                <div class="auth-buttons">
                    @auth
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="btn-secondary">
                                <i class="fas fa-sign-out-alt"></i>
                                Se déconnecter
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn-secondary">Se connecter</a>
                        <a href="{{ route('register') }}" class="cta-button">
                            <i class="fas fa-store"></i>
                            S'inscrire comme entrepreneur
                        </a>
                    @endauth
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-content">
                <div class="footer-logo">
                    <i class="fas fa-utensils"></i>
                    EAT&DRINK
                </div>
                <div class="footer-links">
                    <a href="#apropos">À propos</a>
                    <a href="#contact">Contact</a>
                    <a href="#partenaires">Partenaires</a>
                    <a href="#mentions">Mentions légales</a>
                </div>
                <p>&copy; 2025 Eat&Drink Festival. Tous droits réservés.</p>
            </div>
        </footer>

        <!-- Panier flottant -->
        @auth
            @if(auth()->user()->role === 'participant')
                <div class="floating-cart" onclick="window.location.href='{{ route('panier') }}'">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-badge" id="cart-count">
                        {{ session('cart') ? count(session('cart')) : 0 }}
                    </span>
                </div>
            @endif
        @endauth
    </div>
</body>
</html>
