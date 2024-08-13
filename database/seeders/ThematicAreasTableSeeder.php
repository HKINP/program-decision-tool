<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThematicAreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $thematicAreas = [
            [ 'thematic_area' => 'Breastfeeding', 'updated_by' => 1],
            [ 'thematic_area' => 'Complementary feeding', 'updated_by' => 1],
            [ 'thematic_area' => 'Sick child care', 'updated_by' => 1],
            [ 'thematic_area' => 'Wasting', 'updated_by' => 1],
            [ 'thematic_area' => 'Diet', 'updated_by' => 1],
            [ 'thematic_area' => 'Pregnancy care', 'updated_by' => 1],
            [ 'thematic_area' => 'Postnatal care', 'updated_by' => 1],
            [ 'thematic_area' => 'Family planning', 'updated_by' => 1],
            [ 'thematic_area' => 'Water', 'updated_by' => 1],
            [ 'thematic_area' => 'Hygiene', 'updated_by' => 1],
            [ 'thematic_area' => 'Sanitation', 'updated_by' => 1],
        ];

        DB::table('thematic_areas')->insert($thematicAreas);
    }
}
