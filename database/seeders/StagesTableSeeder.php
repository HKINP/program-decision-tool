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
            ['updated_by' => 1, 'stages' => 'Step 1. Prioritize Behaviors'],
            ['updated_by' => 1, 'stages' => 'Step 2. Map Platforms, Actors, and Channels'],
            ['updated_by' => 1, 'stages' => 'Step 3. Plan SBC Activities (IR 1)'],
            ['updated_by' => 1, 'stages' => 'Step 4. Map Health and Nutrition Services'],
            ['updated_by' => 1, 'stages' => 'Step 5. Plan Health System Activities (IR 2)'],
            ['updated_by' => 1, 'stages' => 'Step 6. Identify Food System Needs'],
            ['updated_by' => 1, 'stages' => 'Step 7. Plan Food Systems Activities (IR 3)'],
            ['updated_by' => 1, 'stages' => 'Step 8. Plan Governance Activities (IR 4)'],
            ['updated_by' => 1, 'stages' => 'Step 9. Compiled Workplan'],
        ]);
    }
}
