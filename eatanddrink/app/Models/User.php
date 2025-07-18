<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nom_entreprise',
        'email',
        'password',
        'role',
        'statut',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Constantes pour les rôles
     */
    const ROLE_ADMIN = 'admin';
    const ROLE_ENTREPRENEUR_EN_ATTENTE = 'entrepreneur_en_attente';
    const ROLE_ENTREPRENEUR_APPROUVE = 'entrepreneur_approuve';

    /**
     * Constantes pour les statuts
     */
    const STATUT_EN_ATTENTE = 'en_attente';
    const STATUT_APPROUVE = 'approuve';
    const STATUT_REJETE = 'rejete';

    /**
     * Vérifie si l'utilisateur est admin
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * Vérifie si l'utilisateur est entrepreneur approuvé
     */
    public function isEntrepreneurApprouve(): bool
    {
        return $this->role === self::ROLE_ENTREPRENEUR_APPROUVE;
    }

    /**
     * Vérifie si l'utilisateur est entrepreneur en attente
     */
    public function isEntrepreneurEnAttente(): bool
    {
        return $this->role === self::ROLE_ENTREPRENEUR_EN_ATTENTE;
    }

    /**
     * Vérifie si la demande de l'utilisateur est approuvée
     */
    public function isApprouve(): bool
    {
        return $this->statut === self::STATUT_APPROUVE;
    }

    /**
     * Relation avec le stand (un utilisateur a un stand)
     */
    public function stand(): HasOne
    {
        return $this->hasOne(Stand::class);
    }
}
