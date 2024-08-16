<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        $this->call([
            // UserSeeder::class,
            // ProvincesTableSeeder::class,
            // TargetGroupsTableSeeder::class,
            // ThematicAreasTableSeeder::class,
            // DistrictsTableSeeder::class,
            // IndicatorsTableSeeder::class,
            QuestionsTableSeeder::class,
            // StagesTableSeeder::class,
            // ThematicAreaTargetGroupSeeder::class,
            // PlatformsTableSeeder::class
        ]);
    }
}
