<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    public function run()
    {
        $role1 = Role::create(['name' => 'administrador']);
        $role2 = Role::create(['name' => 'administradorEquipo']);
        $role3 = Role::create(['name' => 'administradorTorneo']);
        $role4 = Role::create(['name' => 'arbitro']);
        $role5 = Role::create(['name' => 'jugador']);
        $role6 = Role::create(['name' => 'fan']);

        /*  
            index:      consultar todos los registros
            show:       Consultar un registro
            store:      Agregar un registro
            update:     Editar registro
            destroy:    Eliminar registro o cambiar estatus de registro
        */

        //Usuarios
        Permission::create(['name' => 'User.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'User.show'])->syncRoles([$role1]);
        //Permission::create(['name' => 'User.store']);     //Solo está la opcion de crear usuario desde el registrar por lo cual no se necesita el permiso
        Permission::create(['name' => 'User.update'])->syncRoles([$role1]);
        //Permission::create(['name' => 'User.destroy'])->syncRoles([$role1]);      //Como dijo un filosofo, los usuarios no se borran solo se les cambia el 
                                                                                    //estatus xd(desde el editar)
        //Roles
        Permission::create(['name' => 'Role.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'Role.show'])->syncRoles([$role1]);
        Permission::create(['name' => 'Role.store'])->syncRoles([$role1]);
        Permission::create(['name' => 'Role.update'])->syncRoles([$role1]);
        Permission::create(['name' => 'Role.destroy'])->syncRoles([$role1]);

        //Permisos
        Permission::create(['name' => 'Permission.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'Permission.show'])->syncRoles([$role1]);

        //Roles por usuario
        Permission::create(['name' => 'RolPorUsuario.show'])->syncRoles([$role1]);

        //Permisos por rol
        Permission::create(['name' => 'PermisoPorRol.show'])->syncRoles([$role1]);
    }
}
