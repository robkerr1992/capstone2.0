<?php

use Illuminate\Database\Seeder;

class GameplansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Gameplan::class, 35)->create();
    }
}
