@extends('layouts.entrepreneur')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-900">Mes Commandes</h1>
                    <div class="text-sm text-gray-600">
                        Stand : <span class="font-semibold">{{ $stand->nom_stand }}</span>
                    </div>
                </div>

                @if($commandes->count() > 0)
                    <div class="space-y-6">
                        @foreach($commandes as $commande)
                            <div class="border border-gray-200 rounded-lg p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            Commande #{{ $commande->id }}
                                        </h3>
                                        <p class="text-sm text-gray-600">
                                            {{ $commande->date_commande_formatee }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-bold text-green-600">
                                            {{ $commande->total_formate }}
                                        </p>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Nouvelle
                                        </span>
                                    </div>
                                </div>

                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h4 class="font-medium text-gray-900 mb-3">Détails de la commande</h4>
                                    <div class="space-y-2">
                                        @foreach($commande->details_commande as $produitId => $details)
                                            <div class="flex justify-between items-center">
                                                <div class="flex items-center space-x-3">
                                                    @if(isset($details['image_url']))
                                                        <img src="{{ asset('storage/' . $details['image_url']) }}" 
                                                             alt="{{ $details['nom'] }}" 
                                                             class="w-10 h-10 object-cover rounded">
                                                    @else
                                                        <div class="w-10 h-10 bg-gray-200 rounded flex items-center justify-center">
                                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <p class="font-medium text-gray-900">{{ $details['nom'] }}</p>
                                                        <p class="text-sm text-gray-600">{{ number_format($details['prix'], 2, ',', ' ') }} €</p>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <p class="font-medium text-gray-900">{{ $details['quantite'] }}x</p>
                                                    <p class="text-sm text-gray-600">{{ number_format($details['prix'] * $details['quantite'], 2, ',', ' ') }} €</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="mt-4 flex justify-end space-x-3">
                                    <button class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded transition duration-150 ease-in-out">
                                        Marquer comme traitée
                                    </button>
                                    <button class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded transition duration-150 ease-in-out">
                                        Voir les détails
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-gray-100 mb-4">
                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune commande reçue</h3>
                        <p class="text-gray-600 mb-6">Vous n'avez pas encore reçu de commandes pour votre stand.</p>
                        <a href="{{ route('entrepreneur.produits') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-4 rounded transition duration-150 ease-in-out">
                            Gérer mes produits
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 