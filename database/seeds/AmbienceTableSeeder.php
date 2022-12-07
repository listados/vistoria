<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AmbienceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i=0; $i < 10; $i++) {
            DB::table('ambience')->insert([
                'ambience_name' => $faker->domainWord,
                'ambience_description' => $faker->sentence($nbWords = 6),
                'created_at' => $faker->dateTime($max = 'now')  ,
            ]);
        }
    }
}
