<?php

use Illuminate\Database\Seeder;

class BarPictureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Picture::class, 1)->create();
    }
}
