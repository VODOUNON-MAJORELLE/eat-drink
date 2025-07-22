<?php

namespace App\Http\Controllers;

use App\Models\Stand;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Afficher la liste des exposants (stands approuvés)
     */
    public function exposants(Request $request)
    {
        $query = Stand::with(['user', 'products'])
            ->whereHas('user', function ($query) {
                $query->where('statut', 'approuve');
            });

        // Filtres
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nom_stand', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('nom_entreprise', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('categorie')) {
            $query->where('categorie', $request->categorie);
        }

        if ($request->filled('prix_max')) {
            $query->whereHas('products', function ($q) use ($request) {
                $q->where('prix', '<=', $request->prix_max);
            });
        }

        // Tri
        $sort = $request->get('sort', 'nom');
        switch ($sort) {
            case 'note':
                $query->orderBy('note', 'desc');
                break;
            case 'prix':
                $query->orderBy('prix_min', 'asc');
                break;
            default:
                $query->orderBy('nom_stand', 'asc');
        }

        $stands = $query->paginate(12);

        return view('public.exposants', compact('stands'));
    }

    /**
     * Afficher un stand spécifique avec ses produits
     */
    public function stand($id)
    {
        $stand = Stand::with(['user', 'products'])
            ->whereHas('user', function ($query) {
                $query->where('statut', 'approuve');
            })
            ->findOrFail($id);
        $products = $stand->products;
        return view('public.stand', compact('stand', 'products'));
    }

    /**
     * Afficher la page programme du festival
     */
    public function programme()
    {
        return view('programme');
    }

    /**
     * Afficher le panier
     */
    public function panier()
    {
        $panier = session()->get('panier', []);
        $stands = collect();
        
        if (!empty($panier)) {
            $standIds = array_keys($panier);
            $stands = Stand::with(['user', 'products'])
                ->whereIn('id', $standIds)
                ->get();
        }

        return view('public.panier', compact('panier', 'stands'));
    }

    /**
     * Ajouter un produit au panier
     */
    public function ajouterAuPanier(Request $request)
    {
        $request->validate([
            'stand_id' => 'required|exists:stands,id',
            'produit_id' => 'required|exists:products,id',
            'quantite' => 'required|integer|min:1|max:99',
        ]);

        $stand = Stand::with(['user', 'products'])
            ->whereHas('user', function ($query) {
                $query->where('statut', 'approuve');
            })
            ->findOrFail($request->stand_id);

        $produit = $stand->products()->findOrFail($request->produit_id);

        $panier = session()->get('panier', []);
        $standId = $stand->id;
        $produitId = $produit->id;

        // Initialiser le stand dans le panier s'il n'existe pas
        if (!isset($panier[$standId])) {
            $panier[$standId] = [
                'nom_stand' => $stand->nom_stand,
                'produits' => []
            ];
        }

        // Ajouter ou mettre à jour le produit
        if (isset($panier[$standId]['produits'][$produitId])) {
            $panier[$standId]['produits'][$produitId]['quantite'] += $request->quantite;
        } else {
            $panier[$standId]['produits'][$produitId] = [
                'nom' => $produit->nom,
                'prix' => $produit->prix,
                'quantite' => $request->quantite,
                'image_url' => $produit->image_url,
            ];
        }

        session()->put('panier', $panier);

        return back()->with('success', $produit->nom . ' ajouté au panier.');
    }

    /**
     * Supprimer un produit du panier
     */
    public function supprimerDuPanier(Request $request)
    {
        $request->validate([
            'stand_id' => 'required|exists:stands,id',
            'produit_id' => 'required|exists:products,id',
        ]);

        $panier = session()->get('panier', []);
        $standId = $request->stand_id;
        $produitId = $request->produit_id;

        if (isset($panier[$standId]['produits'][$produitId])) {
            unset($panier[$standId]['produits'][$produitId]);
            
            // Supprimer le stand s'il n'a plus de produits
            if (empty($panier[$standId]['produits'])) {
                unset($panier[$standId]);
            }
        }

        session()->put('panier', $panier);

        return back()->with('success', 'Produit supprimé du panier.');
    }

    /**
     * Vider le panier
     */
    public function viderPanier()
    {
        session()->forget('panier');
        return back()->with('success', 'Panier vidé.');
    }

    /**
     * Passer une commande
     */
    public function passerCommande(Request $request)
    {
        $request->validate([
            'stand_id' => 'required|exists:stands,id',
        ]);

        $panier = session()->get('panier', []);
        $standId = $request->stand_id;

        if (!isset($panier[$standId]) || empty($panier[$standId]['produits'])) {
            return back()->with('error', 'Aucun produit à commander pour ce stand.');
        }

        $stand = Stand::findOrFail($standId);
        $detailsCommande = $panier[$standId]['produits'];

        // Créer la commande
        Order::create([
            'stand_id' => $standId,
            'details_commande' => $detailsCommande,
            'date_commande' => now(),
        ]);

        // Supprimer les produits commandés du panier
        unset($panier[$standId]);
        if (empty($panier)) {
            session()->forget('panier');
        } else {
            session()->put('panier', $panier);
        }

        return redirect()->route('exposants')
            ->with('success', 'Commande passée avec succès !');
    }

    /**
     * Rechercher des stands ou produits
     */
    public function rechercher(Request $request)
    {
        $request->validate([
            'q' => 'required|string|min:2|max:100',
        ]);

        $query = $request->q;

        $stands = Stand::with(['user', 'products'])
            ->whereHas('user', function ($q) {
                $q->where('statut', 'approuve');
            })
            ->where(function ($q) use ($query) {
                $q->where('nom_stand', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhereHas('user', function ($userQuery) use ($query) {
                      $userQuery->where('nom_entreprise', 'like', "%{$query}%");
                  })
                  ->orWhereHas('products', function ($productQuery) use ($query) {
                      $productQuery->where('nom', 'like', "%{$query}%")
                                   ->orWhere('description', 'like', "%{$query}%");
                  });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('public.recherche', compact('stands', 'query'));
    }
} 