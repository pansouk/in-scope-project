<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Projects\Complex;
use App\Models\Projects\Project;
use App\Models\Projects\Standard;
use App\Models\Role;
use App\Models\User;
use Database\Factories\StandardFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Seed admin role
        Role::factory()->admin()->create();

        // Seed user role
        Role::factory()->user()->create();

        // Seed 50 users
        User::factory(50)->create();

        // Seed 100 companies and assign users to them
        Company::factory(100)->create()->each(function(Company $company){
            $user_role = Role::where('name', 'user')->first();
            $users = User::where('role_id', $user_role->id)->get();
            $company->users()->attach($users->random()->id);
        });

        // Seed Standard & complex type projects
        Standard::factory(100)->create();
        Complex::factory(100)->create();
    }
}
