<?php

use Illuminate\Database\Seeder;

class BarPicturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Picture::class, 500)->create();
    }
}
