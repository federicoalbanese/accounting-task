<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Constants\RoleConstants;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(3)->create();


        foreach (RoleConstants::ROLES as $role) {
            $roleObj = new Role();
            $roleObj->name = $role;
            $roleObj->save();
        }
    }
}
