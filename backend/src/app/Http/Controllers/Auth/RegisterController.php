<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /**
     * Affiche le formulaire d'inscription (Style Neo-Brutalist).
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Gère la création de l'utilisateur avec validation stricte.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validation des données entrants
        $request->validate([
            'name'     => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required', 
                'confirmed', 
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
        ]);

        // 2. Création de l'utilisateur (Mass Assignment)
        $user = User::create([
            'name'     => strip_tags($request->name), // Protection XSS
            'email'    => $request->email,
            'password' => Hash::make($request->password), // Hachage Bcrypt/Argon2
        ]);

        // 3. Déclenchement de l'événement Laravel (pour l'envoi d'email de vérification)
        // event(new Registered($user));

        // 4. Connexion automatique après inscription
        Auth::login($user);

        // 5. Redirection avec message de succès (Neo-Brutalist Style)
        return redirect()->route('home')
            ->with('success', 'Bienvenue ' . $user->name . ' ! Votre compte API est actif.');
    }
}