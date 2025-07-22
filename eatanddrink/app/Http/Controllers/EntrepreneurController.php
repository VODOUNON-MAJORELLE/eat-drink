<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stand;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EntrepreneurController extends Controller
{
    /**
     * Afficher le tableau de bord entrepreneur
     */
    public function dashboard()
    {
        $user = auth()->user();
        $stand = $user->stand;
        
        $stats = [
            'total_produits' => $stand ? $stand->products()->count() : 0,
            'total_commandes' => $stand ? $stand->orders()->count() : 0,
            'revenus_totaux' => $stand ? $stand->orders()->get()->sum('total') : 0,
        ];

        return view('entrepreneur.dashboard', compact('stand', 'stats'));
    }

    /**
     * Afficher la liste des produits
     */
    public function produits()
    {
        $user = auth()->user();
        $stand = $user->stand;
        
        if (!$stand) {
            return redirect()->route('entrepreneur.dashboard')
                ->with('error', 'Vous devez d\'abord créer votre stand.');
        }

        $produits = $stand->products()->orderBy('created_at', 'desc')->get();

        return view('entrepreneur.produits.index', compact('produits', 'stand'));
    }

    /**
     * Afficher le formulaire de création de produit
     */
    public function createProduit()
    {
        $user = auth()->user();
        $stand = $user->stand;
        
        if (!$stand) {
            return redirect()->route('entrepreneur.dashboard')
                ->with('error', 'Vous devez d\'abord créer votre stand.');
        }

        return view('entrepreneur.produits.create', compact('stand'));
    }

    /**
     * Stocker un nouveau produit
     */
    public function storeProduit(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'prix' => 'required|numeric|min:0|max:999999.99',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();
        $stand = $user->stand;

        if (!$stand) {
            return back()->with('error', 'Vous devez d\'abord créer votre stand.');
        }

        $data = [
            'nom' => $request->nom,
            'description' => $request->description,
            'prix' => $request->prix,
            'stand_id' => $stand->id,
        ];

        // Gestion de l'upload d'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('produits', 'public');
            $data['image_url'] = $imagePath;
        }

        Product::create($data);

        return redirect()->route('entrepreneur.produits')
            ->with('success', 'Produit créé avec succès.');
    }

    /**
     * Afficher le formulaire d'édition de produit
     */
    public function editProduit($id)
    {
        $user = auth()->user();
        $stand = $user->stand;
        
        if (!$stand) {
            return redirect()->route('entrepreneur.dashboard')
                ->with('error', 'Vous devez d\'abord créer votre stand.');
        }

        $produit = $stand->products()->findOrFail($id);

        return view('entrepreneur.produits.edit', compact('produit', 'stand'));
    }

    /**
     * Mettre à jour un produit
     */
    public function updateProduit(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'prix' => 'required|numeric|min:0|max:999999.99',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();
        $stand = $user->stand;
        $produit = $stand->products()->findOrFail($id);

        $data = [
            'nom' => $request->nom,
            'description' => $request->description,
            'prix' => $request->prix,
        ];

        // Gestion de l'upload d'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($produit->image_url) {
                Storage::disk('public')->delete($produit->image_url);
            }
            
            $imagePath = $request->file('image')->store('produits', 'public');
            $data['image_url'] = $imagePath;
        }

        $produit->update($data);

        return redirect()->route('entrepreneur.produits')
            ->with('success', 'Produit mis à jour avec succès.');
    }

    /**
     * Supprimer un produit
     */
    public function destroyProduit($id)
    {
        $user = auth()->user();
        $stand = $user->stand;
        $produit = $stand->products()->findOrFail($id);

        // Supprimer l'image si elle existe
        if ($produit->image_url) {
            Storage::disk('public')->delete($produit->image_url);
        }

        $produit->delete();

        return redirect()->route('entrepreneur.produits')
            ->with('success', 'Produit supprimé avec succès.');
    }

    /**
     * Afficher les commandes reçues
     */
    public function commandes()
    {
        $user = auth()->user();
        $stand = $user->stand;
        
        if (!$stand) {
            return redirect()->route('entrepreneur.dashboard')
                ->with('error', 'Vous devez d\'abord créer votre stand.');
        }

        $commandes = $stand->orders()->orderBy('created_at', 'desc')->get();

        return view('entrepreneur.commandes', compact('commandes', 'stand'));
    }

    /**
     * Afficher le statut de la demande (pour entrepreneurs en attente)
     */
    public function statutDemande()
    {
        $user = auth()->user();
        // SUPPRIMER la redirection automatique pour les approuvés
        // if ($user->isEntrepreneurApprouve()) {
        //     return redirect()->route('entrepreneur.dashboard');
        // }
        return view('entrepreneur.statut', compact('user'));
    }
} 