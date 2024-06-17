<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    public function createUser(Request $request): User
    {
        $user = User::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password)
        ]);

        return $user;
    }

    public function assignUserRole(string $role, User $user): void
    {
        $user->assignRole($role);
    }

    public function updateUser(int $id, Request $request): User
    {
        $user = User::find($id);

        if($request->password){
            $user->update([
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'email'=>$request->email,
                'password'=> Hash::make($request->password)
            ]);
        }else{
            $user->update([
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'email'=>$request->email,
            ]);
        }

        return $user;
    }

    public function deleteUser(int $id): void
    {
        User::destroy($id);
    }

    public function getUsers(string $role): Collection
    {
        $students = User::role($role)->get();

        return $students;
    }
    public function getPaginateUsers(string $role, int $perPage): LengthAwarePaginator
    {
        $students = User::role($role)->paginate($perPage);

        return $students;
    }

    public function getSearchUsers(string $role, string $query): Collection
    {
        $search = '%' . $query . '%';

        $students = User::role($role)->where(function($q) use ($search) {
            $q->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", [$search])
                ->orWhere('first_name', 'like', $search)
                ->orWhere('last_name', 'like', $search);
        })->get();

        return $students;
    }
    public function getPaginateSearchUsers(string $role, int $perPage, string $query): LengthAwarePaginator
    {
        $search = '%' . $query . '%';

        $students = User::role($role)->where(function($q) use ($search) {
            $q->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", [$search])
                ->orWhere('first_name', 'like', $search)
                ->orWhere('last_name', 'like', $search);
        })->paginate($perPage);

        return $students;
    }

}
