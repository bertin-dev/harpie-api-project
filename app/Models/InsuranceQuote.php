<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class InsuranceQuote extends Model
{
    use HasFactory;

    protected $table = 'insurance_quote';

    //un devis assurance appartient à un utilisateur
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //Un dévis d'assurance appartient à une compagnie d'assurance
    public function insuranceCompany(): BelongsTo
    {
        return $this->belongsTo(InsuranceCompany::class);
    }

    //Un devis d'assurance appartient à une seule voiture
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    //Un dévis d'assurance contient plusieurs garanties
    public function guarantee(): BelongsToMany
    {
        return $this->belongsToMany(Guarantee::class);
    }
}
