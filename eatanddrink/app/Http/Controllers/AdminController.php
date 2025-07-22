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
            'total_entrepreneurs' => User::where('role', '!=', 'admin')->count(),
            'demandes_en_attente' => User::where('role', 'participant')->count(),
            'entrepreneurs_approuves' => User::where('role', 'entrepreneur')->count(),
            'total_stands' => Stand::count(),
            'total_commandes' => Order::count(),
            // Ajout de stats fictives pour le front
            'chiffre_affaires' => '15.2M FCFA',
            'visiteurs' => 8234,
        ];

        // Demandes
        $pendingRequests = User::where('role', 'participant')->get();
        $approvedRequests = User::where('role', 'entrepreneur')->get();
        $rejectedRequests = User::where('role', 'rejected')->get(); // à adapter si tu as un champ statut

        // Commandes (exemple simplifié)
        $orders = Order::with(['stand', 'user'])->orderBy('date_commande', 'desc')->limit(20)->get();

        return view('admin.dashboard', [
            'stats' => $stats,
            'pendingRequests' => $pendingRequests,
            'approvedRequests' => $approvedRequests,
            'rejectedRequests' => $rejectedRequests,
            'pendingCount' => $pendingRequests->count(),
            'approvedCount' => $approvedRequests->count(),
            'rejectedCount' => $rejectedRequests->count(),
            'orders' => $orders,
        ]);
    }

    /**
     * Afficher la liste des demandes de stand en attente
     */
    public function demandesEnAttente()
    {
        $demandes = User::where('role', 'participant')
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
            
            if ($user->role !== 'participant') {
                return back()->with('error', 'Cette demande ne peut pas être approuvée.');
            }

            // Mettre à jour le rôle et le statut
            $user->update([
                'role' => 'entrepreneur',
                // 'statut' => 'approuve', // décommente si le champ existe encore
            ]);

            // Créer un stand pour cet utilisateur s'il n'en a pas
            if (!$user->stand) {
                Stand::create([
                    'nom_stand' => $user->company_name ?? $user->name,
                    'description' => 'Stand de ' . ($user->company_name ?? $user->name),
                    'user_id' => $user->id,
                ]);
            }

            DB::commit();

            // Envoyer un email de notification
            Mail::to($user->email)->send(new DemandeApprouvee($user));

            return back()->with('success', 'La demande de ' . ($user->company_name ?? $user->name) . ' a été approuvée avec succès.');

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
            
            if ($user->role !== 'participant') {
                return back()->with('error', 'Cette demande ne peut pas être rejetée.');
            }

            $user->update([
                // 'statut' => 'rejete', // décommente si le champ existe encore
            ]);

            // Envoyer un email de notification
            Mail::to($user->email)->send(new DemandeRejetee($user, $request->motif_rejet));

            return back()->with('success', 'La demande de ' . ($user->company_name ?? $user->name) . ' a été rejetée.');

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