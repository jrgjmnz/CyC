<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MonedaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
                    ['UTM', 'Unidad Tributaria Mensual', '4853'],
                    ['UF', 'Unidad de Fomento', '27551.56'],
                    ['USD', 'Dólar', '672.14'],
                    ['EUR', 'Euro', '759.91'],
                    ['CLP', 'Pesos Chilenos', '1'],
                ];
                
        foreach ($array as list($codigo, $nombre, $precio) ) {
            DB::table('monedas')->insert(array(
                   'codigo' => $codigo,
                   'nombre' => $nombre,
                   'factor_conversion' => $precio,
            ));
        }
    }
}
