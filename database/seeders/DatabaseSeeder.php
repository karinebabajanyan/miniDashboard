<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Profile;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(CountrySeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);

        $admin = User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@example.com',
        ]);

        $admin->assignRole('admin');

        $student1 = User::factory()->create([
            'first_name' => 'Student1',
            'last_name' => 'Student1',
            'email' => 'student1@example.com',
        ]);
        Profile::factory()->create([
            'user_id' => $student1->id,
            'country_id' => Country::first()->id,
        ]);
        $student1->assignRole('student');

        $student2 = User::factory()->create([
            'first_name' => 'Student2',
            'last_name' => 'Student2',
            'email' => 'student2@example.com',
        ]);
        Profile::factory()->create([
            'user_id' => $student2->id,
            'country_id' => Country::first()->id,
        ]);
        $student2->assignRole('student');

        $student3 = User::factory()->create([
            'first_name' => 'Student3',
            'last_name' => 'Student3',
            'email' => 'student3@example.com',
        ]);
        Profile::factory()->create([
            'user_id' => $student3->id,
            'country_id' => Country::first()->id,
        ]);
        $student3->assignRole('student');
    }
}
