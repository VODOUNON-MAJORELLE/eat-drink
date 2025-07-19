@extends('layouts.entrepreneur')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="text-center">
                    <div class="mb-6">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100">
                            <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="mt-4 text-2xl font-bold text-gray-900">Demande en cours d'examen</h2>
                        <p class="mt-2 text-gray-600">Votre demande de stand est actuellement en cours d'examen par nos administrateurs.</p>
                    </div>

                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-semibold text-yellow-800 mb-4">Informations de votre demande</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-left">
                            <div>
                                <p class="text-sm font-medium text-gray-700">Nom de l'entreprise</p>
                                <p class="text-lg text-gray-900">{{ $user->nom_entreprise }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Email</p>
                                <p class="text-lg text-gray-900">{{ $user->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Statut</p>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    En attente d'approbation
                                </span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Date de demande</p>
                                <p class="text-lg text-gray-900">{{ $user->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-blue-800 mb-4">Prochaines étapes</h3>
                        <div class="space-y-3 text-left">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-6 w-6 rounded-full bg-blue-100">
                                        <span class="text-sm font-medium text-blue-600">1</span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-800">Notre équipe examine votre demande</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-6 w-6 rounded-full bg-gray-100">
                                        <span class="text-sm font-medium text-gray-600">2</span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-gray-600">Vous recevrez une notification par email</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-6 w-6 rounded-full bg-gray-100">
                                        <span class="text-sm font-medium text-gray-600">3</span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-gray-600">Accès à votre espace entrepreneur</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <a href="{{ route('dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded transition duration-150 ease-in-out">
                            Retour au dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 