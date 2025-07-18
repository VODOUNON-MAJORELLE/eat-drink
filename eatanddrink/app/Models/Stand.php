<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stand extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'nom_stand',
        'description',
        'user_id',
    ];

    /**
     * Relation avec l'utilisateur (un stand appartient à un utilisateur)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec les produits (un stand a plusieurs produits)
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Relation avec les commandes (un stand a plusieurs commandes)
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Vérifie si le stand est approuvé (via l'utilisateur)
     */
    public function isApprouve(): bool
    {
        return $this->user && $this->user->isApprouve();
    }

    /**
     * Scope pour récupérer seulement les stands approuvés
     */
    public function scopeApprouves($query)
    {
        return $query->whereHas('user', function ($q) {
            $q->where('statut', User::STATUT_APPROUVE);
        });
    }
} 