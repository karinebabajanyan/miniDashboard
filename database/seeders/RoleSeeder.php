<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'student']);

        $adminRole = Role::where('name', 'admin')->first();
        $adminRole->givePermissionTo(['create student', 'edit student', 'delete student']);

        // Assign permissions to student role
        $studentRole = Role::where('name', 'student')->first();
        $studentRole->givePermissionTo('edit own profile');
    }
}
