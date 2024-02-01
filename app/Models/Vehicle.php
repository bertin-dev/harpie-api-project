<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'vehicles';

    // un vehicule appartient à un et un seul utilisateur
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //un vehicule possède plusieurs dévis assurance
    public function insuranceQuotes(): HasMany
    {
        return $this->hasMany(InsuranceQuote::class);
    }

}
