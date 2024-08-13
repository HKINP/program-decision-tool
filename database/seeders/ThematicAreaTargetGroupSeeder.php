<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThematicAreaTargetGroupSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['target_group_id' => 1, 'thematic_area_id' => 1],
            ['target_group_id' => 1, 'thematic_area_id' => 2],
            ['target_group_id' => 1, 'thematic_area_id' => 3],
            ['target_group_id' => 1, 'thematic_area_id' => 4],
            ['target_group_id' => 2, 'thematic_area_id' => 5],
            ['target_group_id' => 3, 'thematic_area_id' => 6],
            ['target_group_id' => 3, 'thematic_area_id' => 7],
            ['target_group_id' => 3, 'thematic_area_id' => 5],
            ['target_group_id' => 3, 'thematic_area_id' => 8],
            ['target_group_id' => 4, 'thematic_area_id' => 9],
            ['target_group_id' => 5, 'thematic_area_id' => 10],
            ['target_group_id' => 6, 'thematic_area_id' => 11],
            ['target_group_id' => 6, 'thematic_area_id' => 12],
        ];

        DB::table('thematic_area_target_group')->insert($data);
    }
}
