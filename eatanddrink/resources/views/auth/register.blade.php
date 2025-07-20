@extends('layouts.app')

@section('content')
<section class="inscription-section">
    <div class="inscription-container">
        <div class="inscription-card">
            <div class="inscription-header">
                <h1>🎪 Demande de Stand</h1>
                <p>Rejoignez le plus grand festival culinaire de Cotonou !</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="inscription-form" id="inscription-form">
                @csrf
                <!-- Informations personnelles -->
                <div class="form-section">
                    <h3><i class="fas fa-user"></i> Informations personnelles</h3>
                    <div class="form-row">
                        <div class="form-group @error('first_name') error @enderror">
                            <label for="first_name">Prénom *</label>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                            @error('first_name')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group @error('last_name') error @enderror">
                            <label for="last_name">Nom *</label>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                            @error('last_name')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('email') error @enderror">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group @error('phone') error @enderror">
                        <label for="phone">Téléphone *</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required>
                        @error('phone')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Informations de l'entreprise -->
                <div class="form-section">
                    <h3><i class="fas fa-building"></i> Informations de l'entreprise</h3>
                    <div class="form-group @error('company_name') error @enderror">
                        <label for="company_name">Nom de l'entreprise *</label>
                        <input type="text" id="company_name" name="company_name" value="{{ old('company_name') }}" required>
                        @error('company_name')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group @error('activity_type') error @enderror">
                        <label for="activity_type">Type d'activité *</label>
                        <select id="activity_type" name="activity_type" required>
                            <option value="">Sélectionnez votre activité</option>
                            <option value="restaurant" {{ old('activity_type') == 'restaurant' ? 'selected' : '' }}>Restaurant</option>
                            <option value="catering" {{ old('activity_type') == 'catering' ? 'selected' : '' }}>Traiteur</option>
                            <option value="bakery" {{ old('activity_type') == 'bakery' ? 'selected' : '' }}>Boulangerie/Pâtisserie</option>
                            <option value="beverages" {{ old('activity_type') == 'beverages' ? 'selected' : '' }}>Boissons/Cocktails</option>
                            <option value="street-food" {{ old('activity_type') == 'street-food' ? 'selected' : '' }}>Street Food</option>
                            <option value="artisan" {{ old('activity_type') == 'artisan' ? 'selected' : '' }}>Artisan culinaire</option>
                            <option value="other" {{ old('activity_type') == 'other' ? 'selected' : '' }}>Autre</option>
                        </select>
                        @error('activity_type')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group @error('specialties') error @enderror">
                        <label for="specialties">Spécialités culinaires *</label>
                        <input type="text" id="specialties" name="specialties" value="{{ old('specialties') }}" placeholder="Ex: Cuisine italienne, Pâtisserie française..." required>
                        @error('specialties')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Description de l'activité -->
                <div class="form-section">
                    <h3><i class="fas fa-edit"></i> Description de votre activité</h3>
                    <div class="form-group @error('description') error @enderror">
                        <label for="description">Décrivez votre activité et vos produits *</label>
                        <textarea id="description" name="description" rows="4" placeholder="Décrivez votre cuisine, vos spécialités, votre expérience..." required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group @error('experience') error @enderror">
                        <label for="experience">Expérience dans le domaine</label>
                        <textarea id="experience" name="experience" rows="3" placeholder="Votre expérience, formations, certifications...">{{ old('experience') }}</textarea>
                        @error('experience')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Informations du stand -->
                <div class="form-section">
                    <h3><i class="fas fa-store"></i> Informations du stand</h3>
                    <div class="form-group @error('stand_size') error @enderror">
                        <label for="stand_size">Taille de stand souhaitée</label>
                        <select id="stand_size" name="stand_size">
                            <option value="small" {{ old('stand_size') == 'small' ? 'selected' : '' }}>Petit stand (3x3m)</option>
                            <option value="medium" {{ old('stand_size') == 'medium' ? 'selected' : '' }}>Stand moyen (4x4m)</option>
                            <option value="large" {{ old('stand_size') == 'large' ? 'selected' : '' }}>Grand stand (5x5m)</option>
                        </select>
                        @error('stand_size')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group @error('equipment') error @enderror">
                        <label for="equipment">Équipements nécessaires</label>
                        <div class="checkbox-group">
                            <label class="checkbox">
                                <input type="checkbox" name="equipment[]" value="refrigeration" {{ is_array(old('equipment')) && in_array('refrigeration', old('equipment')) ? 'checked' : '' }}>
                                Réfrigération
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="equipment[]" value="cooking" {{ is_array(old('equipment')) && in_array('cooking', old('equipment')) ? 'checked' : '' }}>
                                Équipement de cuisson
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="equipment[]" value="electricity" {{ is_array(old('equipment')) && in_array('electricity', old('equipment')) ? 'checked' : '' }}>
                                Électricité
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="equipment[]" value="water" {{ is_array(old('equipment')) && in_array('water', old('equipment')) ? 'checked' : '' }}>
                                Point d'eau
                            </label>
                        </div>
                        @error('equipment')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Conditions et accords -->
                <div class="form-section">
                    <h3><i class="fas fa-file-contract"></i> Conditions et accords</h3>
                    <div class="form-group @error('terms') error @enderror">
                        <label class="checkbox">
                            <input type="checkbox" id="terms" name="terms" {{ old('terms') ? 'checked' : '' }} required>
                            J'accepte les <a href="#" onclick="showTerms()">conditions générales</a> *
                        </label>
                        @error('terms')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group @error('privacy') error @enderror">
                        <label class="checkbox">
                            <input type="checkbox" id="privacy" name="privacy" {{ old('privacy') ? 'checked' : '' }} required>
                            J'accepte la <a href="#" onclick="showPrivacy()">politique de confidentialité</a> *
                        </label>
                        @error('privacy')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-paper-plane"></i>
                        Soumettre ma demande
                    </button>
                    <a href="{{ route('login') }}" class="btn-secondary">
                        <i class="fas fa-sign-in-alt"></i>
                        Déjà un compte ? Se connecter
                    </a>
                </div>
            </form>
        </div>

        <!-- Informations complémentaires -->
        <div class="info-sidebar">
            <div class="info-card">
                <h3><i class="fas fa-info-circle"></i> Informations importantes</h3>
                <ul>
                    <li>Les demandes sont examinées sous 48h</li>
                    <li>Un email de confirmation vous sera envoyé</li>
                    <li>Les stands sont attribués selon disponibilité</li>
                    <li>Préparation requise : 15-17 Mars 2025</li>
                </ul>
            </div>

            <div class="info-card">
                <h3><i class="fas fa-phone"></i> Besoin d'aide ?</h3>
                <p>Contactez-nous :</p>
                <p><i class="fas fa-envelope"></i> contact@eatdrink.bj</p>
                <p><i class="fas fa-phone"></i> +229 90 12 34 56</p>
            </div>

            <div class="info-card">
                <h3><i class="fas fa-calendar"></i> Dates importantes</h3>
                <ul>
                    <li><strong>15 Mars :</strong> Ouverture du festival</li>
                    <li><strong>16 Mars :</strong> Journée principale</li>
                    <li><strong>17 Mars :</strong> Clôture</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
