<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $Array = array(
            ['Administrador', ' ','admin@gmail.com', 'admin123', 1],
            ['Administrador técnico', '', 'atecnico@gmail.com', 'atec123', 1 ]                     
        );

        foreach ($Array as list($nombre, $apellidos, $email, $contraseña, $cargo) ) {
            DB::table('users')->insert(array(
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'email' => $email,
                'password' => bcrypt($contraseña),
                'cargo_id' => $cargo,
            ));
        }
    }
}
