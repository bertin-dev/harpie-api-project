<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InsuranceCompany extends Model
{
    use HasFactory;
    protected $table = 'insurance_companies';

    //une compagnie d'assurance peut avoir plusieurs devis assurances
    public function insuranceQuotes(): HasMany
    {
        return $this->hasMany(InsuranceQuote::class);
    }
}
