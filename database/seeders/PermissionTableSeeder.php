<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permissions
        $permissions = [
            'role-create',
            'role-edit',
            'role-delete',
            'role-list',
            'list-users',
            'create-user',
            'edit-user',
            'delete-user',
            'list-post',
            'create-post',
            'edit-post',
            'delete-post',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $role = Role::create(['name' => 'Admin']);
    }
}
