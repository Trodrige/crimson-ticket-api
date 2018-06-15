<?php

use Illuminate\Database\Seeder;

class JourneysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Journey::class, 200)->create();
    }
}
