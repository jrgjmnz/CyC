<?php

use Illuminate\Database\Seeder;

class permissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionArray = array(
                ['ver reportes', 'web'],
                ['ver seguimiento', 'web'],
                ['ver mantenedores', 'web'],
            );

        foreach ($permissionArray as list($name, $guard_name) ) {
            DB::table('permissions')->insert(array(
                   'name' => $name,
                   'guard_name' => $guard_name,
            ));
        }
    }
}
