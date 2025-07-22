<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function loginVisitor(Request $request) {
        // À implémenter : logique de connexion visiteur
        return back()->withErrors(['email' => 'Connexion visiteur non implémentée.']);
    }
    public function loginEntrepreneur(Request $request) {
        // À implémenter : logique de connexion entrepreneur
        return back()->withErrors(['email' => 'Connexion entrepreneur non implémentée.']);
    }
    public function loginAdmin(Request $request) {
        // À implémenter : logique de connexion admin
        return back()->withErrors(['email' => 'Connexion admin non implémentée.']);
    }

    public function loginMulti(Request $request)
    {
        $request->validate([
            'role' => 'required|in:participant,entrepreneur,admin',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $role = $request->input('role');

        // On suppose que le champ "role" existe sur la table users (adapter si besoin)
        if (Auth::attempt(array_merge($credentials, ['role' => $role]))) {
            $request->session()->regenerate();
            // Redirection selon le rôle
            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role === 'entrepreneur') {
                return redirect()->route('entrepreneur.statut');
            } else {
                return redirect()->route('home'); // Redirige le participant vers l'accueil
            }
        }

        return back()->withErrors([
            'email' => 'Identifiants ou rôle incorrects.',
        ])->withInput($request->except('password'));
    }
}
