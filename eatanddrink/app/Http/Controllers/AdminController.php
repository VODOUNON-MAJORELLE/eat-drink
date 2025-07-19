<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Stand;
use App\Models\Order;
use App\Mail\DemandeApprouvee;
use App\Mail\DemandeRejetee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    /**
     * Afficher le tableau de bord admin
     */
    public function dashboard()
    {
        // Statistiques pour le dashboard
        $stats = [
            'total_entrepreneurs' => User::where('role', '!=', User::ROLE_ADMIN)->count(),
            'demandes_en_attente' => User::where('role', User::ROLE_ENTREPRENEUR_EN_ATTENTE)->count(),
            'entrepreneurs_approuves' => User::where('role', User::ROLE_ENTREPRENEUR_APPROUVE)->count(),
            'total_stands' => Stand::count(),
            'total_commandes' => Order::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Afficher la liste des demandes de stand en attente
     */
    public function demandesEnAttente()
    {
        $demandes = User::where('role', User::ROLE_ENTREPRENEUR_EN_ATTENTE)
            ->with('stand')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.demandes', compact('demandes'));
    }

    /**
     * Approuver une demande de stand
     */
    public function approuverDemande(Request $request, $userId)
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($userId);
            
            if ($user->role !== User::ROLE_ENTREPRENEUR_EN_ATTENTE) {
                return back()->with('error', 'Cette demande ne peut pas être approuvée.');
            }

            // Mettre à jour le rôle et le statut
            $user->update([
                'role' => User::ROLE_ENTREPRENEUR_APPROUVE,
                'statut' => User::STATUT_APPROUVE,
            ]);

            // Créer un stand pour cet utilisateur s'il n'en a pas
            if (!$user->stand) {
                Stand::create([
                    'nom_stand' => $user->nom_entreprise,
                    'description' => 'Stand de ' . $user->nom_entreprise,
                    'user_id' => $user->id,
                ]);
            }

            DB::commit();

            // Envoyer un email de notification
            Mail::to($user->email)->send(new DemandeApprouvee($user));

            return back()->with('success', 'La demande de ' . $user->nom_entreprise . ' a été approuvée avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Une erreur est survenue lors de l\'approbation.');
        }
    }

    /**
     * Rejeter une demande de stand
     */
    public function rejeterDemande(Request $request, $userId)
    {
        $request->validate([
            'motif_rejet' => 'required|string|max:500',
        ]);

        try {
            $user = User::findOrFail($userId);
            
            if ($user->role !== User::ROLE_ENTREPRENEUR_EN_ATTENTE) {
                return back()->with('error', 'Cette demande ne peut pas être rejetée.');
            }

            $user->update([
                'statut' => User::STATUT_REJETE,
            ]);

            // Envoyer un email de notification
            Mail::to($user->email)->send(new DemandeRejetee($user, $request->motif_rejet));

            return back()->with('success', 'La demande de ' . $user->nom_entreprise . ' a été rejetée.');

        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors du rejet.');
        }
    }

    /**
     * Afficher la liste des stands approuvés
     */
    public function standsApprouves()
    {
        $stands = Stand::with(['user', 'products'])
            ->whereHas('user', function ($query) {
                $query->where('statut', User::STATUT_APPROUVE);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.stands', compact('stands'));
    }

    /**
     * Afficher les commandes par stand
     */
    public function commandesParStand()
    {
        $stands = Stand::with(['user', 'orders'])
            ->whereHas('user', function ($query) {
                $query->where('statut', User::STATUT_APPROUVE);
            })
            ->whereHas('orders')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.commandes', compact('stands'));
    }
} 