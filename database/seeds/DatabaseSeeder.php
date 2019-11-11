<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
            'users',
            'monedas',
            'cargos',
            'model_has_roles',
            'role_has_permissions',
            'permissions',
            'roles',
            'proveedores',
            'prestaciones',
            'contratos',
            'boletas',
            'convenios',
        ]);
        
        $this->call(MonedaSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(CargoSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(permissionSeeder::class);
        $this->call(role_has_permissionSeeder::class);
        $this->call(model_has_roleSeeder::class);
        $this->call(proveedorSeeder::class);
        $this->call(prestacionSeeder::class);
        $this->call(boletaSeeder::class);
        $this->call(contratoSeeder::class);
        $this->call(convenioSeeder::class);
    }

    protected function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

    }
}
