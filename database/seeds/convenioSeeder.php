<?php

use Illuminate\Database\Seeder;

class convenioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            ['1', 'ID-00251654', 'objeto contrato convenio 1', '2017-12-12','2019-03-10', '3', '2017-02-05'],
            ['2', 'ID-01046954', 'objeto contrato convenio 2', '2018-10-24','2019-03-14', '4', '2017-02-02'],
        ];
                
        foreach ($array as list($proveedor, $licitacion, $objeto, $fechI, $fechF, $boletaID, $fechV) ) {
            DB::table('convenios')->insert(array(
                'proveedor_id' => $proveedor,
                'licitacion' => $licitacion,
                'objeto_contrato' => $objeto,
                'fecha_inicio' => $fechI,
                'fecha_termino' => $fechF,
                'boleta_id' => $boletaID,
                'alerta_vencimiento' => $fechV,
            ));
        }
    }
}
