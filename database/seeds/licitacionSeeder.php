<?php

use Illuminate\Database\Seeder;

class licitacionSeeder extends Seeder
{
        /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            ['1','0']
        ];

    foreach($array as list($id, $nro_licitacion)){
        DB::table('licitaciones')->insert(array(
            'id' => $id,
            'nro_licitacion' => $nro_licitacion,
            
        ));
    }
    }
}