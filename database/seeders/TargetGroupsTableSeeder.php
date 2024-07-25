<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TargetGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $targetGroups = [
            ['target_group' => 'Children', 'updated_by' => 1],
            ['target_group' => 'Adolescents', 'updated_by' => 1],
            ['target_group' => 'Women', 'updated_by' => 1],
            ['target_group' => 'Household', 'updated_by' => 1],
        ];

        DB::table('target_groups')->insert($targetGroups);
    }
}
