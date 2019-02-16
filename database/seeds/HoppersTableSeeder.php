<?php

use Illuminate\Database\Seeder;

class HoppersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Hopper::class, 150)->create();

    }
}
