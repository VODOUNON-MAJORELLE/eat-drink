@extends('layouts.entrepreneur')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-3xl font-bold text-gray-900 mb-8">Dashboard de mon Stand</h1>
                
                @if($stand)
                    <!-- Informations du stand -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
                        <h2 class="text-xl font-semibold text-blue-900 mb-4">Informations de mon stand</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-blue-700">Nom du stand</p>
                                <p class="text-lg text-blue-900">{{ $stand->nom_stand }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-blue-700">Description</p>
                                <p class="text-lg text-blue-900">{{ $stand->description ?: 'Aucune description' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Statistiques -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-green-100 p-6 rounded-lg">
                            <div class="flex items-center">
                                <div class="p-2 bg-green-500 rounded-full">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-green-600">Total Produits</p>
                                    <p class="text-2xl font-semibold text-green-900">{{ $stats['total_produits'] }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-purple-100 p-6 rounded-lg">
                            <div class="flex items-center">
                                <div class="p-2 bg-purple-500 rounded-full">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-purple-600">Commandes Reçues</p>
                                    <p class="text-2xl font-semibold text-purple-900">{{ $stats['total_commandes'] }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-orange-100 p-6 rounded-lg">
                            <div class="flex items-center">
                                <div class="p-2 bg-orange-500 rounded-full">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-orange-600">Revenus Totaux</p>
                                    <p class="text-2xl font-semibold text-orange-900">{{ number_format($stats['revenus_totaux'], 2, ',', ' ') }} F CFA</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions rapides -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white border border-gray-200 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Gestion des Produits</h3>
                            <div class="space-y-3">
                                <a href="{{ route('entrepreneur.produits.index') }}" class="block w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded text-center transition duration-150 ease-in-out">
                                    Voir mes produits
                                </a>
                                <a href="{{ route('entrepreneur.produits.create') }}" class="block w-full bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded text-center transition duration-150 ease-in-out">
                                    Ajouter un produit
                                </a>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Commandes</h3>
                            <div class="space-y-3">
                                <a href="{{ route('entrepreneur.commandes') }}" class="block w-full bg-purple-500 hover:bg-purple-600 text-white font-medium py-2 px-4 rounded text-center transition duration-150 ease-in-out">
                                    Voir mes commandes
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun stand créé</h3>
                        <p class="mt-1 text-sm text-gray-500">Votre stand sera créé automatiquement après approbation.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 