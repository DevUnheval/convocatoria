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
        $this->call(AjustesTableSeeder::class);
        $this->call(PruebaTableSeeder::class);
        $this->call(PruebaAbelTableSeeder::class);
        $this->call(Ubigeo::class);
        $this->call(Datosusuario2::class);
    }
}
