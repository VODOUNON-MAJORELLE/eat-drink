@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-3xl font-bold text-gray-900 mb-8">Dashboard Administrateur</h1>
                
                <!-- Statistiques -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-blue-100 p-6 rounded-lg">
                        <div class="flex items-center">
                            <div class="p-2 bg-blue-500 rounded-full">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-blue-600">Total Entrepreneurs</p>
                                <p class="text-2xl font-semibold text-blue-900">{{ $stats['total_entrepreneurs'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-yellow-100 p-6 rounded-lg">
                        <div class="flex items-center">
                            <div class="p-2 bg-yellow-500 rounded-full">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-yellow-600">Demandes en Attente</p>
                                <p class="text-2xl font-semibold text-yellow-900">{{ $stats['demandes_en_attente'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-green-100 p-6 rounded-lg">
                        <div class="flex items-center">
                            <div class="p-2 bg-green-500 rounded-full">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-green-600">Entrepreneurs Approuvés</p>
                                <p class="text-2xl font-semibold text-green-900">{{ $stats['entrepreneurs_approuves'] }}</p>
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
                                <p class="text-sm font-medium text-purple-600">Total Commandes</p>
                                <p class="text-2xl font-semibold text-purple-900">{{ $stats['total_commandes'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions rapides -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white border border-gray-200 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions Rapides</h3>
                        <div class="space-y-3">
                            <a href="{{ route('admin.demandes') }}" class="block w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded text-center transition duration-150 ease-in-out">
                                Voir les demandes en attente
                            </a>
                            <a href="{{ route('admin.stands') }}" class="block w-full bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded text-center transition duration-150 ease-in-out">
                                Voir tous les stands
                            </a>
                            <a href="{{ route('admin.commandes') }}" class="block w-full bg-purple-500 hover:bg-purple-600 text-white font-medium py-2 px-4 rounded text-center transition duration-150 ease-in-out">
                                Voir les commandes
                            </a>
                        </div>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations</h3>
                        <div class="space-y-2 text-sm text-gray-600">
                            <p>• <strong>{{ $stats['demandes_en_attente'] }}</strong> demandes de stand en attente de validation</p>
                            <p>• <strong>{{ $stats['entrepreneurs_approuves'] }}</strong> entrepreneurs actifs</p>
                            <p>• <strong>{{ $stats['total_stands'] }}</strong> stands créés</p>
                            <p>• <strong>{{ $stats['total_commandes'] }}</strong> commandes passées</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 