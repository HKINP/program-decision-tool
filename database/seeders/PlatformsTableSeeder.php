<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PlatformsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $platforms = [
            ['platforms' => 'ANC', 'updated_by' => 1],
            ['platforms' => 'ASF production (livestock, fishery)', 'updated_by' => 1],
            ['platforms' => 'CF seal', 'updated_by' => 1],
            ['platforms' => 'Climate-smart HFP (fruit & veg)', 'updated_by' => 1],
            ['platforms' => 'CLTS', 'updated_by' => 1],
            ['platforms' => 'CNSI', 'updated_by' => 1],
            ['platforms' => 'Digital', 'updated_by' => 1],
            ['platforms' => 'ECDC', 'updated_by' => 1],
            ['platforms' => 'EPI', 'updated_by' => 1],
            ['platforms' => 'Gender integration', 'updated_by' => 1],
            ['platforms' => 'GMP', 'updated_by' => 1],
            ['platforms' => 'GoN input subsidies, insurance', 'updated_by' => 1],
            ['platforms' => 'Health facilities', 'updated_by' => 1],
            ['platforms' => 'Health facility', 'updated_by' => 1],
            ['platforms' => 'HMG', 'updated_by' => 1],
            ['platforms' => 'Home', 'updated_by' => 1],
            ['platforms' => 'IMAM', 'updated_by' => 1],
            ['platforms' => 'IMNCI', 'updated_by' => 1],
            ['platforms' => 'Indigenous crop-based foods', 'updated_by' => 1],
            ['platforms' => 'MBFHI', 'updated_by' => 1],
            ['platforms' => 'NFSSC (local)', 'updated_by' => 1],
            ['platforms' => 'NFSSC (ward)', 'updated_by' => 1],
            ['platforms' => 'NSA curriculum', 'updated_by' => 1],
            ['platforms' => 'PNC', 'updated_by' => 1],
            ['platforms' => 'Post-harvest management', 'updated_by' => 1],
            ['platforms' => 'Private facility', 'updated_by' => 1],
            ['platforms' => 'Private sector', 'updated_by' => 1],
            ['platforms' => 'Producer groups', 'updated_by' => 1],
            ['platforms' => 'School', 'updated_by' => 1],
            ['platforms' => 'Social protection', 'updated_by' => 1],
            ['platforms' => 'VSLAs', 'updated_by' => 1],
        ];

        DB::table('platforms')->insert($platforms);
    }
}
