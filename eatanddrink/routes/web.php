<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EntrepreneurController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\WorkshopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Accès public : accueil, connexion, inscription
Route::get('/', function () {
    return view('welcome');
})->name('home');

require __DIR__.'/auth.php';
Route::get('/register/user', [App\Http\Controllers\Auth\RegisteredUserController::class, 'showUserForm'])->name('register.user');
Route::post('/register/user', [App\Http\Controllers\Auth\RegisteredUserController::class, 'registerUser']);

// Toutes les autres routes publiques nécessitent d'être connecté
Route::middleware('auth')->group(function () {
    Route::get('/exposants', [PublicController::class, 'exposants'])->name('exposants');
    Route::get('/exposants/{id}', [PublicController::class, 'stand'])->name('stand.show');
    Route::get('/programme', [PublicController::class, 'programme'])->name('programme');
    Route::get('/ateliers', [WorkshopController::class, 'index'])->name('workshops.index');
    Route::get('/ateliers/{id}', [WorkshopController::class, 'show'])->name('workshops.show');
    Route::post('/ateliers/inscription', [WorkshopController::class, 'register'])->name('workshops.register');
    Route::get('/calendrier', [WorkshopController::class, 'calendar'])->name('calendar');
    Route::post('/calendrier/ajouter', [WorkshopController::class, 'addToCalendar'])->name('calendar.add');
    Route::get('/panier', [PublicController::class, 'panier'])->name('panier');
    Route::post('/panier/ajouter', [PublicController::class, 'ajouterAuPanier'])->name('panier.ajouter');
    Route::post('/panier/supprimer', [PublicController::class, 'supprimerDuPanier'])->name('panier.supprimer');
    Route::post('/panier/vider', [PublicController::class, 'viderPanier'])->name('panier.vider');
    Route::post('/commande', [PublicController::class, 'passerCommande'])->name('commande');
    Route::get('/recherche', [PublicController::class, 'rechercher'])->name('recherche');
});

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
    Route::get('/produits', [EntrepreneurController::class, 'produits'])->name('produits.index');
    Route::get('/produits/create', [EntrepreneurController::class, 'createProduit'])->name('produits.create');
    Route::post('/produits', [EntrepreneurController::class, 'storeProduit'])->name('produits.store');
    Route::get('/produits/{id}/edit', [EntrepreneurController::class, 'editProduit'])->name('produits.edit');
    Route::put('/produits/{id}', [EntrepreneurController::class, 'updateProduit'])->name('produits.update');
    Route::delete('/produits/{id}', [EntrepreneurController::class, 'destroyProduit'])->name('produits.destroy');
    Route::get('/commandes', [EntrepreneurController::class, 'commandes'])->name('commandes');
    Route::get('/statut', [EntrepreneurController::class, 'statutDemande'])->name('statut');
});

// Route pour entrepreneurs en attente
Route::middleware(['auth'])->group(function () {
    Route::get('/statut', [EntrepreneurController::class, 'statutDemande'])->name('entrepreneur.statut');
});

Route::post('/login/visitor', [AuthenticatedSessionController::class, 'loginVisitor'])->name('login.visitor');
Route::post('/login/entrepreneur', [AuthenticatedSessionController::class, 'loginEntrepreneur'])->name('login.entrepreneur');
Route::post('/login/admin', [AuthenticatedSessionController::class, 'loginAdmin'])->name('login.admin');
Route::post('/login/multi', [AuthenticatedSessionController::class, 'loginMulti'])->name('login.multi');
