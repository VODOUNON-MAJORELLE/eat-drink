@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-900">Commandes par Stand</h1>
                    <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded transition duration-150 ease-in-out">
                        Retour au dashboard
                    </a>
                </div>

                @if($stands->count() > 0)
                    <div class="space-y-8">
                        @foreach($stands as $stand)
                            <div class="border border-gray-200 rounded-lg p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-xl font-semibold text-gray-900">{{ $stand->nom_stand }}</h3>
                                        <p class="text-sm text-gray-600">{{ $stand->user->nom_entreprise }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-bold text-green-600">
                                            {{ $stand->orders->sum('total') ? number_format($stand->orders->sum('total'), 2, ',', ' ') . ' €' : '0,00 €' }}
                                        </p>
                                        <p class="text-sm text-gray-600">{{ $stand->orders->count() }} commande(s)</p>
                                    </div>
                                </div>

                                @if($stand->orders->count() > 0)
                                    <div class="space-y-4">
                                        @foreach($stand->orders as $commande)
                                            <div class="bg-gray-50 rounded-lg p-4">
                                                <div class="flex justify-between items-start mb-3">
                                                    <div>
                                                        <h4 class="font-medium text-gray-900">Commande #{{ $commande->id }}</h4>
                                                        <p class="text-sm text-gray-600">{{ $commande->date_commande_formatee }}</p>
                                                    </div>
                                                    <div class="text-right">
                                                        <p class="font-bold text-green-600">{{ $commande->total_formate }}</p>
                                                    </div>
                                                </div>

                                                <div class="border-t pt-3">
                                                    <h5 class="font-medium text-gray-900 mb-2">Produits commandés</h5>
                                                    <div class="space-y-1">
                                                        @foreach($commande->details_commande as $produitId => $details)
                                                            <div class="flex justify-between items-center text-sm">
                                                                <span class="text-gray-600">{{ $details['nom'] }} (x{{ $details['quantite'] }})</span>
                                                                <span class="font-medium">{{ number_format($details['prix'] * $details['quantite'], 2, ',', ' ') }} €</span>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-6">
                                        <div class="mx-auto flex items-center justify-center h-8 w-8 rounded-full bg-gray-100 mb-2">
                                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-sm text-gray-500">Aucune commande pour ce stand</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Résumé global -->
                    <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-blue-900 mb-4">Résumé global</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="text-center">
                                <p class="text-2xl font-bold text-blue-600">{{ $stands->count() }}</p>
                                <p class="text-sm text-blue-800">Stands avec commandes</p>
                            </div>
                            <div class="text-center">
                                <p class="text-2xl font-bold text-blue-600">{{ $stands->sum(function($stand) { return $stand->orders->count(); }) }}</p>
                                <p class="text-sm text-blue-800">Total commandes</p>
                            </div>
                            <div class="text-center">
                                <p class="text-2xl font-bold text-blue-600">{{ number_format($stands->sum(function($stand) { return $stand->orders->sum('total'); }), 2, ',', ' ') }} €</p>
                                <p class="text-sm text-blue-800">Chiffre d'affaires</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-gray-100 mb-4">
                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune commande</h3>
                        <p class="text-gray-600 mb-6">Il n'y a actuellement aucune commande dans le système.</p>
                        <a href="{{ route('admin.stands') }}" class="bg-purple-500 hover:bg-purple-600 text-white font-medium py-2 px-4 rounded transition duration-150 ease-in-out">
                            Voir les stands
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 