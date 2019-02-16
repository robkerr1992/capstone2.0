<?php

use Illuminate\Database\Seeder;

class GameplanBarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\GameplanBar::class, 125)->create();
    }
}
