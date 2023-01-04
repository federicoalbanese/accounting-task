<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Constants\RoleConstants;
use App\Models\CustomerDocument;
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

        for ($i = 0; $i < 5; $i++) {
            $cd = new CustomerDocument();
            $cd->setName('test' . $i);
            $cd->save();
        }

        foreach (RoleConstants::ROLES as $role) {
            $roleObj = new Role();
            $roleObj->name = $role;
            $roleObj->save();
        }

        $this->call([
            RolePermissionsSeeder::class,
        ]);
    }
}
