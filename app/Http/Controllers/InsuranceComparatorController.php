<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InsuranceComparatorController extends Controller
{
    public function compareInsurancePrices(...$companies)
    {
        // Sort the companies based on price in ascending order
        usort($companies, function ($a, $b) {
            return $a['price'] - $b['price'];
        });

        return $companies;
    }
}
