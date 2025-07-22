@extends('layouts.entrepreneur')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-900">Modifier le produit</h1>
                    <a href="{{ route('entrepreneur.produits.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded transition duration-150 ease-in-out">
                        Retour aux produits
                    </a>
                </div>

                <form method="POST" action="{{ route('entrepreneur.produits.update', $produit->id) }}" enctype="multipart/form-data" class="max-w-2xl">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-6">
                        <!-- Nom du produit -->
                        <div>
                            <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">
                                Nom du produit *
                            </label>
                            <input type="text" name="nom" id="nom" value="{{ old('nom', $produit->nom) }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            @error('nom')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Description
                            </label>
                            <textarea name="description" id="description" rows="4"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">{{ old('description', $produit->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Prix -->
                        <div>
                            <label for="prix" class="block text-sm font-medium text-gray-700 mb-2">
                                Prix (F CFA) *
                            </label>
                            <input type="number" name="prix" id="prix" value="{{ old('prix', $produit->prix) }}" step="0.01" min="0" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            @error('prix')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Image actuelle -->
                        @if($produit->image_url)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Image actuelle
                                </label>
                                <div class="flex items-center space-x-4">
                                    <img src="{{ asset('storage/' . $produit->image_url) }}" alt="{{ $produit->nom }}" class="w-32 h-32 object-cover rounded-lg border">
                                    <div>
                                        <p class="text-sm text-gray-600">Image actuelle</p>
                                        <p class="text-xs text-gray-500">Une nouvelle image remplacera celle-ci</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Nouvelle image -->
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                Nouvelle image (optionnel)
                            </label>
                            <input type="file" name="image" id="image" accept="image/*"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            <p class="mt-1 text-sm text-gray-500">Formats acceptés : JPEG, PNG, JPG, GIF. Taille max : 2MB.</p>
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Boutons -->
                        <div class="flex justify-end space-x-3 pt-6">
                            <a href="{{ route('entrepreneur.produits.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded transition duration-150 ease-in-out">
                                Annuler
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded transition duration-150 ease-in-out">
                                Mettre à jour
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 