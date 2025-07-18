<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EntrepreneurController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Routes publiques
Route::get('/exposants', [PublicController::class, 'exposants'])->name('public.exposants');
Route::get('/exposants/{id}', [PublicController::class, 'stand'])->name('public.stand');
Route::get('/panier', [PublicController::class, 'panier'])->name('public.panier');
Route::post('/panier/ajouter', [PublicController::class, 'ajouterAuPanier'])->name('public.panier.ajouter');
Route::post('/panier/supprimer', [PublicController::class, 'supprimerDuPanier'])->name('public.panier.supprimer');
Route::post('/panier/vider', [PublicController::class, 'viderPanier'])->name('public.panier.vider');
Route::post('/commande', [PublicController::class, 'passerCommande'])->name('public.commande');
Route::get('/recherche', [PublicController::class, 'rechercher'])->name('public.recherche');

// Routes admin (protégées par middleware admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/demandes', [AdminController::class, 'demandesEnAttente'])->name('demandes');
    Route::post('/demandes/{userId}/approuver', [AdminController::class, 'approuverDemande'])->name('demandes.approuver');
    Route::post('/demandes/{userId}/rejeter', [AdminController::class, 'rejeterDemande'])->name('demandes.rejeter');
    Route::get('/stands', [AdminController::class, 'standsApprouves'])->name('stands');
    Route::get('/commandes', [AdminController::class, 'commandesParStand'])->name('commandes');
});

// Routes entrepreneur (protégées par middleware entrepreneur)
Route::middleware(['auth', 'entrepreneur'])->prefix('entrepreneur')->name('entrepreneur.')->group(function () {
    Route::get('/dashboard', [EntrepreneurController::class, 'dashboard'])->name('dashboard');
    Route::get('/produits', [EntrepreneurController::class, 'produits'])->name('produits');
    Route::get('/produits/create', [EntrepreneurController::class, 'createProduit'])->name('produits.create');
    Route::post('/produits', [EntrepreneurController::class, 'storeProduit'])->name('produits.store');
    Route::get('/produits/{id}/edit', [EntrepreneurController::class, 'editProduit'])->name('produits.edit');
    Route::put('/produits/{id}', [EntrepreneurController::class, 'updateProduit'])->name('produits.update');
    Route::delete('/produits/{id}', [EntrepreneurController::class, 'destroyProduit'])->name('produits.destroy');
    Route::get('/commandes', [EntrepreneurController::class, 'commandes'])->name('commandes');
});

// Route pour entrepreneurs en attente
Route::middleware(['auth'])->group(function () {
    Route::get('/statut', [EntrepreneurController::class, 'statutDemande'])->name('entrepreneur.statut');
});
