<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Stand;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:20'],
            'company_name' => ['required', 'string', 'max:255'],
            'activity_type' => ['required', 'string', 'in:restaurant,catering,bakery,beverages,street-food,artisan,other'],
            'experience' => ['nullable', 'string', 'max:1000'],
            'stand_size' => ['nullable', 'string', 'in:small,medium,large'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms' => ['required', 'accepted'],
            'privacy' => ['required', 'accepted'],
        ]);

        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'entrepreneur',
            'phone' => $request->phone,
            'company_name' => $request->company_name,
            'activity_type' => $request->activity_type,
            'experience' => $request->experience,
        ]);

        // Créer la demande de stand
        $stand = Stand::create([
            'user_id' => $user->id,
            'nom_stand' => $request->company_name,
            'size' => $request->stand_size ?? 'medium',
            'status' => 'pending',
            'request_date' => now(),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('entrepreneur.statut');
    }

    /**
     * Affiche le formulaire d'inscription utilisateur simple.
     */
    public function showUserForm(): View
    {
        return view('auth.register_user');
    }

    /**
     * Traite l'inscription d'un utilisateur simple (visiteur).
     */
    public function registerUser(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'participant', // valeur ENUM correcte
        ]);

        event(new Registered($user));
        Auth::login($user);
        return redirect()->route('home')->with('success', 'Inscription réussie, bienvenue !');
    }
}
