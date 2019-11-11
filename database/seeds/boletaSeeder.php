<?php

use Illuminate\Database\Seeder;

class boletaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            ['395', '200000', '2019-04-20', '2019-03-20',],
            ['962', '350000', '2019-04-01', '2019-03-01',],
            ['498', '550000', '2019-03-07', '2019-02-19',],
            ['315', '150000', '2019-03-10', '2019-02-28',]
        ];
                
        foreach ($array as list($numero, $monto, $fechV, $alertaV) ) {
            DB::table('boletas')->insert(array(
                'numero' => $numero,
                'monto' => $monto,
                'fecha_vencimiento' => $fechV,
                'alerta_vencimiento' => $alertaV,
            ));
        }
    }
}
