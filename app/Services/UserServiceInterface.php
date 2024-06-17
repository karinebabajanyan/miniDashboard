<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserServiceInterface
{
    public function createUser(Request $request): User;
    public function assignUserRole(string $role, User $user): void;
    public function updateUser(int $id, Request $request): User;
    public function deleteUser(int $id): void;
    public function getUsers(string $role): Collection;
    public function getSearchUsers(string $role, string $query): Collection;
    public function getPaginateUsers(string $role, int $perPage): LengthAwarePaginator;
    public function getPaginateSearchUsers(string $role, int $perPage, string $query): LengthAwarePaginator;
}
