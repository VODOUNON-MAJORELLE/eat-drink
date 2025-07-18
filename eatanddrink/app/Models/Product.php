<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'nom',
        'description',
        'prix',
        'image_url',
        'stand_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'prix' => 'decimal:2',
    ];

    /**
     * Relation avec le stand (un produit appartient à un stand)
     */
    public function stand(): BelongsTo
    {
        return $this->belongsTo(Stand::class);
    }

    /**
     * Accesseur pour formater le prix
     */
    public function getPrixFormateAttribute(): string
    {
        return number_format($this->prix, 2, ',', ' ') . ' €';
    }

    /**
     * Scope pour récupérer les produits des stands approuvés
     */
    public function scopeFromStandsApprouves($query)
    {
        return $query->whereHas('stand.user', function ($q) {
            $q->where('statut', User::STATUT_APPROUVE);
        });
    }
} 