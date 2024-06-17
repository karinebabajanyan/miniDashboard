<?php

namespace App\Services\Country;

use App\Models\Country;
use App\Services\CountryServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class CountryService implements CountryServiceInterface
{
    public function getCountries():Collection
    {
        return Country::all();
    }
}
