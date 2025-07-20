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
            'specialties' => ['required', 'string', 'min:10', 'max:500'],
            'description' => ['required', 'string', 'min:50', 'max:1000'],
            'experience' => ['nullable', 'string', 'max:1000'],
            'stand_size' => ['nullable', 'string', 'in:small,medium,large'],
            'equipment' => ['nullable', 'array'],
            'equipment.*' => ['string', 'in:refrigeration,cooking,electricity,water'],
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
            'specialties' => $request->specialties,
            'description' => $request->description,
            'experience' => $request->experience,
        ]);

        // Créer la demande de stand
        $stand = Stand::create([
            'user_id' => $user->id,
            'size' => $request->stand_size ?? 'medium',
            'equipment' => json_encode($request->equipment ?? []),
            'status' => 'pending',
            'request_date' => now(),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
