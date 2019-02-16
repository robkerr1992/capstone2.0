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
        // $this->call(UsersTableSeeder::class);
//        Model::unguard();
//        DB::table('votes')->delete();
//        DB::table('specials')->delete();
//        DB::table('bar_features')->delete();
//        DB::table('bar_pictures')->delete();
//        DB::table('events')->delete();
//        DB::table('reviews')->delete();
//        DB::table('bars')->delete();
//        DB::table('users')->delete();
        $this->call(UsersTableSeeder::class);
//        $this->call(BarsTableSeeder::class);
//        $this->call(ReviewsTableSeeder::class);
//        $this->call(EventsTableSeeder::class);
//        $this->call(BarPicturesTableSeeder::class);
//        $this->call(BarFeaturesTableSeeder::class);
//        $this->call(SpecialsTableSeeder::class);
//        $this->call(VotesTableSeeder::class);
//        Model::reguard();
    }
}
