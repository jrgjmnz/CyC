<?php

use Illuminate\Database\Seeder;

class prestacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prestacionArray = array(
            ['0101001', 'Consulta médica electiva', '9330', '9990', '11690'],
            ['0101201', 'Consulta Médica de Especialidad en Dermatología', '12840', '16690', '20540'],
            ['0101202', 'Consulta Médica de Especialidad en Geriatría', '12840', '16690', '20540'],
            ['0101203', 'Prestación sin Fonasa',null,null,null],
        );

        foreach ($prestacionArray as list($codigo, $nombre, $valor_1, $valor_2, $valor_3) ) {
            DB::table('prestaciones')->insert(array(
                'codigo' => $codigo,
                'nombre' => $nombre,
                'valor_1' => $valor_1,
                'valor_2' => $valor_2,
                'valor_3' => $valor_3,
            ));
        }
    }
}
