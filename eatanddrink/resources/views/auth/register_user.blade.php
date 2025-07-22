@extends('layouts.app')

@section('content')
<section class="register-section" style="display:flex;justify-content:center;align-items:center;min-height:100vh;padding:3rem 0;background:#f8fafc;">
    <div class="register-container" style="width:100%;max-width:480px;margin:auto;background:white;border-radius:18px;box-shadow:0 8px 32px rgba(33,158,188,0.08);padding:2.5rem 2rem;">
        <h1 style="text-align:center;font-size:2rem;font-weight:700;color:#FF6B35;margin-bottom:2rem;">Inscription Utilisateur</h1>
        <form method="POST" action="{{ route('register.user') }}">
            @csrf
            <div class="form-group @error('first_name') error @enderror">
                <label for="first_name">Prénom</label>
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required autofocus>
                @error('first_name')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group @error('last_name') error @enderror">
                <label for="last_name">Nom</label>
                <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                @error('last_name')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group @error('email') error @enderror">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group @error('password') error @enderror">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
                @error('password')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group @error('password_confirmation') error @enderror">
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
                @error('password_confirmation')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-actions" style="margin-top:2rem;">
                <button type="submit" class="btn-primary" style="width:100%;font-size:1.1rem;">
                    <i class="fas fa-user-plus"></i> S'inscrire
                </button>
            </div>
        </form>
    </div>
</section>
@endsection 