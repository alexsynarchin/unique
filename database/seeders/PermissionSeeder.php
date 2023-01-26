<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Laravue\Models\Role;
use App\Laravue\Models\Permission;
use App\Laravue\Acl;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Acl::roles() as $role) {
            Role::findOrCreate($role);
        }
        $adminRole = Role::findByName(Acl::ROLE_ADMIN);
        $managerRole = Role::findByName(Acl::ROLE_MANAGER);
        foreach (Acl::permissions() as $permission) {
            Permission::findOrCreate($permission, 'api');
        }
        $adminRole->givePermissionTo(Acl::permissions());
    }
}
