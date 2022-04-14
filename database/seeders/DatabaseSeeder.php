<?php

namespace Database\Seeders;

use App\Models\modulo;
use App\Models\ModuloPorRol;
use App\Models\User;
use App\Models\Rol;
use App\Models\RolPorUsuario;
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
        $this->call(RolSeeder::class);
        
        // \App\Models\User::factory(10)->create();
        //User::factory(50)->create();
        //Rol::factory(5)->create();

        // $rol1 = new Rol();
        // $rol1->nombre = 'administrador';
        // $rol1->estatus = true;
        // $rol1->save();

        // $rol2 = new Rol();
        // $rol2->nombre = 'administradorEquipo';
        // $rol2->estatus = true;
        // $rol2->save();

        // $rol3 = new Rol();
        // $rol3->nombre = 'administradorTorneo';
        // $rol3->estatus = true;
        // $rol3->save();

        // $rol4 = new Rol();
        // $rol4->nombre = 'arbitro';
        // $rol4->estatus = true;
        // $rol4->save();

        // $rol5 = new Rol();
        // $rol5->nombre = 'jugador';
        // $rol5->estatus = true;
        // $rol5->save();

        // $rol6 = new Rol();
        // $rol6->nombre = 'fan';
        // $rol6->estatus = true;
        // $rol6->save();

        $user =  new User();
        $user->curp = 'EIRJ980922MSLSVV02';
        $user->nombre = 'nombre';
        $user->apellido1 = 'ap1';
        $user->apellido2 = 'ap2';
        $user->email = 'jotasbb@gmail.com';
        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
        $user->estatus = true;
        $user->save();
        $user->assignRole('administrador');
        // $user->assignRole('administradorEquipo');
        // $user->assignRole('administradorTorneo');
        // $user->assignRole('fan');

 
        // $rolPorUsuario1 = new RolPorUsuario();
        // $rolPorUsuario1->idUsuario = 1;
        // $rolPorUsuario1->idRol = 1;
        // $rolPorUsuario1->save();

        // $rolPorUsuario2 = new RolPorUsuario();
        // $rolPorUsuario2->idUsuario = 1;
        // $rolPorUsuario2->idRol = 2;
        // $rolPorUsuario2->save();

        // $modulo1 = new modulo();
        // $modulo1->id = 1;
        // $modulo1->nombre = "Usuarios";
        // $modulo1->save();

        // $modulo2 = new modulo();
        // $modulo2->id = 2;
        // $modulo2->nombre = "Roles";
        // $modulo2->save();

        // $modulo3 = new modulo();
        // $modulo3->id = 3;
        // $modulo3->nombre = "Roles por usuario";
        // $modulo3->save();

        // $modulo3 = new modulo();
        // $modulo3->id = 4;
        // $modulo3->nombre = "Modulos";
        // $modulo3->save();

        // $modulosPorRol1 = new ModuloPorRol();
        // $modulosPorRol1->id = 1;
        // $modulosPorRol1->idRol = 1;
        // $modulosPorRol1->idModulo = 1;
        // $modulosPorRol1->save();

        // $modulosPorRol2 = new ModuloPorRol();
        // $modulosPorRol2->id = 2;
        // $modulosPorRol2->idRol = 1;
        // $modulosPorRol2->idModulo = 2;
        // $modulosPorRol2->save();

        // $modulosPorRol3 = new ModuloPorRol();
        // $modulosPorRol3->id = 3;
        // $modulosPorRol3->idRol = 1;
        // $modulosPorRol3->idModulo = 3;
        // $modulosPorRol3->save();

        // $modulosPorRol4 = new ModuloPorRol();
        // $modulosPorRol4->id = 4;
        // $modulosPorRol4->idRol = 1;
        // $modulosPorRol4->idModulo = 4;
        // $modulosPorRol4->save();

        
    }
}
