<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolesArray = array(
            ['Admin', 'web'],
            ['AdminTecnico', 'web']
           
        );

        foreach ($rolesArray as list($name, $guard_name) ) {
            DB::table('roles')->insert(array(
                'name' => $name,
                'guard_name' => $guard_name,
            ));
        }
    }
}
