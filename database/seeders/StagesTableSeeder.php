<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stages')->insert([
            ['updated_by' => 1, 'stages' => 'Step 1. District Context'],
            ['updated_by' => 1, 'stages' => 'Step 2. Prioritize Indicators for Year 1'],
            ['updated_by' => 1, 'stages' => 'Step 3. SBC Activities'],
            ['updated_by' => 1, 'stages' => 'Step 4. Health and Nutrition Service Activities'],
            ['updated_by' => 1, 'stages' => 'Step 5. Food Systems Activities'],
            ['updated_by' => 1, 'stages' => 'Step 6. Enabling Environment Activities'],
            ['updated_by' => 1, 'stages' => 'Step 7. Compiled Workplan'],
        ]);
    }
}
