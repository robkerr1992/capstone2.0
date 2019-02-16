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
        $this->call(UsersTableSeeder::class);
        $this->call(BarsTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(SpecialsTableSeeder::class);
        $this->call(GameplansTableSeeder::class);
        $this->call(GameplanBarsTableSeeder::class);
        $this->call(HoppersTableSeeder::class);
//        $this->call(VotesTableSeeder::class);
//        Model::reguard();
    }
}
