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
        'name',
        'email',
        'password',
        'role',
        'phone',
        'company_name',
        'activity_type',
        'specialties',
        'description',
        'experience',
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
    const ROLE_ENTREPRENEUR = 'entrepreneur';
    const ROLE_PARTICIPANT = 'participant';

    /**
     * Vérifie si l'utilisateur est admin
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * Vérifie si l'utilisateur est entrepreneur
     */
    public function isEntrepreneur(): bool
    {
        return $this->role === self::ROLE_ENTREPRENEUR;
    }

    /**
     * Vérifie si l'utilisateur est participant
     */
    public function isParticipant(): bool
    {
        return $this->role === self::ROLE_PARTICIPANT;
    }

    /**
     * Relation avec le stand (un utilisateur a un stand)
     */
    public function stand(): HasOne
    {
        return $this->hasOne(Stand::class);
    }

    /**
     * Obtient le nom complet de l'utilisateur
     */
    public function getFullNameAttribute(): string
    {
        return $this->name;
    }

    /**
     * Obtient le prénom de l'utilisateur
     */
    public function getFirstNameAttribute(): string
    {
        $parts = explode(' ', $this->name);
        return $parts[0] ?? '';
    }

    /**
     * Obtient le nom de famille de l'utilisateur
     */
    public function getLastNameAttribute(): string
    {
        $parts = explode(' ', $this->name);
        return count($parts) > 1 ? implode(' ', array_slice($parts, 1)) : '';
    }
}
