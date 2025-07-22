@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-900">Stands Approuvés</h1>
                    <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded transition duration-150 ease-in-out">
                        Retour au dashboard
                    </a>
                </div>

                @if($stands->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($stands as $stand)
                            <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $stand->nom_stand }}</h3>
                                        <p class="text-sm text-gray-600">{{ $stand->user->nom_entreprise }}</p>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Approuvé
                                    </span>
                                </div>

                                @if($stand->description)
                                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($stand->description, 100) }}</p>
                                @endif

                                <div class="space-y-2 mb-4">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Produits :</span>
                                        <span class="font-medium">{{ $stand->products->count() }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Commandes :</span>
                                        <span class="font-medium">{{ $stand->orders->count() }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Créé le :</span>
                                        <span class="font-medium">{{ $stand->created_at->format('d/m/Y') }}</span>
                                    </div>
                                </div>

                                <div class="border-t pt-4">
                                    <h4 class="font-medium text-gray-900 mb-2">Produits disponibles</h4>
                                    @if($stand->products->count() > 0)
                                        <div class="space-y-1">
                                            @foreach($stand->products->take(3) as $produit)
                                                <div class="flex justify-between items-center text-sm">
                                                    <span class="text-gray-600">{{ $produit->nom }}</span>
                                                    <span class="font-medium">{{ $produit->prix_formate }}</span>
                                                </div>
                                            @endforeach
                                            @if($stand->products->count() > 3)
                                                <p class="text-xs text-gray-500">+ {{ $stand->products->count() - 3 }} autres produits</p>
                                            @endif
                                        </div>
                                    @else
                                        <p class="text-sm text-gray-500">Aucun produit disponible</p>
                                    @endif
                                </div>

                                <div class="mt-4 flex justify-end">
                                    <a href="{{ route('stand.show', $stand->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        Voir le stand →
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-gray-100 mb-4">
                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun stand approuvé</h3>
                        <p class="text-gray-600 mb-6">Il n'y a actuellement aucun stand approuvé dans le système.</p>
                        <a href="{{ route('admin.demandes') }}" class="bg-purple-500 hover:bg-purple-600 text-white font-medium py-2 px-4 rounded transition duration-150 ease-in-out">
                            Voir les demandes en attente
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 