<?php

namespace App\Services\Profile;

use App\Models\Profile;
use App\Models\User;
use App\Services\ProfileServiceInterface;
use Illuminate\Http\Request;

class ProfileService implements ProfileServiceInterface
{
    public function createProfile(Request $request, User $user): void
    {
        $user->profile()->create([
            'user_id'=>$user->id,
            'country_id'=>$request->country,
            'city'=>$request->city,
            'birthday'=>$request->birthday,
        ]);
    }

    public function updateProfile(Request $request, User $user): void
    {
        $user->profile()->update([
            'country_id'=>$request->country,
            'city'=>$request->city,
            'birthday'=>$request->birthday,
        ]);

    }
}
