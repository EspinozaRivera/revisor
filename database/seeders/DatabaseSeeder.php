<?php

namespace Database\Seeders;

use App\Models\User;
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
        
        $user =  new User();
        $user->nombre = 'administrador';
        $user->apellido1 = 'ap1';
        $user->apellido2 = 'ap2';
        $user->email = 'director.fim@uas.edu.mx';
        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
        $user->estatus = true;
        $user->save();
        $user->assignRole('administrador');      
    }
}
