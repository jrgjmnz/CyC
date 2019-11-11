<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $cargoArray = array(
                            'ENCARGADA SERV.HOTELERÍA CLÍNICA', 'JEFE  FARM.HOSPITALIZADOS', 'JEFE DE ABASTECIMIENTO Y FINANZAS', 'JEFE DE BIENESTAR', 'JEFE DE CUENTAS CORRIENTES',
                            'JEFE DE FARMACIA HOSPITALIZADOS', 'JEFE DE LABORATORIO', 'JEFE DE MEDICINA NUCLEAR', 'JEFE DE PREVENCIÓN DE RIESGO', 'JEFE DE SECCIÓN INSUMOS CLÍNICOS',
                            'JEFE DE SERVICIO DE HEMODINAMIA', 'JEFE DE SERVICIO MÁX FACIAL', 'JEFE DE SERVICIO NEUROLOGÍA', 'JEFE DEL SERVICIO DE PSIQUIATRIA',
                            'JEFE DEL SERVICIO DEL QUÍMICO FARMACÉUTICO DE ONCOLOGÍA', 'JEFE DEL SERVICIO HEMODINAMIA Y ANGIOGRAFIA', 'JEFE DEPTO AB Y FINANZAS',
                            'JEFE DEPTO ABASTECIMIENTO', 'JEFE DEPTO BIOMÉDICA', 'JEFE DEPTO IMAGENEOLOGÍA', 'JEFE DEPTO INFORMÁTICA', 'JEFE DEPTO INGENIERÍA', 'JEFE DEPTO SOME',
                            'JEFE DEPTO SUB DES HUMANO', 'JEFE DIV CONTROL EXISTENCIA', 'JEFE PREV DE RIESGOS', 'JEFE SECCIÓN CIRUGÍA CARDÍACA', 'JEFE SECCIÓN CIRUGÍA MÁXILO FACIAL',
                            'JEFE SERV HEMODINAMIA', 'JEFE SERV MED NUCLEAR', 'JEFE SERV URETERÓSCOPIA', 'JEFE SERV. ESTERILIZACIÓN', 'JEFE SERV. OFTALMOLOGÍA', 'MATRONA JEFE DEL CAPS DE VIÑA',
                            'SUB.DIRECTOR DE ADMINISTRACIÓN Y FINANZAS', 'SUB.DIRECTOR DE DESARROLLO HUMANO'
                            );

        foreach ($cargoArray as $cargos) {
            DB::table('cargos')->insert(array(
                   'nombre' => $cargos,
            ));
        }

    }




}
