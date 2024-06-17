<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

interface CountryServiceInterface
{
    public function getCountries():Collection;
}
