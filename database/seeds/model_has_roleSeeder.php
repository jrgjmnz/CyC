<?php

use Illuminate\Database\Seeder;

class model_has_roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Array = array(
            ['1', 'App\User', '1'],
            ['2', 'App\User', '2'],
        );

        foreach ($Array as list($role_id, $model_type, $model_id) ) {
            DB::table('model_has_roles')->insert(array(
                'role_id' => $role_id,
                'model_type' => $model_type,
                'model_id' => $model_id,
            ));
        }
    }
}
