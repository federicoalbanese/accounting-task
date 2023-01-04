<?php

namespace Database\Seeders;

use App\Constants\RoleConstants;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionsListRegistrar = [
            'Document -> Customer Document Index',
            'Document -> Pick Customer Document',
            'Document -> Store',
        ];
        $permissionsListReviewer = [
            'Reviewer Document -> Index',
            'Reviewer Document -> Make Confirm Document',
        ];

        $permissionsRegistrar =
            Permission::query()
                ->select('id')
                ->whereIn('title', $permissionsListRegistrar)
                ->pluck('id')->toArray();
        $permissionsReviewer =
            Permission::query()
                ->select('id')
                ->whereIn('title', $permissionsListRegistrar)
                ->pluck('id')->toArray();

        /** @var Role $operatorRole */
        $operatorRole = Role::query()->where('name', '=', RoleConstants::REGISTRAR)->first();
        $operatorRole->permissions()->sync($allPermission);

        /** @var Role $operatorRole */
        $operatorRole = Role::query()->where('name', '=', RoleConstants::REVIEWER)->first();
        $operatorRole->permissions()->sync($allPermission);
    }
}
