<?php

use Illuminate\Database\Seeder;

class proveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provedoresArray = array(
            ['29.532-7', 'Medi-Tech International Inc.', 'Miami, Estados Unidos'],
            ['34.482.594-9', 'Schneider Electric de Colombia S.A.S', 'Bogotá, Colombia'],
        );

        foreach ($provedoresArray as list($rut, $razon_social, $ubicacion) ) {
            DB::table('proveedores')->insert(array(
                'rut' => $rut,
                'razon_social' => $razon_social,
                'ubicacion' => $ubicacion,
            ));
        }
    }
}
