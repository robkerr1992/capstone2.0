<?php

use Illuminate\Database\Seeder;

class BarFeaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(App\Feature::class, 100)->create();
        $bars = App\Bar::all()->pluck('id');
        foreach ($bars as $barid) {
            $bar = new \App\Feature();
            $bar->bar_id = $barid;
//            $bar->noise_level = mt_rand(1, 5);
            $bar->smoking = mt_rand(0, 1);
            $bar->food = mt_rand(0, 1);
            $bar->pet_friendly = mt_rand(0, 1);
//            $bar->bikes = mt_rand(0, 1);
            $bar->live_music = mt_rand(0, 1);
//            $bar->reservations = mt_rand(0, 1);
            $bar->tvs = mt_rand(0, 1);
            $bar['18+'] = mt_rand(0, 1);
//            $bar->kids = mt_rand(0, 1);
            $bar->patio = mt_rand(0, 1);
            $bar->pool = mt_rand(0, 1);
            $bar->darts = mt_rand(0, 1);
            $bar->games = mt_rand(0, 1);
            $bar->save();
        }

    }

}
