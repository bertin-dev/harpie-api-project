<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Guarantee extends Model
{
    use HasFactory;

    protected $table = 'guarantee';
    //une garantie peut appartenir à plusieurs devis d'assurance
    public function insuranceQuotes(): BelongsToMany
    {
        return $this->belongsToMany(InsuranceQuote::class);
    }
}
