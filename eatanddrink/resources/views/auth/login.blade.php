@extends('layouts.app')

@section('content')
<section class="login-section" style="display:flex; justify-content:center; align-items:center; min-height:100vh; padding-top:4rem; padding-bottom:4rem; background:#f8fafc;">
    <div class="login-container" style="display:flex; justify-content:center; align-items:stretch; gap:3rem; max-width:1200px; width:100%;">
        <div class="login-card" style="margin:auto; width:100%; max-width:500px;">
            <div class="login-header" style="text-align:center;">
                <h1>🔐 Connexion</h1>
                <p>Accédez à votre espace personnel</p>
            </div>
            <form method="POST" action="{{ route('login.multi') }}">
        @csrf
                <div class="form-group @error('role') error @enderror">
                    <label for="role">Je me connecte en tant que</label>
                    <select id="role" name="role" required style="width:100%; padding:1rem; border-radius:10px;">
                        <option value="participant" {{ old('role') == 'participant' ? 'selected' : '' }}>Visiteur</option>
                        <option value="entrepreneur" {{ old('role') == 'entrepreneur' ? 'selected' : '' }}>Entrepreneur</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                    </select>
                    @error('role')<div class="field-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group @error('email') error @enderror">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')<div class="field-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group @error('password') error @enderror">
                    <label for="password">Mot de passe</label>
                    <div class="password-input">
                        <input type="password" id="password" name="password" required>
                        <button type="button" class="toggle-password"><i class="fas fa-eye"></i></button>
                    </div>
                    @error('password')<div class="field-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-sign-in-alt"></i> Se connecter
                    </button>
                </div>
            </form>
            <div class="signup-links">
                <div class="signup-section">
                    <h3>Pas encore de compte ?</h3>
                    <div class="signup-options">
                        <a href="{{ route('register') }}" class="btn-orange">
                            <i class="fas fa-store"></i> S'inscrire comme entrepreneur
                        </a>
                        <a href="{{ route('register.user') }}" class="btn-orange" style="margin-top:1rem;">
                            <i class="fas fa-user"></i> S'inscrire comme utilisateur
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="info-sidebar" style="margin:auto; max-width:300px; min-width:220px; width:25%; display:flex; flex-direction:column; justify-content:center; height:100%;">
            <div style="flex:1; display:flex; flex-direction:column; justify-content:center; gap:1.5rem;">
                <div class="info-card">
                    <h3><i class="fas fa-phone"></i> Support</h3>
                    <p>Notre équipe est là pour vous aider :</p>
                    <p><i class="fas fa-envelope"></i> support@eatdrink.bj</p>
                    <p><i class="fas fa-phone"></i> +229 90 12 34 56</p>
                </div>
                <div class="info-card">
                    <h3><i class="fas fa-calendar"></i> Festival</h3>
                    <p>Le festival approche !</p>
                    <ul>
                        <li><strong>15-17 Mars 2025</strong></li>
                        <li>Palais des Congrès, Cotonou</li>
                        <li>Entrée gratuite</li>
                    </ul>
                </div>
        </div>
        </div>
        </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Affichage/masquage mot de passe
    const toggleBtns = document.querySelectorAll('.toggle-password');
    toggleBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const input = btn.previousElementSibling;
            if (input.type === 'password') {
                input.type = 'text';
                btn.querySelector('i').className = 'fas fa-eye-slash';
            } else {
                input.type = 'password';
                btn.querySelector('i').className = 'fas fa-eye';
            }
        });
    });
});
</script>
@endsection

<style>
.btn-orange {
    background: #FF6B35 !important;
    color: #fff !important;
    border: none !important;
    border-radius: 8px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    font-size: 1rem;
    display: inline-block;
    transition: background 0.2s;
    box-shadow: 0 2px 8px rgba(255,107,53,0.08);
    margin-bottom: 0.5rem;
}
.btn-orange:hover, .btn-orange:focus {
    background: #d35400 !important;
    color: #fff !important;
    text-decoration: none;
}
</style>
