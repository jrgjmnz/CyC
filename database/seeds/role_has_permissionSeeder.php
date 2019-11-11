<?php

use Illuminate\Database\Seeder;

class role_has_permissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Array = array(
            ['1', '1'],
            ['1', '2'],
            ['2', '1'],
            ['3', '1'],
        );

        foreach ($Array as list($permission, $role) ) {
            DB::table('role_has_permissions')->insert(array(
                'permission_id' => $permission,
                'role_id' => $role,
            ));
        }
    }
}
