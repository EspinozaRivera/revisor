<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'administrador']);
        $role2 = Role::create(['name' => 'administradorEquipo']);
        $role3 = Role::create(['name' => 'administradorTorneo']);
        $role4 = Role::create(['name' => 'arbitro']);
        $role5 = Role::create(['name' => 'jugador']);
        $role6 = Role::create(['name' => 'fan']);

        $permission = Permission::create(['name' => 'user.index'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'user.show'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'user.update'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'user.destroy'])->syncRoles([$role1]);
    }
}
