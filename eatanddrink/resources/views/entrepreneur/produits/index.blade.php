@extends('layouts.entrepreneur')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-900">Mes Produits</h1>
                    <a href="{{ route('entrepreneur.produits.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded transition duration-150 ease-in-out">
                        + Ajouter un produit
                    </a>
                </div>

                @if($produits->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($produits as $produit)
                            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                                @if($produit->image_url)
                                    <img src="{{ asset('storage/' . $produit->image_url) }}" alt="{{ $produit->nom }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                                
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $produit->nom }}</h3>
                                    <p class="text-gray-600 text-sm mb-3">{{ Str::limit($produit->description, 100) }}</p>
                                    <div class="flex justify-between items-center mb-4">
                                        <span class="text-xl font-bold text-green-600">{{ number_format($produit->prix, 2, ',', ' ') }} F CFA</span>
                                        <span class="text-xs text-gray-500">{{ $produit->created_at->format('d/m/Y') }}</span>
                                    </div>
                                    
                                    <div class="flex space-x-2">
                                        <a href="{{ route('entrepreneur.produits.edit', $produit->id) }}" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white text-center font-medium py-2 px-3 rounded text-sm transition duration-150 ease-in-out">
                                            Modifier
                                        </a>
                                        <form method="POST" action="{{ route('entrepreneur.produits.destroy', $produit->id) }}" class="flex-1" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-3 rounded text-sm transition duration-150 ease-in-out">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun produit</h3>
                        <p class="mt-1 text-sm text-gray-500">Commencez par ajouter votre premier produit.</p>
                        <div class="mt-6">
                            <a href="{{ route('entrepreneur.produits.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded transition duration-150 ease-in-out">
                                Ajouter un produit
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 