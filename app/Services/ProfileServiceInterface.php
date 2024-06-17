<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

interface ProfileServiceInterface
{
    public function createProfile(Request $request, User $user): void;
    public function updateProfile(Request $request, User $user): void;

}
