<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'stand_id',
        'details_commande',
        'date_commande',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_commande' => 'datetime',
        'details_commande' => 'array',
    ];

    /**
     * Relation avec le stand (une commande appartient à un stand)
     */
    public function stand(): BelongsTo
    {
        return $this->belongsTo(Stand::class);
    }

    /**
     * Relation avec l'utilisateur (auteur de la commande)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Accesseur pour formater la date de commande
     */
    public function getDateCommandeFormateeAttribute(): string
    {
        return $this->date_commande->format('d/m/Y H:i');
    }

    /**
     * Accesseur pour calculer le total de la commande
     */
    public function getTotalAttribute(): float
    {
        if (!is_array($this->details_commande)) {
            return 0;
        }

        $total = 0;
        foreach ($this->details_commande as $item) {
            if (isset($item['prix']) && isset($item['quantite'])) {
                $total += $item['prix'] * $item['quantite'];
            }
        }

        return $total;
    }

    /**
     * Accesseur pour formater le total
     */
    public function getTotalFormateAttribute(): string
    {
        return number_format($this->total, 2, ',', ' ') . ' €';
    }
} 